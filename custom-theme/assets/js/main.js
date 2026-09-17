(function (window, document) {
  'use strict';

  function cubicBezierEase(x1, y1, x2, y2) {
    var ax = 3 * x1 - 3 * x2 + 1;
    var bx = 3 * x2 - 6 * x1;
    var cx = 3 * x1;
    var ay = 3 * y1 - 3 * y2 + 1;
    var by = 3 * y2 - 6 * y1;
    var cy = 3 * y1;

    function sampleX(t) {
      return ((ax * t + bx) * t + cx) * t;
    }

    function sampleY(t) {
      return ((ay * t + by) * t + cy) * t;
    }

    function sampleXd(t) {
      return (3 * ax * t + 2 * bx) * t + cx;
    }

    function solveX(x) {
      var t = x;
      var i;
      for (i = 0; i < 8; i += 1) {
        var x2 = sampleX(t) - x;
        var d = sampleXd(t);
        if (Math.abs(x2) < 1e-6 || Math.abs(d) < 1e-6) {
          break;
        }
        t -= x2 / d;
      }
      return t;
    }

    return function (t) {
      if (t === 0 || t === 1) {
        return t;
      }
      return sampleY(solveX(t));
    };
  }

  function media(query) {
    return window.matchMedia(query);
  }

  var CS = window.CreativeStudio || {};

  CS.easeOutExpo = cubicBezierEase(0.16, 1, 0.3, 1);
  CS.easeInOutExpo = cubicBezierEase(0.87, 0, 0.13, 1);
  CS.reduced = media('(prefers-reduced-motion: reduce)').matches;
  CS._booted = CS._booted || {};

  CS.initOnce = function (key, fn) {
    if (CS._booted[key]) {
      return;
    }
    CS._booted[key] = true;
    fn();
  };

  CS.isMobile = function () {
    return media('(max-width: 768px)').matches;
  };

  CS.finePointer = function () {
    return media('(hover: hover) and (pointer: fine)').matches;
  };

  CS.cursorEnabled = function () {
    return CS.finePointer() && !CS.isMobile() && !CS.reduced;
  };

  CS.ready = function () {
    return document.documentElement.dataset.ready === 'true';
  };

  CS.setReady = function () {
    document.documentElement.dataset.ready = 'true';
    document.dispatchEvent(new CustomEvent('creative-studio:ready'));
  };

  CS.onReady = function (callback) {
    if (CS.ready()) {
      callback();
      return;
    }
    document.addEventListener('creative-studio:ready', callback, { once: true });
  };

  CS.cursorState = { variant: 'default', label: '' };

  CS.setCursorState = function (next) {
    CS.cursorState = Object.assign({}, CS.cursorState, next);
    document.dispatchEvent(new CustomEvent('creative-studio:cursor', { detail: CS.cursorState }));
  };

  CS.scrollToTop = function () {
    if (CS.lenisInstance) {
      CS.lenisInstance.scrollTo(0);
      return;
    }
    window.scrollTo({ top: 0, behavior: CS.reduced ? 'auto' : 'smooth' });
  };

  CS.scrollToHash = function () {
    if (!window.location.hash) {
      return;
    }
    var node = document.querySelector(window.location.hash);
    if (!node) {
      return;
    }
    requestAnimationFrame(function () {
      if (CS.lenisInstance && !CS.reduced) {
        CS.lenisInstance.scrollTo(node);
        return;
      }
      node.scrollIntoView({ behavior: CS.reduced ? 'auto' : 'smooth' });
    });
  };

  media('(prefers-reduced-motion: reduce)').addEventListener('change', function (event) {
    CS.reduced = event.matches;
  });

  function initBackToTop() {
    var wrap = document.querySelector('.js-back-to-top-wrap');
    var button = document.querySelector('.js-back-to-top');
    if (!wrap || !button) {
      return;
    }

    function setVisible() {
      var show = window.scrollY > 600;
      wrap.classList.toggle('hidden', !show);
      wrap.classList.toggle('inline-flex', show);
    }

    window.addEventListener('scroll', setVisible, { passive: true });
    setVisible();
    button.addEventListener('click', function () {
      CS.scrollToTop();
    });
  }

  initBackToTop();

  window.CreativeStudio = CS;
})(window, document);
