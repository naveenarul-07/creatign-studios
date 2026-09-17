<?php
/**
 * Testimonials. Matches Testimonials.jsx.
 */

if (!defined('ABSPATH')) {
  exit;
}

$items = creative_studio_get_testimonials();
?>
<?php if (!$items) : ?>
  <section class="px-5 py-24 text-muted md:px-10">No testimonials yet.</section>
<?php else : ?>
  <section class="js-testimonials px-5 py-24 md:px-10 md:py-36" id="testimonials">
    <p class="font-display text-[11px] tracking-[0.28em] text-muted">06 — VOICES</p>
    <div class="relative mt-10 min-h-[16rem] max-w-5xl">
      <?php foreach ($items as $index => $item) : ?>
        <blockquote
          class="js-testimonial-item <?php echo 0 === $index ? 'relative' : 'absolute inset-x-0 top-0'; ?>"
          data-index="<?php echo esc_attr((string) $index); ?>"
          data-id="<?php echo esc_attr($item['id']); ?>"
          style="<?php echo 0 === $index ? 'opacity: 0; transform: translateY(24px); filter: blur(8px);' : 'opacity: 0; pointer-events: none;'; ?>"
        >
          <p class="font-display text-[clamp(1.4rem,3.6vw,3.4rem)] font-medium leading-[1.15] tracking-[-0.04em]">
            “<?php echo esc_html($item['quote']); ?>”
          </p>
          <footer class="mt-10 font-display text-xs tracking-[0.2em] text-muted">
            <?php echo esc_html($item['name']); ?> — <?php echo esc_html($item['role']); ?>, <?php echo esc_html($item['company']); ?>
          </footer>
        </blockquote>
      <?php endforeach; ?>
    </div>
    <div class="mt-10 flex gap-2" role="tablist" aria-label="Testimonials">
      <?php foreach ($items as $i => $item) : ?>
        <button
          type="button"
          class="js-testimonial-tab h-1.5 w-10 rounded-full <?php echo 0 === $i ? 'bg-accent' : 'bg-line'; ?>"
          role="tab"
          aria-selected="<?php echo 0 === $i ? 'true' : 'false'; ?>"
          aria-label="<?php echo esc_attr('Show testimonial ' . ($i + 1)); ?>"
          data-index="<?php echo esc_attr((string) $i); ?>"
        ></button>
      <?php endforeach; ?>
    </div>
  </section>
<?php endif; ?>
