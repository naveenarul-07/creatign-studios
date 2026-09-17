<?php
/**
 * Fallback index template. Front page uses front-page.php when assigned.
 */

if (!defined('ABSPATH')) {
  exit;
}

get_header();

if (have_posts()) {
  while (have_posts()) {
    the_post();
    ?>
    <article class="px-5 pt-32 pb-20 md:px-10">
      <h2 class="font-display text-[clamp(2.2rem,6vw,5rem)] tracking-[-0.05em]">
        <a href="<?php echo esc_url(get_permalink()); ?>" class="focus-ring">
          <?php echo esc_html(get_the_title()); ?>
        </a>
      </h2>
      <div class="mt-6 max-w-2xl text-paper-dim">
        <?php echo wp_kses_post(get_the_excerpt()); ?>
      </div>
    </article>
    <?php
  }
} else {
  ?>
  <div class="flex min-h-screen flex-col justify-center px-5 pt-28 md:px-10">
    <a
      href="<?php echo esc_url(creative_studio_url('/')); ?>"
      class="focus-ring font-display text-sm tracking-[0.18em] text-accent"
    >
      BACK TO HOME →
    </a>
  </div>
  <?php
}

get_footer();
