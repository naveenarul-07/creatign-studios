<?php
/**
 * 404. Matches the React ProjectPage empty-state visual language.
 */

if (!defined('ABSPATH')) {
  exit;
}

status_header(404);
nocache_headers();

get_header();
?>
<div class="flex min-h-screen flex-col justify-center px-5 pt-28 md:px-10">
  <h1 class="font-display text-5xl tracking-[-0.05em]">Page not found.</h1>
  <p class="mt-6 max-w-xl text-paper-dim">This URL is not in the archive.</p>
  <a
    href="<?php echo esc_url(creative_studio_url('/')); ?>"
    class="focus-ring mt-6 inline-block font-display text-sm tracking-[0.18em] text-accent"
  >
    BACK TO HOME →
  </a>
</div>
<?php
get_footer();
