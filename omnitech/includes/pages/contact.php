<section class="page-hero">
  <div class="container">
    <h1>Contact Us</h1>
  </div>
  <svg class="hero-wave" viewBox="0 0 1000 100" preserveAspectRatio="none" aria-hidden="true"><path d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path></svg>
</section>
<section class="section">
  <div class="container contact-layout">
    <div class="contact-info">
      <img class="hq" src="<?= e(asset('images/hq.jpeg')) ?>" alt="OMNITECH Systems headquarters">
      <h2>Office Address</h2>
      <p><?= e(SITE_ADDRESS[0]) ?><br><?= e(SITE_ADDRESS[1]) ?></p>
      <h2>Contact Info</h2>
      <p>
        <a href="tel:+17032812340"><?= e(SITE_PHONE) ?> (Phone)</a><br>
        <span><?= e(SITE_FAX) ?> (Fax)</span><br>
        <a href="<?= e(url('/')) ?>">www.omnitechsys.com</a><br>
        <a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a>
      </p>
    </div>
    <form class="card-form" method="post" action="<?= e(url('/contact')) ?>" novalidate>
      <h2>Engage with OMNITECH</h2>
      <?= csrf_field() ?>
      <label class="hp">Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label>
      <label>Name
        <input type="text" name="name" required maxlength="120" value="<?= e(old('name')) ?>">
      </label>
      <label>Email Address
        <input type="email" name="email" required maxlength="180" value="<?= e(old('email')) ?>">
      </label>
      <label>Company <span class="optional">(optional)</span>
        <input type="text" name="company" maxlength="160" value="<?= e(old('company')) ?>">
      </label>
      <label>Message
        <textarea name="message" required minlength="10" maxlength="5000" rows="6"><?= e(old('message')) ?></textarea>
      </label>
      <button class="btn btn-navy" type="submit">Send Message</button>
    </form>
  </div>
</section>
