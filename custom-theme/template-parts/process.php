<?php
/**
 * Process. Matches Process.jsx. Desktop pin/track is applied in process.js.
 */

if (!defined('ABSPATH')) {
  exit;
}

$steps = creative_studio_get_process_steps();
?>
<section class="js-process relative bg-ink-soft" id="process">
  <div class="js-process-pin">
    <div class="flex items-center justify-between px-5 py-8 md:px-10">
      <h2 class="font-display text-[clamp(2rem,5vw,4.5rem)] font-medium tracking-[-0.05em]">
        HOW WE WORK
      </h2>
      <span class="font-display text-xs tracking-[0.24em] text-muted">05 — PROCESS</span>
    </div>
    <div class="mx-5 mb-4 h-px bg-line md:mx-10">
      <div class="js-process-bar h-px origin-left bg-accent w-full"></div>
    </div>
    <div class="js-process-track flex flex-col gap-6 px-5 pb-16 md:gap-10 md:px-10 md:pb-24">
      <?php foreach ($steps as $step) : ?>
        <article class="w-full shrink-0 border border-line bg-ink p-8 md:w-[min(85vw,32rem)] md:p-12">
          <p class="font-display text-accent"><?php echo esc_html($step['number']); ?></p>
          <h3 class="mt-8 font-display text-[clamp(2rem,4vw,4rem)] tracking-[-0.05em]">
            <?php echo esc_html($step['name']); ?>
          </h3>
          <p class="mt-6 max-w-sm text-sm leading-relaxed text-paper-dim"><?php echo esc_html($step['body']); ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
