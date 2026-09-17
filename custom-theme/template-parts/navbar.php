<?php
/**
 * Site header and fullscreen menu. Matches Navbar.jsx.
 */

if (!defined('ABSPATH')) {
  exit;
}

$nav_links = creative_studio_get_nav_links();
$link_class = 'focus-ring font-display text-xs tracking-[0.22em] text-paper/80 transition-colors hover:text-accent';
?>
<header
  class="js-site-header fixed top-0 right-0 left-0 z-50 px-5 py-5 md:px-10"
  style="opacity: 0; transform: translateY(-40px)"
>
  <div class="flex items-center justify-between">
    <a
      href="<?php echo esc_url(creative_studio_url('/')); ?>"
      class="focus-ring font-display text-sm tracking-[0.22em]"
      data-cursor="link"
    >
      CREATIVE STUDIO
    </a>
    <nav class="hidden items-center gap-8 lg:flex" aria-label="Primary">
      <?php foreach ($nav_links as $link) : ?>
        <a
          href="<?php echo esc_url(creative_studio_url($link['href'])); ?>"
          class="<?php echo esc_attr($link_class); ?>"
          data-cursor="link"
          <?php echo creative_studio_is_current_href($link['href']) ? 'aria-current="page"' : ''; ?>
        >
          <?php echo esc_html($link['label']); ?>
        </a>
      <?php endforeach; ?>
    </nav>
    <span class="js-magnetic-wrap inline-flex">
      <button
        type="button"
        class="js-magnetic js-menu-toggle focus-ring inline-flex h-11 w-11 items-center justify-center rounded-full border border-line"
        aria-expanded="false"
        aria-controls="site-menu"
        aria-label="Open menu"
      >
        <span class="js-menu-icon-open" aria-hidden="true">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="4" x2="20" y1="12" y2="12" />
            <line x1="4" x2="20" y1="6" y2="6" />
            <line x1="4" x2="20" y1="18" y2="18" />
          </svg>
        </span>
        <span class="js-menu-icon-close hidden" aria-hidden="true">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18" />
            <path d="m6 6 12 12" />
          </svg>
        </span>
      </button>
    </span>
  </div>
</header>

<div
  id="site-menu"
  class="js-site-menu pointer-events-none fixed inset-0 z-40 flex flex-col justify-between bg-ink px-6 py-28 md:px-12"
  style="clip-path: inset(0 0 100% 0)"
  aria-hidden="true"
>
  <nav class="flex flex-col gap-2" aria-label="Mobile">
    <?php foreach ($nav_links as $link) : ?>
      <div class="js-site-menu-item" style="opacity: 0; transform: translateY(40px)">
        <a
          href="<?php echo esc_url(creative_studio_url($link['href'])); ?>"
          class="js-site-menu-link font-display text-[clamp(2.5rem,8vw,7rem)] font-medium leading-[0.9] tracking-[-0.05em] text-paper transition-colors hover:text-accent"
        >
          <?php echo esc_html($link['label']); ?>
        </a>
      </div>
    <?php endforeach; ?>
  </nav>
  <p class="font-display text-xs tracking-[0.22em] text-muted">
    HELLO@CREATIVESTUDIO.COM
  </p>
</div>
