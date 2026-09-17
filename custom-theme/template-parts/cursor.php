<?php
/**
 * Custom cursor. Matches CustomCursor.jsx.
 * Hidden below md; enabled only for fine pointers without reduced motion.
 */

if (!defined('ABSPATH')) {
  exit;
}
?>
<div class="js-cursor pointer-events-none fixed inset-0 z-[100] hidden md:block" aria-hidden="true">
  <div class="js-cursor-dot absolute top-0 left-0 h-1.5 w-1.5 -translate-x-1/2 -translate-y-1/2 rounded-full bg-accent"></div>
  <div class="js-cursor-ring absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2">
    <div class="js-cursor-ring-inner h-5 w-5 rounded-full border border-paper/60 transition-[width,height] duration-200 ease-out"></div>
  </div>
</div>
