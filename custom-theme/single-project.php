<?php
/**
 * Single project case study. Matches pages/ProjectPage.jsx.
 */

if (!defined('ABSPATH')) {
  exit;
}

$project = null;
if (have_posts()) {
  the_post();
  $project = creative_studio_map_project_post(get_the_ID());
}

if (!$project || '' === (string) $project['id']) {
  global $wp_query;
  if ($wp_query instanceof WP_Query) {
    $wp_query->set_404();
  }
  status_header(404);
  nocache_headers();
  $not_found = locate_template('404.php');
  if ($not_found) {
    include $not_found;
  }
  exit;
}

$next          = creative_studio_get_next_project($project['id']);
$display_name  = '' !== (string) $project['name'] ? $project['name'] : $project['title'];
$category      = trim((string) $project['category']);
$year          = trim((string) $project['year']);
$eyebrow_parts = array_values(array_filter([$category, $year], 'strlen'));
$excerpt       = trim((string) $project['excerpt']);
$description   = trim((string) $project['description']);
$client        = trim((string) $project['client']);
$services      = is_array($project['services']) ? array_values(array_filter($project['services'], 'strlen')) : [];
$challenge     = trim((string) $project['challenge']);
$approach      = trim((string) $project['approach']);
$process       = is_array($project['process']) ? $project['process'] : [];
$results       = is_array($project['results']) ? $project['results'] : [];
$visual        = '' !== (string) $project['visual'] ? $project['visual'] : 'neon';

$process = array_values(array_filter($process, function ($step) {
  if (!is_array($step)) {
    return false;
  }
  $title = isset($step['title']) ? trim((string) $step['title']) : '';
  $body  = isset($step['body']) ? trim((string) $step['body']) : '';
  return '' !== $title || '' !== $body;
}));

$results = array_values(array_filter($results, function ($result) {
  if (!is_array($result)) {
    return false;
  }
  $label = isset($result['label']) ? trim((string) $result['label']) : '';
  $value = isset($result['value']) ? trim((string) $result['value']) : '';
  return '' !== $label || '' !== $value;
}));

$has_meta = '' !== $client || $services || '' !== $year;

$next_url = '';
if ($next) {
  $next_post = get_page_by_path($next['id'], OBJECT, 'project');
  $next_url  = $next_post instanceof WP_Post
    ? get_permalink($next_post)
    : creative_studio_project_permalink($next);
}

get_header();
?>
<article class="pt-24">
  <header class="px-5 pt-10 pb-12 md:px-10">
    <?php if ($eyebrow_parts) : ?>
      <p class="font-display text-[11px] tracking-[0.28em] text-accent">
        <?php echo esc_html(implode(' — ', $eyebrow_parts)); ?>
      </p>
    <?php endif; ?>
    <h1 class="mt-6 font-display text-[clamp(3rem,10vw,9rem)] font-medium leading-[0.86] tracking-[-0.06em]">
      <?php echo esc_html($display_name); ?>
    </h1>
    <?php if ('' !== $excerpt) : ?>
      <p class="mt-6 max-w-2xl text-paper-dim"><?php echo esc_html($excerpt); ?></p>
    <?php endif; ?>
  </header>

  <div
    class="js-project-hero-media h-[58vh] min-h-[22rem] overflow-hidden md:h-[78vh]"
    style="clip-path: inset(100% 0 0 0); transform: scale(1.08)"
  >
    <?php
    get_template_part('template-parts/project-visual', null, [
      'visual'   => $visual,
      'title'    => $display_name,
      'class'    => 'h-full w-full',
      'animated' => true,
    ]);
    ?>
  </div>

  <?php if ('' !== $description || $has_meta) : ?>
    <section class="grid gap-12 px-5 py-16 md:grid-cols-[1.2fr_0.8fr] md:px-10 md:py-24">
      <?php if ('' !== $description) : ?>
        <p class="max-w-2xl text-lg leading-relaxed text-paper-dim"><?php echo esc_html($description); ?></p>
      <?php endif; ?>
      <?php if ($has_meta) : ?>
        <dl class="space-y-6 font-display text-xs tracking-[0.18em]">
          <?php if ('' !== $client) : ?>
            <div>
              <dt class="text-muted">CLIENT</dt>
              <dd class="mt-2 text-sm tracking-[0.08em]"><?php echo esc_html($client); ?></dd>
            </div>
          <?php endif; ?>
          <?php if ($services) : ?>
            <div>
              <dt class="text-muted">SERVICES</dt>
              <dd class="mt-2 text-sm tracking-[0.08em]"><?php echo esc_html(implode(' / ', $services)); ?></dd>
            </div>
          <?php endif; ?>
          <?php if ('' !== $year) : ?>
            <div>
              <dt class="text-muted">YEAR</dt>
              <dd class="mt-2 text-sm tracking-[0.08em]"><?php echo esc_html($year); ?></dd>
            </div>
          <?php endif; ?>
        </dl>
      <?php endif; ?>
    </section>
  <?php endif; ?>

  <section class="grid gap-4 px-5 md:grid-cols-2 md:px-10">
    <div class="min-h-[22rem]">
      <?php
      get_template_part('template-parts/project-visual', null, [
        'visual'   => $visual,
        'class'    => 'h-full min-h-[22rem]',
        'animated' => false,
      ]);
      ?>
    </div>
    <?php if ('' !== $challenge) : ?>
      <div class="min-h-[22rem] bg-ink-soft p-8 md:p-12">
        <p class="font-display text-xs tracking-[0.22em] text-muted">CHALLENGE</p>
        <p class="mt-6 text-lg leading-relaxed"><?php echo esc_html($challenge); ?></p>
      </div>
    <?php endif; ?>
  </section>

  <?php if ('' !== $approach) : ?>
    <section class="px-5 py-20 md:px-10">
      <p class="font-display text-xs tracking-[0.22em] text-muted">APPROACH</p>
      <p class="mt-6 max-w-3xl text-2xl leading-snug tracking-[-0.03em] md:text-4xl">
        <?php echo esc_html($approach); ?>
      </p>
    </section>
  <?php endif; ?>

  <section class="px-5 md:px-10">
    <div class="relative min-h-[18rem] overflow-hidden md:min-h-[28rem]">
      <?php
      get_template_part('template-parts/project-visual', null, [
        'visual'   => $visual,
        'class'    => 'h-full min-h-[18rem] md:min-h-[28rem]',
        'animated' => true,
      ]);
      ?>
      <div class="absolute inset-0 flex items-end p-8">
        <p class="font-display text-xs tracking-[0.28em] text-paper">
          MOVING STUDY — <?php echo esc_html($display_name); ?>
        </p>
      </div>
    </div>
  </section>

  <?php if ($process) : ?>
    <section class="px-5 py-20 md:px-10">
      <h2 class="font-display text-4xl tracking-[-0.04em] md:text-6xl">DESIGN PROCESS</h2>
      <ol class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-5">
        <?php foreach ($process as $index => $step) : ?>
          <?php
          $step_title = isset($step['title']) ? trim((string) $step['title']) : '';
          $step_body  = isset($step['body']) ? trim((string) $step['body']) : '';
          ?>
          <li class="border-t border-line pt-6">
            <p class="font-display text-xs text-accent"><?php echo esc_html(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?></p>
            <?php if ('' !== $step_title) : ?>
              <h3 class="mt-3 font-display text-xl"><?php echo esc_html($step_title); ?></h3>
            <?php endif; ?>
            <?php if ('' !== $step_body) : ?>
              <p class="mt-3 text-sm text-paper-dim"><?php echo esc_html($step_body); ?></p>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ol>
    </section>
  <?php endif; ?>

  <?php if ($results) : ?>
    <section class="px-5 pb-20 md:px-10">
      <h2 class="font-display text-4xl tracking-[-0.04em]">RESULTS</h2>
      <div class="mt-10 grid gap-8 border-t border-line pt-10 md:grid-cols-3">
        <?php foreach ($results as $result) : ?>
          <?php
          $result_label = isset($result['label']) ? trim((string) $result['label']) : '';
          $result_value = isset($result['value']) ? trim((string) $result['value']) : '';
          ?>
          <div>
            <?php if ('' !== $result_value) : ?>
              <p class="font-display text-5xl tracking-[-0.05em] text-accent"><?php echo esc_html($result_value); ?></p>
            <?php endif; ?>
            <?php if ('' !== $result_label) : ?>
              <p class="mt-2 text-sm text-muted"><?php echo esc_html($result_label); ?></p>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>

  <?php if ($next) : ?>
    <section class="flex flex-col justify-between gap-8 border-t border-line px-5 py-16 md:flex-row md:items-end md:px-10">
      <div>
        <p class="font-display text-xs tracking-[0.22em] text-muted">NEXT PROJECT</p>
        <h2 class="mt-4 font-display text-[clamp(2.2rem,6vw,5rem)] tracking-[-0.05em]">
          <?php echo esc_html($next['title']); ?>
        </h2>
      </div>
      <span class="js-magnetic-wrap inline-flex">
        <a
          href="<?php echo esc_url($next_url); ?>"
          class="js-magnetic focus-ring inline-flex items-center justify-center rounded-full border border-line px-7 py-4 font-display text-xs tracking-[0.22em] hover:border-accent hover:text-accent"
          aria-label="<?php echo esc_attr('View project: ' . $next['title']); ?>"
        >
          VIEW PROJECT →
        </a>
      </span>
    </section>
  <?php endif; ?>
</article>
<?php
get_footer();
