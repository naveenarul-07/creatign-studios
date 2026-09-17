<?php
/**
 * Site footer and document close. Matches Footer.jsx.
 */

if (!defined('ABSPATH')) {
  exit;
}

$nav_links    = creative_studio_get_nav_links();
$social_links = array_slice(creative_studio_get_social_links(), 0, 3);
?>
  </main>
  <footer class="border-t border-line px-5 py-12 md:px-10">
    <div class="flex flex-col gap-10 md:flex-row md:items-start md:justify-between">
      <a href="<?php echo esc_url(creative_studio_url('/')); ?>" class="focus-ring font-display text-sm tracking-[0.22em]" data-cursor="link">
        CREATIVE STUDIO
      </a>
      <nav class="flex flex-col gap-2 font-display text-xs tracking-[0.2em]" aria-label="Footer">
        <?php foreach ($nav_links as $link) : ?>
          <a
            href="<?php echo esc_url(creative_studio_url($link['href'])); ?>"
            class="focus-ring text-muted hover:text-paper"
            data-cursor="link"
            <?php echo creative_studio_is_current_href($link['href']) ? 'aria-current="page"' : ''; ?>
          >
            <?php echo esc_html($link['label']); ?>
          </a>
        <?php endforeach; ?>
      </nav>
      <ul class="flex flex-col gap-2 font-display text-xs tracking-[0.2em] text-muted">
        <?php foreach ($social_links as $link) : ?>
          <li>
            <a
              href="<?php echo esc_url($link['href']); ?>"
              target="_blank"
              rel="noreferrer"
              class="focus-ring hover:text-paper"
              data-cursor="link"
            >
              <?php echo esc_html($link['label']); ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
      <p class="font-display text-xs tracking-[0.16em] text-muted">© 2026 Creative Studio</p>
    </div>
    <span class="js-magnetic-wrap js-back-to-top-wrap hidden fixed right-5 bottom-5 z-40 md:right-8 md:bottom-8">
      <button
        type="button"
        class="js-magnetic js-back-to-top focus-ring inline-flex items-center justify-center h-12 w-12 rounded-full bg-paper text-ink"
        aria-label="Back to top"
      >
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="m5 12 7-7 7 7" />
          <path d="M12 19V5" />
        </svg>
      </button>
    </span>
  </footer>
  <?php wp_footer(); ?>
</div>
</body>
</html>
