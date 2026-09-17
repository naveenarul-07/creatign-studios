(function (window, document) {
  'use strict';

  var CS = window.CreativeStudio;

  function complete() {
    var loader = document.querySelector('.js-loader');
    if (loader) {
      loader.remove();
    }
    CS.setReady();
  }

  function setProgress(value) {
    var label = document.querySelector('.js-loader-progress');
    var bar = document.querySelector('.js-loader-bar');
    var text = String(value).padStart(3, '0') + '%';
    if (label) {
      label.textContent = text;
    }
    if (bar) {
      bar.style.width = value + '%';
    }
  }

  function playExit() {
    var loader = document.querySelector('.js-loader');
    if (!loader || typeof gsap === 'undefined') {
      complete();
      return;
    }
    gsap.to(loader, {
      y: '-100%',
      duration: 0.9,
      ease: CS.easeInOutExpo,
      onComplete: complete,
    });
  }

  function start() {
    var loader = document.querySelector('.js-loader');
    if (!loader) {
      CS.setReady();
      return;
    }

    if (CS.reduced) {
      setProgress(100);
      complete();
      return;
    }

    var started = performance.now();
    var duration = 1400;
    var frame;

    function tick(now) {
      var t = Math.min((now - started) / duration, 1);
      var eased = 1 - Math.pow(1 - t, 3);
      setProgress(Math.round(eased * 100));
      if (t < 1) {
        frame = window.requestAnimationFrame(tick);
      } else {
        window.setTimeout(playExit, 280);
      }
    }

    frame = window.requestAnimationFrame(tick);
    loader._loaderFrame = frame;
  }

  CS.loader = { init: start };
  start();
})(window, document);
