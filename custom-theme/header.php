<?php
/**
 * Document head and global chrome (skip link, grain, cursor, loader, navbar).
 */

if (!defined('ABSPATH')) {
  exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php wp_head(); ?>
  <script>
    (function () {
      if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.documentElement.dataset.ready = 'true';
        document.documentElement.classList.add('is-reduced-motion');
      }
    })();
  </script>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page">
  <a
    href="#main"
    class="focus-ring sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-[120] focus:bg-accent focus:px-4 focus:py-2 focus:text-ink"
  >
    Skip to content
  </a>
  <?php get_template_part('template-parts/grain'); ?>
  <?php get_template_part('template-parts/cursor'); ?>
  <?php get_template_part('template-parts/loader'); ?>
  <?php get_template_part('template-parts/navbar'); ?>
  <main id="main">
