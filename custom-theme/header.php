<?php
/**
 * Document head and site chrome shell.
 * Loader, cursor, and navbar are added in a later step.
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
  <main id="main">
