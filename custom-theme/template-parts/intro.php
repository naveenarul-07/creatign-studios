<?php
/**
 * Intro. Matches Intro.jsx.
 */

if (!defined('ABSPATH')) {
  exit;
}

$text      = 'WE BUILD IDENTITIES, PRODUCTS AND DIGITAL EXPERIENCES FOR BRANDS THAT WANT TO MOVE FORWARD.';
$highlight = ['IDENTITIES', 'PRODUCTS', 'EXPERIENCES', 'FORWARD'];
$words     = explode(' ', $text);
?>
<section class="js-intro px-5 py-28 md:px-10 md:py-40" id="intro">
  <p class="font-display text-[11px] tracking-[0.28em] text-muted">01 — WHO WE ARE</p>
  <h2 class="js-intro-parallax mt-8 max-w-6xl font-display text-[clamp(1.8rem,5.2vw,5.4rem)] font-medium leading-[1.05] tracking-[-0.045em]">
    <span class="inline">
      <?php foreach ($words as $index => $word) : ?>
        <?php
        $clean = preg_replace('/[.,]/', '', $word);
        $hot   = in_array($clean, $highlight, true);
        ?>
        <span class="inline-block overflow-hidden align-bottom">
          <span
            class="js-split-word inline-block pr-[0.28em]<?php echo $hot ? ' text-accent' : ''; ?>"
            data-delay="<?php echo esc_attr((string) ($index * 0.04)); ?>"
            style="transform: translateY(100%); opacity: 0"
          ><?php echo esc_html($word); ?></span>
        </span>
      <?php endforeach; ?>
    </span>
  </h2>
</section>
