<?php
/**
 * Hero canvas. Matches HeroCanvas.jsx markup.
 * Animation is bound when the hero section (Step 3) is present.
 */

if (!defined('ABSPATH')) {
  exit;
}
?>
<canvas
  class="js-hero-canvas pointer-events-none absolute inset-0 h-full w-full opacity-50 md:opacity-100"
  aria-hidden="true"
></canvas>
