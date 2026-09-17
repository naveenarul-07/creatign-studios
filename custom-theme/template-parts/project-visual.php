<?php
/**
 * Generated project art. Matches ProjectVisual.jsx.
 */

if (!defined('ABSPATH')) {
  exit;
}

$visual   = isset($args['visual']) ? $args['visual'] : 'neon';
$title    = isset($args['title']) ? $args['title'] : '';
$class    = isset($args['class']) ? $args['class'] : '';
$animated = !isset($args['animated']) || $args['animated'];

$variants = [
  'neon'  => ['bg' => '#0a0a0a', 'ink' => '#d4ff3f', 'hot' => '#ff4d1c', 'paper' => '#f4f0e6'],
  'mono'  => ['bg' => '#141414', 'ink' => '#f4f0e6', 'hot' => '#d4ff3f', 'paper' => '#8c8c8c'],
  'arc'   => ['bg' => '#161412', 'ink' => '#c6a87c', 'hot' => '#f4f0e6', 'paper' => '#3a342c'],
  'nova'  => ['bg' => '#07070c', 'ink' => '#7aa2ff', 'hot' => '#d4ff3f', 'paper' => '#f4f0e6'],
  'form'  => ['bg' => '#1a1612', 'ink' => '#e7d5b5', 'hot' => '#8c5a3c', 'paper' => '#f4f0e6'],
  'pulse' => ['bg' => '#0c0c0c', 'ink' => '#ff4d1c', 'hot' => '#d4ff3f', 'paper' => '#f4f0e6'],
  'echo'  => ['bg' => '#12110f', 'ink' => '#f4f0e6', 'hot' => '#d4ff3f', 'paper' => '#5c5850'],
];

$c = isset($variants[$visual]) ? $variants[$visual] : $variants['neon'];
?>
<div class="relative overflow-hidden <?php echo esc_attr($class); ?>" style="background: <?php echo esc_attr($c['bg']); ?>">
  <svg
    viewBox="0 0 100 100"
    preserveAspectRatio="xMidYMid slice"
    class="absolute inset-0 h-full w-full<?php echo $animated ? ' motion-safe:animate-pulse' : ''; ?>"
    aria-hidden="true"
  >
    <?php if ('neon' === $visual) : ?>
      <rect width="100%" height="100%" fill="<?php echo esc_attr($c['bg']); ?>" />
      <circle cx="78%" cy="30%" r="28%" fill="<?php echo esc_attr($c['ink']); ?>" opacity="0.9" />
      <circle cx="70%" cy="42%" r="16%" fill="<?php echo esc_attr($c['hot']); ?>" opacity="0.85" />
      <rect x="8%" y="18%" width="2" height="64%" fill="<?php echo esc_attr($c['paper']); ?>" opacity="0.35" />
      <rect x="12%" y="28%" width="36%" height="1.5" fill="<?php echo esc_attr($c['ink']); ?>" />
    <?php elseif ('mono' === $visual) : ?>
      <rect width="100%" height="100%" fill="<?php echo esc_attr($c['bg']); ?>" />
      <?php for ($i = 0; $i <= 5; $i++) : ?>
        <rect
          x="<?php echo esc_attr((string) (12 + $i * 13)); ?>%"
          y="<?php echo esc_attr((string) (20 + ($i % 2) * 8)); ?>%"
          width="10%"
          height="<?php echo esc_attr((string) (50 - $i * 4)); ?>%"
          fill="<?php echo esc_attr($c['ink']); ?>"
          opacity="<?php echo esc_attr((string) (0.15 + $i * 0.12)); ?>"
        />
      <?php endfor; ?>
      <circle cx="78%" cy="72%" r="9%" fill="<?php echo esc_attr($c['hot']); ?>" />
    <?php elseif ('arc' === $visual) : ?>
      <rect width="100%" height="100%" fill="<?php echo esc_attr($c['bg']); ?>" />
      <path d="M10 90 Q50 10 90 90" fill="none" stroke="<?php echo esc_attr($c['ink']); ?>" stroke-width="8" />
      <path d="M18 90 Q50 28 82 90" fill="none" stroke="<?php echo esc_attr($c['hot']); ?>" stroke-width="1.5" opacity="0.7" />
      <rect x="46%" y="18%" width="8%" height="62%" fill="<?php echo esc_attr($c['paper']); ?>" opacity="0.25" />
    <?php elseif ('nova' === $visual) : ?>
      <rect width="100%" height="100%" fill="<?php echo esc_attr($c['bg']); ?>" />
      <?php for ($i = 0; $i < 18; $i++) : ?>
        <circle
          cx="<?php echo esc_attr((string) (20 + (($i * 37) % 70))); ?>%"
          cy="<?php echo esc_attr((string) (18 + (($i * 53) % 64))); ?>%"
          r="<?php echo esc_attr((string) (1.2 + ($i % 4))); ?>"
          fill="<?php echo esc_attr($c['ink']); ?>"
          opacity="0.85"
        />
      <?php endfor; ?>
      <circle cx="50%" cy="48%" r="18%" fill="none" stroke="<?php echo esc_attr($c['hot']); ?>" stroke-width="1.5" />
      <circle cx="50%" cy="48%" r="4%" fill="<?php echo esc_attr($c['paper']); ?>" />
    <?php elseif ('form' === $visual) : ?>
      <rect width="100%" height="100%" fill="<?php echo esc_attr($c['bg']); ?>" />
      <ellipse cx="52%" cy="48%" rx="22%" ry="30%" fill="<?php echo esc_attr($c['ink']); ?>" opacity="0.9" />
      <ellipse cx="48%" cy="52%" rx="16%" ry="22%" fill="<?php echo esc_attr($c['hot']); ?>" opacity="0.55" />
      <circle cx="62%" cy="30%" r="7%" fill="<?php echo esc_attr($c['paper']); ?>" opacity="0.35" />
    <?php elseif ('pulse' === $visual) : ?>
      <rect width="100%" height="100%" fill="<?php echo esc_attr($c['bg']); ?>" />
      <?php for ($i = 0; $i < 24; $i++) : ?>
        <?php $h = 12 + abs(sin($i * 0.7)) * 70; ?>
        <rect
          x="<?php echo esc_attr((string) (8 + $i * 3.6)); ?>%"
          y="<?php echo esc_attr((string) (50 - $h / 2)); ?>%"
          width="1.6%"
          height="<?php echo esc_attr((string) $h); ?>%"
          fill="<?php echo esc_attr(0 === $i % 5 ? $c['hot'] : $c['ink']); ?>"
          opacity="0.9"
        />
      <?php endfor; ?>
    <?php elseif ('echo' === $visual) : ?>
      <rect width="100%" height="100%" fill="<?php echo esc_attr($c['bg']); ?>" />
      <rect x="10%" y="16%" width="80%" height="6%" fill="<?php echo esc_attr($c['ink']); ?>" />
      <rect x="10%" y="28%" width="62%" height="3%" fill="<?php echo esc_attr($c['paper']); ?>" />
      <rect x="10%" y="36%" width="70%" height="3%" fill="<?php echo esc_attr($c['paper']); ?>" opacity="0.5" />
      <rect x="10%" y="52%" width="48%" height="32%" fill="<?php echo esc_attr($c['hot']); ?>" />
      <rect x="62%" y="52%" width="28%" height="32%" fill="<?php echo esc_attr($c['ink']); ?>" opacity="0.2" />
    <?php else : ?>
      <rect width="100%" height="100%" fill="<?php echo esc_attr($c['bg']); ?>" />
      <circle cx="78%" cy="30%" r="28%" fill="<?php echo esc_attr($c['ink']); ?>" opacity="0.9" />
      <circle cx="70%" cy="42%" r="16%" fill="<?php echo esc_attr($c['hot']); ?>" opacity="0.85" />
      <rect x="8%" y="18%" width="2" height="64%" fill="<?php echo esc_attr($c['paper']); ?>" opacity="0.35" />
      <rect x="12%" y="28%" width="36%" height="1.5" fill="<?php echo esc_attr($c['ink']); ?>" />
    <?php endif; ?>
  </svg>
  <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-black/10"></div>
  <?php if ($title) : ?>
    <div class="absolute bottom-5 left-5 right-5 font-display text-[clamp(2rem,6vw,5rem)] font-medium leading-[0.85] tracking-[-0.05em] text-paper">
      <?php echo esc_html($title); ?>
    </div>
  <?php endif; ?>
</div>
