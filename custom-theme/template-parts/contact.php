<?php
/**
 * Home contact CTA band. Matches Contact.jsx. Not the contact form.
 */

if (!defined('ABSPATH')) {
  exit;
}

$social_links  = creative_studio_get_social_links();
$contact_email = creative_studio_get_contact_email();
?>
<section
  id="contact"
  class="relative overflow-hidden bg-accent px-5 py-28 text-ink md:px-10 md:py-40"
>
  <p class="font-display text-[11px] tracking-[0.28em]">07 — CONTACT</p>
  <h2 class="mt-8 font-display text-[clamp(2.4rem,8vw,8.5rem)] font-medium leading-[0.88] tracking-[-0.06em]">
    HAVE A PROJECT
    <br />
    IN MIND?
  </h2>
  <p class="mt-8 font-display text-[clamp(1.4rem,3vw,2.6rem)] tracking-[-0.03em]">
    LET'S MAKE SOMETHING REMARKABLE.
  </p>
  <div class="mt-12 flex flex-wrap items-center gap-6">
    <span class="js-magnetic-wrap inline-flex">
      <a
        href="<?php echo esc_url(creative_studio_url('/contact')); ?>"
        class="js-magnetic focus-ring inline-flex items-center justify-center rounded-full bg-ink px-8 py-4 font-display text-xs tracking-[0.22em] text-paper hover:bg-ink-soft"
      >
        START A PROJECT →
      </a>
    </span>
    <a
      href="<?php echo esc_url('mailto:' . $contact_email); ?>"
      class="focus-ring font-display text-sm tracking-[0.08em] underline-offset-4 hover:underline"
      data-cursor="link"
    >
      <?php echo esc_html($contact_email); ?>
    </a>
  </div>
  <ul class="mt-16 flex flex-wrap gap-6 font-display text-xs tracking-[0.2em]">
    <?php foreach ($social_links as $link) : ?>
      <li>
        <a
          href="<?php echo esc_url($link['href']); ?>"
          target="_blank"
          rel="noreferrer"
          class="focus-ring hover:underline"
          data-cursor="link"
        >
          <?php echo esc_html($link['label']); ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</section>
