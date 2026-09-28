<section class="page-hero">
  <div class="container">
    <p class="eyebrow light"><a href="<?= e(url('/careers')) ?>">Careers</a></p>
    <h1><?= e($job['title']) ?></h1>
    <p class="hero-lead"><?= e($job['location']) ?></p>
    <a class="btn btn-outline" href="#apply">Apply Now</a>
  </div>
  <svg class="hero-wave" viewBox="0 0 1000 100" preserveAspectRatio="none" aria-hidden="true"><path d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path></svg>
</section>
<section class="section">
  <div class="container career-layout">
    <article class="prose">
      <p><?= e($job['intro']) ?></p>
      <?php if (!empty($job['body'])): ?>
        <p><?= e($job['body']) ?></p>
      <?php endif; ?>
      <?php foreach ($job['sections'] as $section): ?>
        <h2><?= e($section['heading']) ?></h2>
        <ul>
          <?php foreach ($section['items'] as $item): ?>
            <li><?= e($item) ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endforeach; ?>
      <h2>Location</h2>
      <p><?= e($job['location']) ?></p>
      <h2>Related</h2>
      <div class="job-stack">
        <?php foreach (jobs() as $related): ?>
          <?php if ($related['slug'] === $job['slug']) continue; ?>
          <a class="job-card" href="<?= e(url('/career/' . $related['slug'])) ?>">
            <span><?= e($related['title']) ?></span>
            <strong>Apply Now <span aria-hidden="true">→</span></strong>
          </a>
        <?php endforeach; ?>
      </div>
    </article>
    <form class="card-form" id="apply" method="post" action="<?= e(url('/apply')) ?>" enctype="multipart/form-data">
      <h2>Submit Application</h2>
      <?= csrf_field() ?>
      <input type="hidden" name="job" value="<?= e($job['slug']) ?>">
      <label>Name
        <input type="text" name="name" required maxlength="120" value="<?= e(old('name')) ?>">
      </label>
      <label>Email
        <input type="email" name="email" required maxlength="180" value="<?= e(old('email')) ?>">
      </label>
      <label>Phone
        <input type="tel" name="phone" required maxlength="40" value="<?= e(old('phone')) ?>">
      </label>
      <label>Attach Resume
        <input type="file" name="resume" required accept=".pdf,.doc,.docx,.txt,.rtf,application/pdf">
      </label>
      <p class="hint">PDF, DOC, DOCX, TXT, or RTF. 5 MB maximum.</p>
      <button class="btn btn-navy" type="submit">Submit Application</button>
    </form>
  </div>
</section>
