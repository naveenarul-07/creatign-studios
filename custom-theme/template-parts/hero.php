<?php
/**
 * Hero. Matches Hero.jsx.
 */

if (!defined('ABSPATH')) {
  exit;
}

$headlines = ['WE CREATE', 'DIGITAL EXPERIENCES', 'THAT MOVE PEOPLE.'];
?>
<section class="relative flex min-h-[100svh] flex-col justify-end overflow-hidden px-5 pb-8 pt-24 md:px-10 md:pb-12">
  <div class="js-hero-canvas-wrap absolute inset-0" style="opacity: 0">
    <?php get_template_part('template-parts/hero-canvas'); ?>
    <div class="absolute inset-0 bg-gradient-to-b from-ink via-ink/75 to-ink md:via-ink/45"></div>
  </div>

  <div class="relative z-10 max-w-[92rem]">
    <p class="js-hero-eyebrow font-display text-[11px] tracking-[0.32em] text-accent" style="opacity: 0; transform: translateY(16px)">
      CREATIVE DIGITAL STUDIO
    </p>

    <h1 class="mt-5 font-display text-[clamp(2.3rem,6.6vw,7.2rem)] font-medium leading-[0.88] tracking-[-0.06em]">
      <?php foreach ($headlines as $line) : ?>
        <span class="block overflow-hidden">
          <span class="js-hero-line block" style="transform: translateY(115%)"><?php echo esc_html($line); ?></span>
        </span>
      <?php endforeach; ?>
    </h1>

    <p class="js-hero-body mt-6 max-w-xl text-sm leading-relaxed text-paper-dim md:text-base" style="opacity: 0; transform: translateY(24px)">
      Branding, digital products and immersive experiences for companies that want to be felt,
      not just seen.
    </p>

    <div class="js-hero-ctas mt-8 flex flex-wrap items-center gap-4" style="opacity: 0; transform: translateY(20px)">
      <span class="js-magnetic-wrap inline-flex">
        <a
          href="<?php echo esc_url(creative_studio_url('/work')); ?>"
          class="js-magnetic focus-ring inline-flex items-center justify-center whitespace-nowrap rounded-full bg-accent px-7 py-4 font-display text-xs tracking-[0.22em] text-[#080808] transition-colors hover:bg-paper"
        >
          EXPLORE OUR WORK →
        </a>
      </span>
      <span class="js-magnetic-wrap inline-flex">
        <a
          href="<?php echo esc_url(creative_studio_url('/contact')); ?>"
          class="js-magnetic focus-ring inline-flex items-center justify-center whitespace-nowrap rounded-full border border-line px-7 py-4 font-display text-xs tracking-[0.22em] text-paper hover:border-accent hover:text-accent"
        >
          LET'S TALK
        </a>
      </span>
    </div>
  </div>

  <div class="js-hero-scroll relative z-10 mt-10 flex items-center gap-3 font-display text-[11px] tracking-[0.28em] text-muted" style="opacity: 0">
    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="motion-safe:animate-bounce" aria-hidden="true">
      <path d="M12 5v14" />
      <path d="m19 12-7 7-7-7" />
    </svg>
    SCROLL
  </div>
</section>
