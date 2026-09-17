<?php
/**
 * Creative Studio theme bootstrap.
 *
 * Loads setup, assets, content types, seed data, and contact handling.
 * React source remains the design reference; this file only wires WordPress.
 */

if (!defined('ABSPATH')) {
  exit;
}

define('CREATIVE_STUDIO_VERSION', '1.1.0');
define('CREATIVE_STUDIO_DIR', get_template_directory());
define('CREATIVE_STUDIO_URI', get_template_directory_uri());

require_once CREATIVE_STUDIO_DIR . '/inc/setup.php';
require_once CREATIVE_STUDIO_DIR . '/inc/enqueue.php';
require_once CREATIVE_STUDIO_DIR . '/inc/cpt.php';
require_once CREATIVE_STUDIO_DIR . '/inc/data.php';
require_once CREATIVE_STUDIO_DIR . '/inc/contact.php';
