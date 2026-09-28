  </main>
  <section class="cta-band">
    <div class="container cta-band-inner">
      <h2>Are you ready to make your enterprise accountable?</h2>
      <a class="btn btn-outline" href="<?= e(url('/contact')) ?>">Reach Out</a>
    </div>
  </section>
  <footer class="site-footer">
    <div class="footer-lime">
      <div class="container footer-nav">
        <?php foreach (nav_links() as $link): ?>
          <a href="<?= e(url($link['href'])) ?>"><?= e($link['label']) ?></a>
        <?php endforeach; ?>
        <a href="<?= e(EMPLOYEE_PORTAL) ?>" target="_blank" rel="noopener noreferrer">Employee Portal</a>
      </div>
    </div>
    <div class="footer-base">
      <div class="container footer-base-inner">
        <p>Copyright © 2021 OMNITECH Systems</p>
        <a href="<?= e(url('/privacy')) ?>">Privacy Policy</a>
        <a class="social" href="<?= e(LINKEDIN) ?>" target="_blank" rel="noopener noreferrer" aria-label="OMNITECH Systems on LinkedIn">
          <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M4.98 3.5C4.98 4.88 3.88 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM.24 8.25h4.52V24H.24V8.25zM8.34 8.25h4.33v2.14h.06c.6-1.14 2.08-2.34 4.28-2.34 4.58 0 5.42 3.01 5.42 6.93V24h-4.52v-7.86c0-1.88-.03-4.29-2.62-4.29-2.62 0-3.02 2.04-3.02 4.15V24H8.34V8.25z"/></svg>
        </a>
      </div>
    </div>
  </footer>
  <script src="<?= e(asset('js/main.js')) ?>"></script>
</body>
</html>
