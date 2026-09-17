<?php
/**
 * Theme supports, document chrome, and activation hooks.
 */

if (!defined('ABSPATH')) {
  exit;
}

function creative_studio_setup() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', [
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    'style',
    'script',
  ]);
  add_theme_support('automatic-feed-links');

  register_nav_menus([
    'primary' => __('Primary', 'creative-studio'),
    'footer'  => __('Footer', 'creative-studio'),
  ]);
}
add_action('after_setup_theme', 'creative_studio_setup');

/**
 * Match index.html: "Creative Studio — Digital Experiences" on the home page.
 */
function creative_studio_document_title_parts($parts) {
  if (is_front_page()) {
    $parts['title'] = 'Creative Studio — Digital Experiences';
    unset($parts['tagline'], $parts['site']);
  }

  return $parts;
}
add_filter('document_title_parts', 'creative_studio_document_title_parts');

function creative_studio_title_separator() {
  return '—';
}
add_filter('document_title_separator', 'creative_studio_title_separator');

/**
 * Favicon, theme-color, and default description from the React index.html.
 */
function creative_studio_head_meta() {
  $favicon = CREATIVE_STUDIO_URI . '/assets/images/favicon.svg';
  echo '<link rel="icon" type="image/svg+xml" href="' . esc_url($favicon) . '" />' . "\n";
  echo '<meta name="theme-color" content="#080808" />' . "\n";

  if (!is_singular() || !has_excerpt()) {
    $description = 'Creative Studio — we create digital experiences that move people. Branding, digital products and immersive web for ambitious brands.';
    if (is_front_page() || !is_singular()) {
      echo '<meta name="description" content="' . esc_attr($description) . '" />' . "\n";
    }
  }
}
add_action('wp_head', 'creative_studio_head_meta', 1);

function creative_studio_body_classes($classes) {
  $classes[] = 'creative-studio';
  return $classes;
}
add_filter('body_class', 'creative_studio_body_classes');

function creative_studio_activate() {
  creative_studio_register_post_types();
  creative_studio_seed_content();
  flush_rewrite_rules();
}
add_action('after_switch_theme', 'creative_studio_activate');
