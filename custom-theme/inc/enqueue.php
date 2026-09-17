<?php
/**
 * Stylesheet, font, vendor, and theme script loading.
 */

if (!defined('ABSPATH')) {
  exit;
}

function creative_studio_font_url() {
  return 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Space+Grotesk:wght@400;500;600;700&display=swap';
}

function creative_studio_asset($relative) {
  return CREATIVE_STUDIO_URI . $relative;
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
  $version = CREATIVE_STUDIO_VERSION;

  wp_enqueue_style(
    'creative-studio-fonts',
    creative_studio_font_url(),
    [],
    null
  );

  wp_enqueue_style(
    'creative-studio-lenis',
    creative_studio_asset('/assets/css/vendor/lenis.css'),
    [],
    '1.2.3'
  );

  wp_enqueue_style(
    'creative-studio',
    creative_studio_asset('/assets/css/main.css'),
    ['creative-studio-fonts', 'creative-studio-lenis'],
    $version
  );

  wp_enqueue_script(
    'creative-studio-gsap',
    creative_studio_asset('/assets/js/vendor/gsap.min.js'),
    [],
    '3.12.7',
    true
  );

  wp_enqueue_script(
    'creative-studio-scrolltrigger',
    creative_studio_asset('/assets/js/vendor/ScrollTrigger.min.js'),
    ['creative-studio-gsap'],
    '3.12.7',
    true
  );

  wp_enqueue_script(
    'creative-studio-lenis',
    creative_studio_asset('/assets/js/vendor/lenis.min.js'),
    [],
    '1.2.3',
    true
  );

  wp_enqueue_script(
    'creative-studio-main',
    creative_studio_asset('/assets/js/main.js'),
    ['creative-studio-gsap', 'creative-studio-scrolltrigger', 'creative-studio-lenis'],
    $version,
    true
  );

  wp_enqueue_script(
    'creative-studio-loader',
    creative_studio_asset('/assets/js/loader.js'),
    ['creative-studio-main', 'creative-studio-gsap'],
    $version,
    true
  );

  wp_enqueue_script(
    'creative-studio-cursor',
    creative_studio_asset('/assets/js/cursor.js'),
    ['creative-studio-main'],
    $version,
    true
  );

  wp_enqueue_script(
    'creative-studio-magnetic',
    creative_studio_asset('/assets/js/magnetic.js'),
    ['creative-studio-main'],
    $version,
    true
  );

  wp_enqueue_script(
    'creative-studio-navbar',
    creative_studio_asset('/assets/js/navbar.js'),
    ['creative-studio-main', 'creative-studio-gsap'],
    $version,
    true
  );

  wp_enqueue_script(
    'creative-studio-lenis-init',
    creative_studio_asset('/assets/js/lenis-init.js'),
    ['creative-studio-main', 'creative-studio-gsap', 'creative-studio-scrolltrigger', 'creative-studio-lenis'],
    $version,
    true
  );

  wp_enqueue_script(
    'creative-studio-hero-canvas',
    creative_studio_asset('/assets/js/hero-canvas.js'),
    ['creative-studio-main'],
    $version,
    true
  );

  wp_enqueue_script(
    'creative-studio-marquee',
    creative_studio_asset('/assets/js/marquee.js'),
    ['creative-studio-main'],
    $version,
    true
  );

  wp_enqueue_script(
    'creative-studio-split-text',
    creative_studio_asset('/assets/js/split-text.js'),
    ['creative-studio-main', 'creative-studio-gsap', 'creative-studio-scrolltrigger'],
    $version,
    true
  );

  wp_enqueue_script(
    'creative-studio-services',
    creative_studio_asset('/assets/js/services.js'),
    ['creative-studio-main'],
    $version,
    true
  );

  wp_enqueue_script(
    'creative-studio-project-cards',
    creative_studio_asset('/assets/js/project-cards.js'),
    ['creative-studio-main', 'creative-studio-gsap'],
    $version,
    true
  );

  wp_enqueue_script(
    'creative-studio-count-up',
    creative_studio_asset('/assets/js/count-up.js'),
    ['creative-studio-main', 'creative-studio-gsap'],
    $version,
    true
  );

  wp_enqueue_script(
    'creative-studio-process',
    creative_studio_asset('/assets/js/process.js'),
    ['creative-studio-main', 'creative-studio-gsap', 'creative-studio-scrolltrigger'],
    $version,
    true
  );

  wp_enqueue_script(
    'creative-studio-testimonials',
    creative_studio_asset('/assets/js/testimonials.js'),
    ['creative-studio-main', 'creative-studio-gsap'],
    $version,
    true
  );

  if (is_singular('project')) {
    wp_enqueue_script(
      'creative-studio-project-page',
      creative_studio_asset('/assets/js/project-page.js'),
      ['creative-studio-main', 'creative-studio-gsap'],
      $version,
      true
    );
  }

  if (is_page('contact')) {
    wp_enqueue_script(
      'creative-studio-contact-page',
      creative_studio_asset('/assets/js/contact-page.js'),
      ['creative-studio-main'],
      $version,
      true
    );
    wp_localize_script('creative-studio-contact-page', 'CreativeStudioContact', [
      'restUrl' => esc_url_raw(rest_url('creative-studio/v1/contact')),
      'nonce'   => wp_create_nonce('creative_studio_contact'),
    ]);
  }
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
