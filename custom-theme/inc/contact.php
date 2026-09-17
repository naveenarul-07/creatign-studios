<?php
/**
 * Contact form validation and handlers.
 *
 * Rules match server/middleware/validate.js and the Express contact limiter.
 */

if (!defined('ABSPATH')) {
  exit;
}

function creative_studio_contact_email_pattern() {
  return '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
}

function creative_studio_validate_contact($payload) {
  $name    = isset($payload['name']) ? $payload['name'] : null;
  $email   = isset($payload['email']) ? $payload['email'] : null;
  $company = array_key_exists('company', $payload) ? $payload['company'] : null;
  $message = isset($payload['message']) ? $payload['message'] : null;
  $errors  = [];

  if (!is_string($name) || strlen(trim($name)) < 2) {
    $errors['name'] = 'Name must be at least 2 characters.';
  } elseif (strlen(trim($name)) > 80) {
    $errors['name'] = 'Name must be 80 characters or fewer.';
  }

  if (!is_string($email) || !preg_match(creative_studio_contact_email_pattern(), trim($email))) {
    $errors['email'] = 'A valid email address is required.';
  }

  if (null !== $company && !is_string($company)) {
    $errors['company'] = 'Company must be a string.';
  } elseif (is_string($company) && strlen($company) > 100) {
    $errors['company'] = 'Company must be 100 characters or fewer.';
  }

  if (!is_string($message) || strlen(trim($message)) < 10) {
    $errors['message'] = 'Message must be at least 10 characters.';
  } elseif (strlen(trim($message)) > 2000) {
    $errors['message'] = 'Message must be 2000 characters or fewer.';
  }

  if ($errors) {
    return [
      'ok'     => false,
      'error'  => 'Validation failed.',
      'fields' => $errors,
    ];
  }

  return [
    'ok'   => true,
    'data' => [
      'name'    => trim($name),
      'email'   => strtolower(trim($email)),
      'company' => is_string($company) ? trim($company) : '',
      'message' => trim($message),
    ],
  ];
}

function creative_studio_sanitize_contact_payload($payload) {
  if (!is_array($payload)) {
    return [];
  }

  $clean = [];

  if (array_key_exists('name', $payload)) {
    $clean['name'] = is_string($payload['name']) ? sanitize_text_field($payload['name']) : $payload['name'];
  }
  if (array_key_exists('email', $payload)) {
    $clean['email'] = is_string($payload['email']) ? sanitize_email($payload['email']) : $payload['email'];
  }
  if (array_key_exists('company', $payload)) {
    $clean['company'] = is_string($payload['company']) ? sanitize_text_field($payload['company']) : $payload['company'];
  }
  if (array_key_exists('message', $payload)) {
    $clean['message'] = is_string($payload['message']) ? sanitize_textarea_field($payload['message']) : $payload['message'];
  }

  return $clean;
}

function creative_studio_verify_contact_nonce($nonce) {
  return is_string($nonce) && wp_verify_nonce($nonce, 'creative_studio_contact');
}

function creative_studio_contact_rate_limited() {
  $ip  = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])) : 'unknown';
  $key = 'cs_contact_' . md5($ip);
  $hits = (int) get_transient($key);

  if ($hits >= 10) {
    return true;
  }

  set_transient($key, $hits + 1, 15 * MINUTE_IN_SECONDS);
  return false;
}

function creative_studio_store_contact($data) {
  $name    = sanitize_text_field($data['name']);
  $email   = sanitize_email($data['email']);
  $company = sanitize_text_field($data['company']);
  $message = sanitize_textarea_field($data['message']);

  $post_id = wp_insert_post([
    'post_type'    => 'cs_contact',
    'post_status'  => 'private',
    'post_title'   => $name . ' — ' . $email,
    'post_content' => $message,
  ], true);

  if (is_wp_error($post_id)) {
    return $post_id;
  }

  update_post_meta($post_id, '_cs_email', $email);
  update_post_meta($post_id, '_cs_company', $company);
  update_post_meta($post_id, '_cs_name', $name);

  $admin_email = get_option('admin_email');
  wp_mail(
    $admin_email,
    sprintf('Project inquiry from %s', $name),
    implode("\n", [
      'Name: ' . $name,
      'Email: ' . $email,
      'Company: ' . $company,
      '',
      $message,
    ])
  );

  return $post_id;
}

function creative_studio_register_contact_post_type() {
  register_post_type('cs_contact', [
    'labels' => [
      'name'          => __('Inquiries', 'creative-studio'),
      'singular_name' => __('Inquiry', 'creative-studio'),
    ],
    'public'              => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'exclude_from_search' => true,
    'capability_type'     => 'post',
    'capabilities'        => [
      'create_posts' => 'do_not_allow',
    ],
    'map_meta_cap'        => true,
    'menu_icon'           => 'dashicons-email',
    'supports'            => ['title', 'editor'],
  ]);
}
add_action('init', 'creative_studio_register_contact_post_type');

function creative_studio_register_contact_rest() {
  register_rest_route('creative-studio/v1', '/contact', [
    'methods'             => 'POST',
    'permission_callback' => '__return_true',
    'callback'            => 'creative_studio_rest_contact',
  ]);
}
add_action('rest_api_init', 'creative_studio_register_contact_rest');

function creative_studio_rest_contact(WP_REST_Request $request) {
  $payload = $request->get_json_params();
  if (!is_array($payload)) {
    $payload = $request->get_params();
  }
  if (!is_array($payload)) {
    $payload = [];
  }

  $nonce = '';
  if (!empty($payload['_wpnonce'])) {
    $nonce = sanitize_text_field((string) $payload['_wpnonce']);
    unset($payload['_wpnonce']);
  }

  if (!creative_studio_verify_contact_nonce($nonce)) {
    return new WP_REST_Response([
      'success' => false,
      'error'   => 'Invalid request.',
    ], 403);
  }

  if (creative_studio_contact_rate_limited()) {
    return new WP_REST_Response([
      'success' => false,
      'error'   => 'Too many messages. Please try again later.',
    ], 429);
  }

  $validated = creative_studio_validate_contact(creative_studio_sanitize_contact_payload($payload));
  if (!$validated['ok']) {
    return new WP_REST_Response([
      'success' => false,
      'error'   => $validated['error'],
      'fields'  => $validated['fields'],
    ], 400);
  }

  $stored = creative_studio_store_contact($validated['data']);
  if (is_wp_error($stored)) {
    return new WP_REST_Response([
      'success' => false,
      'error'   => $stored->get_error_message(),
    ], 500);
  }

  return new WP_REST_Response([
    'success' => true,
    'message' => 'Thanks — we will be in touch shortly.',
    'data'    => ['id' => $stored],
  ], 201);
}

function creative_studio_admin_post_contact() {
  $redirect = wp_get_referer() ? wp_get_referer() : home_url('/contact');

  $nonce = isset($_POST['cs_contact_nonce']) ? sanitize_text_field(wp_unslash($_POST['cs_contact_nonce'])) : '';
  if (!creative_studio_verify_contact_nonce($nonce)) {
    wp_safe_redirect(add_query_arg('contact', 'error', $redirect));
    exit;
  }

  $payload = creative_studio_sanitize_contact_payload([
    'name'    => isset($_POST['name']) ? wp_unslash($_POST['name']) : '',
    'email'   => isset($_POST['email']) ? wp_unslash($_POST['email']) : '',
    'company' => isset($_POST['company']) ? wp_unslash($_POST['company']) : '',
    'message' => isset($_POST['message']) ? wp_unslash($_POST['message']) : '',
  ]);

  if (creative_studio_contact_rate_limited()) {
    wp_safe_redirect(add_query_arg('contact', 'rate', $redirect));
    exit;
  }

  $validated = creative_studio_validate_contact($payload);
  if (!$validated['ok']) {
    $query = ['contact' => 'error'];
    foreach ($validated['fields'] as $field => $message) {
      $query['field_' . $field] = $message;
    }
    wp_safe_redirect(add_query_arg($query, $redirect));
    exit;
  }

  $stored = creative_studio_store_contact($validated['data']);
  if (is_wp_error($stored)) {
    wp_safe_redirect(add_query_arg('contact', 'error', $redirect));
    exit;
  }

  wp_safe_redirect(add_query_arg('contact', 'success', $redirect));
  exit;
}
add_action('admin_post_nopriv_creative_studio_contact', 'creative_studio_admin_post_contact');
add_action('admin_post_creative_studio_contact', 'creative_studio_admin_post_contact');
