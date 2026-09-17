<?php
/**
 * Fallback single template. Project case studies use single-project.php.
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
      <h1 class="font-display text-[clamp(2.6rem,7vw,6.5rem)] font-medium leading-[0.9] tracking-[-0.06em]">
        <?php echo esc_html(get_the_title()); ?>
      </h1>
      <div class="mt-10 max-w-2xl space-y-6 text-paper-dim">
        <?php echo wp_kses_post(apply_filters('the_content', get_the_content())); ?>
      </div>
    </article>
    <?php
  }
}

get_footer();
