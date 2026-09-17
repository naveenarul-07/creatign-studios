<?php
/**
 * Intro loader. Matches Loader.jsx.
 */

if (!defined('ABSPATH')) {
  exit;
}
?>
<div
  class="js-loader fixed inset-0 z-[90] flex flex-col justify-between bg-ink px-6 py-8 text-paper md:px-10"
  role="status"
  aria-live="polite"
  aria-label="Loading Creative Studio"
>
  <div class="flex items-start justify-between font-display text-xs tracking-[0.28em]">
    <span>CREATIVE STUDIO</span>
    <span class="js-loader-progress">000%</span>
  </div>
  <div>
    <p class="font-display text-[clamp(2.4rem,8vw,7rem)] font-medium leading-[0.9] tracking-[-0.05em]">
      CREATIVE
      <br />
      STUDIO
    </p>
    <div class="mt-8 h-px w-full bg-line">
      <div class="js-loader-bar h-px bg-accent" style="width: 0%"></div>
    </div>
  </div>
</div>
