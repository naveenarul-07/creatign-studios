<?php
/**
 * Client grid. Matches Clients.jsx.
 */

if (!defined('ABSPATH')) {
  exit;
}

$clients = creative_studio_get_clients();
?>
<section class="px-5 py-20 md:px-10 md:py-28" id="clients">
  <h2 class="font-display text-xs tracking-[0.28em] text-muted">TRUSTED BY</h2>
  <ul class="mt-10 grid grid-cols-2 gap-px bg-line md:grid-cols-4">
    <?php foreach ($clients as $name) : ?>
      <li class="bg-ink">
        <div class="flex h-28 items-center justify-center text-paper/35 transition duration-500 hover:scale-[1.04] hover:text-paper">
          <span class="font-display text-xl tracking-[0.2em] md:text-2xl"><?php echo esc_html($name); ?></span>
        </div>
      </li>
    <?php endforeach; ?>
  </ul>
</section>
