<?php
/**
 * Services accordion. Matches Services.jsx.
 */

if (!defined('ABSPATH')) {
  exit;
}

$services = creative_studio_get_services();
?>
<section id="services" class="js-services relative py-20 md:py-28">
  <div class="mb-10 flex items-end justify-between px-5 md:px-10">
    <h2 class="font-display text-[clamp(2.2rem,6vw,6rem)] font-medium tracking-[-0.05em]">
      WHAT WE DO
    </h2>
    <span class="hidden font-display text-xs tracking-[0.24em] text-muted md:block">
      02 — SERVICES
    </span>
  </div>
  <div class="border-t border-line">
    <?php foreach ($services as $service) : ?>
      <article class="js-service-row border-b border-line" data-service-id="<?php echo esc_attr($service['id']); ?>">
        <button
          type="button"
          class="js-service-toggle group w-full text-left"
          aria-expanded="false"
        >
          <div class="js-service-head grid grid-cols-[auto_1fr_auto] items-center gap-4 px-5 py-6 transition-[background-color,padding] duration-500 md:px-10 bg-transparent md:py-8">
            <span class="js-service-number font-display text-xs tracking-[0.22em] transition-transform duration-500 text-muted">
              <?php echo esc_html($service['number']); ?>
            </span>
            <span class="font-display text-[clamp(1.4rem,3.4vw,3.4rem)] font-medium tracking-[-0.04em]">
              <?php echo esc_html($service['name']); ?>
            </span>
            <svg class="js-service-arrow transition-transform duration-500" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M7 7h10v10" />
              <path d="M7 17 17 7" />
            </svg>
          </div>
        </button>
        <div class="js-service-body grid overflow-hidden transition-[grid-template-rows] duration-500 ease-[cubic-bezier(0.16,1,0.3,1)] grid-rows-[0fr]">
          <div class="min-h-0">
            <p class="js-service-copy max-w-2xl px-5 pb-8 text-sm leading-relaxed md:px-10 text-paper-dim">
              <?php echo esc_html($service['description']); ?>
            </p>
          </div>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>
