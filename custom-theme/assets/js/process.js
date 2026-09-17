(function (window, document) {
  'use strict';

  var CS = window.CreativeStudio;

  function start() {
    var section = document.querySelector('.js-process');
    var pin = document.querySelector('.js-process-pin');
    var track = document.querySelector('.js-process-track');
    var bar = document.querySelector('.js-process-bar');

    if (!section || !pin || !track || !bar) {
      return;
    }

    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
      return;
    }

    gsap.registerPlugin(ScrollTrigger);

    var mm = gsap.matchMedia();
    mm.add('(min-width: 768px)', function () {
      if (CS.reduced) {
        return function () {};
      }

      track.classList.remove('flex-col');
      track.classList.add('w-max');
      bar.style.width = '0%';

      var tween = gsap.timeline({
        scrollTrigger: {
          trigger: section,
          start: 'top top',
          end: function () {
            return '+=' + window.innerHeight * 1.8;
          },
          pin: pin,
          scrub: true,
          invalidateOnRefresh: true,
        },
      });

      tween.fromTo(track, { x: '0%' }, { x: '-72%', ease: 'none' }, 0);
      tween.fromTo(bar, { width: '0%' }, { width: '100%', ease: 'none' }, 0);

      return function () {
        if (tween.scrollTrigger) {
          tween.scrollTrigger.kill();
        }
        tween.kill();
        track.classList.add('flex-col');
        track.classList.remove('w-max');
        gsap.set(track, { x: 0 });
        bar.style.width = '100%';
      };
    });

    ScrollTrigger.refresh();
  }

  CS.process = {
    init: function () {
      CS.initOnce('process', start);
    },
  };
  CS.process.init();
})(window, document);
