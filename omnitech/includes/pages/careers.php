<section class="page-hero">
  <div class="container">
    <h1>Find a Career</h1>
    <p class="hero-lead">Start your career with OMNITECH.</p>
  </div>
  <svg class="hero-wave" viewBox="0 0 1000 100" preserveAspectRatio="none" aria-hidden="true"><path d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path></svg>
</section>
<section class="section">
  <div class="container split align-center">
    <img class="frame-photo" src="<?= e(asset('images/team.jpg')) ?>" alt="OMNITECH team">
    <div>
      <h2>Benefits</h2>
      <div class="benefit-list">
        <?php foreach (benefits() as $benefit): ?>
          <article>
            <h3><?= e($benefit['title']) ?></h3>
            <p><?= e($benefit['body']) ?></p>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
<section class="section muted" id="jobs">
  <div class="container split align-center">
    <div>
      <p class="eyebrow">join the team</p>
      <h2>Open Job Positions</h2>
      <p>If you’re looking for a place that’s more than just a job, a place where you can join a team, look no further.</p>
      <a class="btn btn-navy" href="<?= e(url('/job-positions')) ?>">View Jobs</a>
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
