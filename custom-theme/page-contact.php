<?php
/**
 * Contact page. Matches pages/ContactPage.jsx.
 */

if (!defined('ABSPATH')) {
  exit;
}

$social_links = creative_studio_get_social_links();
$contact_email = creative_studio_get_contact_email();
$contact_state = isset($_GET['contact']) ? sanitize_text_field(wp_unslash($_GET['contact'])) : '';
$field_errors  = [];
foreach (['name', 'email', 'company', 'message'] as $field_name) {
  $query_key = 'field_' . $field_name;
  if (!empty($_GET[$query_key])) {
    $field_errors[$field_name] = sanitize_text_field(wp_unslash($_GET[$query_key]));
  }
}

$form_error = '';
if ('error' === $contact_state) {
  $form_error = 'Validation failed.';
} elseif ('rate' === $contact_state) {
  $form_error = 'Too many messages. Please try again later.';
}

$is_success = 'success' === $contact_state;

get_header();
?>
<div class="grid min-h-screen gap-12 px-5 pt-32 pb-20 md:grid-cols-2 md:px-10 md:pt-40">
  <div>
    <p class="font-display text-[11px] tracking-[0.28em] text-accent">START A PROJECT</p>
    <h1 class="mt-6 font-display text-[clamp(2.6rem,7vw,6.5rem)] font-medium leading-[0.9] tracking-[-0.06em]">
      TELL US WHAT
      <br />
      YOU WANT TO
      <br />
      MAKE.
    </h1>
    <p class="mt-8 max-w-md text-paper-dim">
      Share a few lines about the brand, the problem and the timeline. We typically reply within
      two working days.
    </p>
    <a
      href="<?php echo esc_url('mailto:' . $contact_email); ?>"
      class="mt-8 inline-block font-display text-sm tracking-[0.12em] text-accent"
    >
      <?php echo esc_html($contact_email); ?>
    </a>
    <ul class="mt-10 flex flex-wrap gap-5 font-display text-xs tracking-[0.2em] text-muted">
      <?php foreach ($social_links as $link) : ?>
        <li>
          <a
            href="<?php echo esc_url($link['href']); ?>"
            target="_blank"
            rel="noreferrer"
            class="focus-ring hover:text-paper"
          >
            <?php echo esc_html($link['label']); ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <form
    class="js-contact-form space-y-6"
    method="post"
    action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
    novalidate
  >
    <input type="hidden" name="action" value="creative_studio_contact" />
    <?php wp_nonce_field('creative_studio_contact', 'cs_contact_nonce'); ?>

    <?php
    $fields = [
      ['label' => 'Name', 'name' => 'name', 'type' => 'text', 'required' => true],
      ['label' => 'Email', 'name' => 'email', 'type' => 'email', 'required' => true],
      ['label' => 'Company', 'name' => 'company', 'type' => 'text', 'required' => false],
    ];
    foreach ($fields as $field) :
      $error_text = isset($field_errors[$field['name']]) ? $field_errors[$field['name']] : '';
      $error_id   = $field['name'] . '-error';
      ?>
      <label class="block" for="<?php echo esc_attr($field['name']); ?>">
        <span class="font-display text-[11px] tracking-[0.22em] text-muted"><?php echo esc_html($field['label']); ?></span>
        <input
          id="<?php echo esc_attr($field['name']); ?>"
          name="<?php echo esc_attr($field['name']); ?>"
          type="<?php echo esc_attr($field['type']); ?>"
          autocomplete="<?php echo esc_attr($field['name']); ?>"
          class="w-full border-b border-line bg-transparent py-3 text-paper outline-none transition-colors focus:border-accent"
          <?php echo $field['required'] ? 'required' : ''; ?>
          <?php echo $error_text ? 'aria-invalid="true"' : ''; ?>
          <?php echo $error_text ? 'aria-describedby="' . esc_attr($error_id) . '"' : ''; ?>
        />
        <span
          id="<?php echo esc_attr($error_id); ?>"
          class="mt-2 block text-xs text-accent-hot<?php echo $error_text ? '' : ' hidden'; ?>"
          data-field-error="<?php echo esc_attr($field['name']); ?>"
          <?php echo $error_text ? '' : 'hidden'; ?>
        ><?php echo $error_text ? esc_html($error_text) : ''; ?></span>
      </label>
    <?php endforeach; ?>

    <?php
    $message_error = isset($field_errors['message']) ? $field_errors['message'] : '';
    $message_error_id = 'message-error';
    ?>
    <label class="block" for="message">
      <span class="font-display text-[11px] tracking-[0.22em] text-muted">Message</span>
      <textarea
        id="message"
        name="message"
        rows="5"
        autocomplete="message"
        class="w-full border-b border-line bg-transparent py-3 text-paper outline-none transition-colors focus:border-accent"
        required
        <?php echo $message_error ? 'aria-invalid="true"' : ''; ?>
        <?php echo $message_error ? 'aria-describedby="' . esc_attr($message_error_id) . '"' : ''; ?>
      ></textarea>
      <span
        id="<?php echo esc_attr($message_error_id); ?>"
        class="mt-2 block text-xs text-accent-hot<?php echo $message_error ? '' : ' hidden'; ?>"
        data-field-error="message"
        <?php echo $message_error ? '' : 'hidden'; ?>
      ><?php echo $message_error ? esc_html($message_error) : ''; ?></span>
    </label>

    <p
      class="js-contact-error text-sm text-accent-hot<?php echo $form_error ? '' : ' hidden'; ?>"
      role="alert"
      <?php echo $form_error ? '' : 'hidden'; ?>
    ><?php echo $form_error ? esc_html($form_error) : ''; ?></p>
    <p
      class="js-contact-success text-sm text-accent<?php echo $is_success ? '' : ' hidden'; ?>"
      role="status"
      <?php echo $is_success ? '' : 'hidden'; ?>
    >Thanks — we will be in touch shortly.</p>

    <span class="js-magnetic-wrap inline-flex">
      <button
        type="submit"
        class="js-magnetic js-contact-submit focus-ring inline-flex items-center justify-center rounded-full bg-accent px-8 py-4 font-display text-xs tracking-[0.22em] text-ink disabled:opacity-50"
      >
        SEND MESSAGE →
      </button>
    </span>
  </form>
</div>
<?php
get_footer();
