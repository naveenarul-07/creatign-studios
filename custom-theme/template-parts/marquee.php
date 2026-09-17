<?php
/**
 * Capabilities marquee. Matches Marquee.jsx.
 */

if (!defined('ABSPATH')) {
  exit;
}

$items   = creative_studio_get_marquee_items();
$content = array_merge($items, $items);
?>
<section class="js-marquee relative overflow-hidden border-y border-line py-6 md:py-8" aria-label="Capabilities marquee">
  <div class="js-marquee-scale flex w-max gap-10 will-change-transform transition-transform duration-500 scale-100" style="transform-origin: center left">
    <div class="js-marquee-track flex w-max gap-10">
      <?php foreach ($content as $index => $item) : ?>
        <span class="flex items-center gap-10 font-display text-[clamp(1.8rem,5vw,4.4rem)] font-medium tracking-[-0.05em] whitespace-nowrap">
          <?php echo esc_html($item); ?>
          <span class="text-accent">—</span>
        </span>
      <?php endforeach; ?>
    </div>
  </div>
</section>
