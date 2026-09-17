<?php
/**
 * Home. Section order matches pages/Home.jsx.
 */

if (!defined('ABSPATH')) {
  exit;
}

get_header();
get_template_part('template-parts/hero');
get_template_part('template-parts/marquee');
get_template_part('template-parts/intro');
get_template_part('template-parts/services');
get_template_part('template-parts/work', null, [
  'heading' => 'SELECTED WORK',
  'limit'   => 5,
]);
get_template_part('template-parts/about', null, [
  'compact' => true,
]);
get_template_part('template-parts/process');
get_template_part('template-parts/clients');
get_template_part('template-parts/testimonials');
get_template_part('template-parts/contact');
get_footer();
