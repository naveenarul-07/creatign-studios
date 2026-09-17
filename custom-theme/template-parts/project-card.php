<?php
/**
 * Project card. Matches ProjectCard.jsx.
 */

if (!defined('ABSPATH')) {
  exit;
}

$project = isset($args['project']) ? $args['project'] : null;
$index   = isset($args['index']) ? (int) $args['index'] : 0;

if (!$project) {
  return;
}

$media_class = [
  'wide'   => 'md:col-span-2 min-h-[22rem] md:min-h-[34rem]',
  'tall'   => 'min-h-[22rem] md:min-h-[36rem]',
  'square' => 'min-h-[22rem] md:min-h-[26rem]',
];
$size        = isset($project['size']) ? $project['size'] : 'square';
$media       = isset($media_class[$size]) ? $media_class[$size] : $media_class['square'];
$from_left   = 0 === $index % 2;
$article_x   = $from_left ? '-36px' : '36px';
$url         = creative_studio_project_permalink($project);
$group_class = 'wide' === $size ? 'md:col-span-2' : '';
?>
<article
  class="js-project-card group <?php echo esc_attr($group_class); ?>"
  data-index="<?php echo esc_attr((string) $index); ?>"
  style="opacity: 0; transform: translateX(<?php echo esc_attr($article_x); ?>)"
>
  <a
    href="<?php echo esc_url($url); ?>"
    class="js-project-link focus-ring block"
    data-cursor="view"
    data-cursor-label="<?php echo esc_attr($project['name']); ?>"
    aria-label="<?php echo esc_attr($project['title']); ?>"
  >
    <div class="relative overflow-hidden <?php echo esc_attr($media); ?>">
      <div class="js-project-visual-shift absolute inset-0 origin-center will-change-transform transition-transform duration-500 ease-[cubic-bezier(0.16,1,0.3,1)]">
        <?php
        get_template_part('template-parts/project-visual', null, [
          'visual'   => $project['visual'],
          'class'    => 'h-full w-full',
          'animated' => true,
        ]);
        ?>
      </div>
    </div>
    <div class="mt-5 flex items-start justify-between gap-4">
      <div class="min-w-0">
        <h3 class="font-display text-xl tracking-[-0.03em] md:text-2xl"><?php echo esc_html($project['title']); ?></h3>
        <p class="mt-1 text-sm text-muted"><?php echo esc_html($project['excerpt']); ?></p>
      </div>
      <p class="shrink-0 pt-1 font-display text-xs tracking-[0.18em] text-muted">
        <?php echo esc_html($project['category']); ?> / <?php echo esc_html($project['year']); ?>
      </p>
    </div>
  </a>
</article>
