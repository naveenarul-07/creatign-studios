<?php
/**
 * Stylesheet and font loading.
 *
 * JavaScript from later conversion steps is not enqueued here yet.
 */

if (!defined('ABSPATH')) {
  exit;
}

function creative_studio_font_url() {
  return 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Space+Grotesk:wght@400;500;600;700&display=swap';
}

function creative_studio_resource_hints($urls, $relation_type) {
  if ('preconnect' === $relation_type) {
    $urls[] = [
      'href' => 'https://fonts.googleapis.com',
    ];
    $urls[] = [
      'href'        => 'https://fonts.gstatic.com',
      'crossorigin' => 'anonymous',
    ];
  }

  return $urls;
}
add_filter('wp_resource_hints', 'creative_studio_resource_hints', 10, 2);

function creative_studio_enqueue_assets() {
  wp_enqueue_style(
    'creative-studio-fonts',
    creative_studio_font_url(),
    [],
    null
  );

  wp_enqueue_style(
    'creative-studio',
    CREATIVE_STUDIO_URI . '/assets/css/main.css',
    ['creative-studio-fonts'],
    CREATIVE_STUDIO_VERSION
  );
}
add_action('wp_enqueue_scripts', 'creative_studio_enqueue_assets');

/**
 * Google Fonts rejects the cache-busting ver query WordPress appends.
 */
function creative_studio_style_loader_src($src, $handle) {
  if ('creative-studio-fonts' === $handle) {
    return remove_query_arg('ver', $src);
  }

  return $src;
}
add_filter('style_loader_src', 'creative_studio_style_loader_src', 10, 2);
