(function (window, document) {
  'use strict';

  var CS = window.CreativeStudio;
  var BASE_SPEED = 32;
  var SCROLL_SPEED = 42;

  function start() {
    var section = document.querySelector('.js-marquee');
    var track = document.querySelector('.js-marquee-track');
    var scale = document.querySelector('.js-marquee-scale');
    if (!section || !track) {
      return;
    }

    if (CS.reduced) {
      return;
    }

    var offset = 0;
    var speed = BASE_SPEED;
    var targetSpeed = BASE_SPEED;
    var hovering = false;
    var last = performance.now();
    var resetTimer;
    var frame;

    section.addEventListener('mouseenter', function () {
      hovering = true;
      targetSpeed = 10;
      if (scale) {
        scale.classList.remove('scale-100');
        scale.classList.add('scale-[1.04]');
      }
    });

    section.addEventListener('mouseleave', function () {
      hovering = false;
      targetSpeed = BASE_SPEED;
      if (scale) {
        scale.classList.add('scale-100');
        scale.classList.remove('scale-[1.04]');
      }
    });

    window.addEventListener(
      'scroll',
      function () {
        if (hovering) {
          return;
        }
        targetSpeed = SCROLL_SPEED;
        window.clearTimeout(resetTimer);
        resetTimer = window.setTimeout(function () {
          if (!hovering) {
            targetSpeed = BASE_SPEED;
          }
        }, 180);
      },
      { passive: true }
    );

    function tick(now) {
      var dt = Math.min((now - last) / 1000, 0.05);
      last = now;
      speed += (targetSpeed - speed) * 0.08;
      offset += speed * dt;
      var loop = track.scrollWidth / 2;
      if (loop > 0 && offset >= loop) {
        offset -= loop;
      }
      track.style.transform = 'translate3d(' + -offset + 'px, 0, 0)';
      frame = window.requestAnimationFrame(tick);
    }

    frame = window.requestAnimationFrame(tick);
  }

  CS.marquee = {
    init: function () {
      CS.initOnce('marquee', start);
    },
  };
  CS.marquee.init();
})(window, document);
