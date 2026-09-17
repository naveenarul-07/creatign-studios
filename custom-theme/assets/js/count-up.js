(function (window, document) {
  'use strict';

  var CS = window.CreativeStudio;

  function animateCount(node) {
    var value = Number(node.getAttribute('data-value') || 0);
    var suffix = node.getAttribute('data-suffix') || '';
    if (CS.reduced) {
      node.textContent = String(value) + suffix;
      return;
    }
    var started = performance.now();
    var duration = 1400;

    function tick(now) {
      var t = Math.min((now - started) / duration, 1);
      var eased = 1 - Math.pow(1 - t, 3);
      node.textContent = String(Math.round(eased * value)) + suffix;
      if (t < 1) {
        window.requestAnimationFrame(tick);
      } else {
        node.textContent = String(value) + suffix;
      }
    }

    window.requestAnimationFrame(tick);
  }

  function startCounts() {
    var nodes = document.querySelectorAll('.js-count-up');
    if (!nodes.length) {
      return;
    }

    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) {
            return;
          }
          animateCount(entry.target);
          observer.unobserve(entry.target);
        });
      },
      { threshold: 0.4 }
    );

    nodes.forEach(function (node) {
      observer.observe(node);
    });
  }

  function startOrb() {
    var orb = document.querySelector('.js-about-orb');
    if (!orb || typeof gsap === 'undefined' || CS.reduced) {
      return;
    }
    gsap.to(orb, {
      y: 18,
      x: -10,
      duration: 4,
      repeat: -1,
      yoyo: true,
      ease: 'power1.inOut',
    });
  }

  function start() {
    startCounts();
    startOrb();
  }

  CS.countUp = {
    init: function () {
      CS.initOnce('countUp', start);
    },
  };
  CS.countUp.init();
})(window, document);
