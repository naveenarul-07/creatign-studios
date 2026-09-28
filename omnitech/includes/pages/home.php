<section class="hero">
  <div class="hero-media" aria-hidden="true"></div>
  <div class="hero-shade" aria-hidden="true"></div>
  <div class="container hero-copy">
    <h1>The Accountable Enterprise</h1>
    <p>OMNITECH Systems is a thriving Commercial &amp; Federal Enterprise IT solutions provider that delivers cost-effective, scalable, repeatable, and predictable mission outcomes with a strategic agility second to none.</p>
    <a class="btn btn-outline" href="<?= e(url('/contact')) ?>">Get Started</a>
  </div>
  <svg class="hero-wave" viewBox="0 0 1000 100" preserveAspectRatio="none" aria-hidden="true">
    <path d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
  </svg>
</section>

<section class="section services-home">
  <div class="container">
    <p class="eyebrow">what we do</p>
    <h2 class="section-title center">Enterprise IT Solutions &amp; Services</h2>
    <div class="service-pills">
      <?php foreach (services() as $service): ?>
        <a class="service-pill" href="<?= e(url($service['href'])) ?>">
          <img src="<?= e(asset('images/mark.svg')) ?>" alt="" width="36" height="42">
          <span><?= e($service['title']) ?></span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section partner-band">
  <div class="container split">
    <div>
      <h3 class="band-title">OMNITECH: YOUR ACCOUNTABLE IT PARTNER</h3>
      <p>From Data Architecture, Data Analytics, AI/ML and Data Management, to innovative software developments like, platform development, cloud computing, virtualization and optimization and DevOps, our clients trust us because they know we deliver relevant solutions today, and set them up for success in the future.</p>
      <p>With a unique understanding of the increasing Data Management &amp; Data Analytics needs, OMNITECH Systems delivers not just solutions, but also the means and methods for sustaining those solutions.</p>
      <p>Powered by a passionate commitment for exceptional customer experience, OMNITECH Systems is the choice for those who seek an accountable IT Partner.</p>
    </div>
    <div class="partner-mark" aria-hidden="true">
      <img src="<?= e(asset('images/mark.svg')) ?>" alt="">
    </div>
  </div>
</section>

<section class="section clients-band">
  <div class="container">
    <h3 class="band-title center">REPRESENTATIVE CLIENTS THAT TRUST OMNITECH</h3>
    <div class="logo-row">
      <?php foreach (clients() as $client): ?>
        <div class="logo-card">
          <img src="<?= e(asset('images/' . $client['file'])) ?>" alt="<?= e($client['name']) ?>">
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section careers-teaser">
  <div class="container split align-center">
    <div>
      <p class="eyebrow">join the team</p>
      <h2>Careers</h2>
      <p>If you’re looking for a place that’s more than just a job, a place where you can join a team, look no further.</p>
      <a class="btn btn-navy" href="<?= e(url('/careers')) ?>">Learn More</a>
    </div>
    <div class="job-stack">
      <?php foreach (jobs() as $job): ?>
        <a class="job-card" href="<?= e(url('/career/' . $job['slug'])) ?>">
          <span><?= e($job['title']) ?></span>
          <strong>Apply Now <span aria-hidden="true">→</span></strong>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
