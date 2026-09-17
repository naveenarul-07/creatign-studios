<?php
/**
 * Studio / about. Matches About.jsx. Pass compact => true on Home.
 */

if (!defined('ABSPATH')) {
  exit;
}

$compact = !empty($args['compact']);
$stats   = creative_studio_get_studio_stats();
$team    = creative_studio_get_team();
$lines   = ['WE ARE A SMALL STUDIO', 'WITH A BIG DIGITAL', 'MINDSET.'];
?>
<section id="studio" class="px-5 py-20 md:px-10 md:py-32">
  <p class="font-display text-[11px] tracking-[0.28em] text-muted">04 — STUDIO</p>
  <h2 class="mt-6 max-w-5xl font-display text-[clamp(2rem,5.4vw,5.6rem)] font-medium leading-[0.95] tracking-[-0.05em]">
    <span class="block">
      <?php foreach ($lines as $index => $line) : ?>
        <span class="block overflow-hidden">
          <span
            class="js-split-line block"
            data-delay="<?php echo esc_attr((string) ($index * 0.1)); ?>"
            style="transform: translateY(108%)"
          ><?php echo esc_html($line); ?></span>
        </span>
      <?php endforeach; ?>
    </span>
  </h2>

  <div class="mt-16 grid gap-10 lg:grid-cols-[1.1fr_0.9fr]">
    <div class="max-w-xl space-y-6 text-paper-dim">
      <p>
        Creative Studio is a design and technology practice. We partner with ambitious brands
        to build identities, products and digital environments with cultural weight.
      </p>
      <p>
        Our philosophy is simple: type should have a voice, motion should have a reason, and
        the internet should feel like a place — not a template.
      </p>
      <?php if (!$compact) : ?>
        <p>
          Capabilities span strategy, identity, web, product and motion. We keep the team small
          so the work stays close to the people making it.
        </p>
      <?php endif; ?>
    </div>
    <div class="relative h-[22rem] overflow-hidden md:h-[28rem]">
      <div class="js-about-orb absolute -right-6 -top-6 h-24 w-24 rounded-full bg-accent/80 blur-2xl"></div>
      <?php
      get_template_part('template-parts/project-visual', null, [
        'visual'   => 'form',
        'class'    => 'h-full w-full',
        'animated' => true,
      ]);
      ?>
    </div>
  </div>

  <div class="mt-16 grid grid-cols-2 gap-8 border-t border-line pt-10 md:grid-cols-4">
    <?php foreach ($stats as $stat) : ?>
      <div>
        <p class="font-display text-[clamp(2rem,4vw,4rem)] tracking-[-0.05em] text-accent">
          <span class="js-count-up" data-value="<?php echo esc_attr((string) $stat['value']); ?>" data-suffix="<?php echo esc_attr($stat['suffix']); ?>">0<?php echo esc_html($stat['suffix']); ?></span>
        </p>
        <p class="mt-1 font-display text-xs tracking-[0.22em] text-muted"><?php echo esc_html($stat['label']); ?></p>
      </div>
    <?php endforeach; ?>
  </div>

  <?php if (!$compact) : ?>
    <div class="mt-20">
      <h3 class="font-display text-xs tracking-[0.24em] text-muted">TEAM</h3>
      <ul class="mt-6 grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <?php foreach ($team as $person) : ?>
          <li class="border border-line p-6">
            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-paper/5 font-display text-lg text-accent">
              <?php echo esc_html($person['initials']); ?>
            </div>
            <p class="mt-5 font-display text-xl tracking-[-0.03em]"><?php echo esc_html($person['name']); ?></p>
            <p class="text-sm text-muted"><?php echo esc_html($person['role']); ?></p>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>
</section>
