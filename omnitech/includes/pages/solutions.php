<section class="page-hero">
  <div class="container">
    <p class="eyebrow light">Enterprise IT</p>
    <h1>Solutions &amp; Services</h1>
  </div>
  <svg class="hero-wave" viewBox="0 0 1000 100" preserveAspectRatio="none" aria-hidden="true"><path d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path></svg>
</section>
<section class="section">
  <div class="container">
    <h2 class="section-title">IT Solutions &amp; services</h2>
    <div class="solution-grid">
      <?php foreach (services() as $service): ?>
        <article class="solution-card" id="<?= e($service['slug']) ?>">
          <div class="solution-card-head">
            <img src="<?= e(asset('images/mark.svg')) ?>" alt="" width="34" height="40">
            <h3><?= e($service['title']) ?></h3>
          </div>
          <ul>
            <?php foreach ($service['items'] as $item): ?>
              <li><?= e($item) ?></li>
            <?php endforeach; ?>
          </ul>
          <a class="text-link" href="<?= e(url($service['href'])) ?>">Learn More <span aria-hidden="true">→</span></a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<section class="section muted">
  <div class="container">
    <h2 class="section-title center">Key Technology Expertise and Industry Alliances</h2>
    <div class="logo-row">
      <?php foreach (alliances() as $logo): ?>
        <div class="logo-card">
          <img src="<?= e(asset('images/' . $logo['file'])) ?>" alt="<?= e($logo['name']) ?>">
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
