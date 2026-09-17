<?php
/**
 * Selected work. Matches Work.jsx.
 */

if (!defined('ABSPATH')) {
  exit;
}

$heading  = isset($args['heading']) ? $args['heading'] : 'SELECTED WORK';
$limit    = isset($args['limit']) ? (int) $args['limit'] : 0;
$projects = $limit > 0 ? creative_studio_get_projects($limit) : creative_studio_get_projects();
?>
<section id="work" class="px-5 py-20 md:px-10 md:py-28">
  <div class="mb-12 flex items-end justify-between gap-6">
    <div class="overflow-hidden">
      <h2 class="js-work-heading font-display text-[clamp(2.2rem,6vw,6rem)] font-medium tracking-[-0.05em]" style="transform: translateY(110%)">
        <?php echo esc_html($heading); ?>
      </h2>
    </div>
    <span class="hidden font-display text-xs tracking-[0.24em] text-muted md:block">
      03 — PORTFOLIO
    </span>
  </div>
  <div class="grid grid-cols-1 gap-10 md:grid-cols-2 md:gap-8">
    <?php foreach ($projects as $index => $project) : ?>
      <?php
      get_template_part('template-parts/project-card', null, [
        'project' => $project,
        'index'   => $index,
      ]);
      ?>
    <?php endforeach; ?>
  </div>
  <?php if ($limit) : ?>
    <div class="mt-14">
      <span class="js-magnetic-wrap inline-flex">
        <a
          href="<?php echo esc_url(creative_studio_url('/work')); ?>"
          class="js-magnetic focus-ring inline-flex items-center justify-center rounded-full border border-line px-7 py-4 font-display text-xs tracking-[0.22em] hover:border-accent hover:text-accent"
        >
          VIEW ALL WORK →
        </a>
      </span>
    </div>
  <?php endif; ?>
</section>
