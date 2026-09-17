(function (window, document) {
  'use strict';

  var CS = window.CreativeStudio;

  function start() {
    if (CS.reduced || typeof Lenis === 'undefined') {
      CS.onReady(CS.scrollToHash);
      return;
    }

    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
      gsap.registerPlugin(ScrollTrigger);
    }

    var lenis = new Lenis({
      duration: 1.05,
      smoothWheel: true,
      wheelMultiplier: 0.85,
      touchMultiplier: 1,
    });

    CS.lenisInstance = lenis;

    if (typeof ScrollTrigger !== 'undefined') {
      lenis.on('scroll', ScrollTrigger.update);
    }

    if (typeof gsap !== 'undefined') {
      gsap.ticker.add(function (time) {
        lenis.raf(time * 1000);
      });
      gsap.ticker.lagSmoothing(0);
    } else {
      function raf(time) {
        lenis.raf(time);
        window.requestAnimationFrame(raf);
      }
      window.requestAnimationFrame(raf);
    }

    CS.onReady(CS.scrollToHash);
  }

  CS.lenis = { init: start };
  start();
})(window, document);
