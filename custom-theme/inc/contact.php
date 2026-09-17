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
  $post_id = wp_insert_post([
    'post_type'   => 'cs_contact',
    'post_status' => 'private',
    'post_title'  => $data['name'] . ' — ' . $data['email'],
    'post_content'=> $data['message'],
  ], true);

  if (is_wp_error($post_id)) {
    return $post_id;
  }

  update_post_meta($post_id, '_cs_email', $data['email']);
  update_post_meta($post_id, '_cs_company', $data['company']);
  update_post_meta($post_id, '_cs_name', $data['name']);

  $admin_email = get_option('admin_email');
  wp_mail(
    $admin_email,
    sprintf('Project inquiry from %s', $data['name']),
    implode("\n", [
      'Name: ' . $data['name'],
      'Email: ' . $data['email'],
      'Company: ' . $data['company'],
      '',
      $data['message'],
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
  if (creative_studio_contact_rate_limited()) {
    return new WP_REST_Response([
      'success' => false,
      'error'   => 'Too many messages. Please try again later.',
    ], 429);
  }

  $payload = $request->get_json_params();
  if (!is_array($payload)) {
    $payload = $request->get_params();
  }

  $validated = creative_studio_validate_contact($payload);
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
  $payload = [
    'name'    => isset($_POST['name']) ? wp_unslash($_POST['name']) : '',
    'email'   => isset($_POST['email']) ? wp_unslash($_POST['email']) : '',
    'company' => isset($_POST['company']) ? wp_unslash($_POST['company']) : '',
    'message' => isset($_POST['message']) ? wp_unslash($_POST['message']) : '',
  ];

  $redirect = wp_get_referer() ? wp_get_referer() : home_url('/contact');

  if (creative_studio_contact_rate_limited()) {
    wp_safe_redirect(add_query_arg('contact', 'rate', $redirect));
    exit;
  }

  $validated = creative_studio_validate_contact($payload);
  if (!$validated['ok']) {
    $query = ['contact' => 'error'];
    foreach ($validated['fields'] as $field => $message) {
      $query[ 'field_' . $field ] = $message;
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
