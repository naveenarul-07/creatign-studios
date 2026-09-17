(function (window, document) {
  'use strict';

  var CS = window.CreativeStudio;

  function setActive(active) {
    var inner = document.querySelector('.js-cursor-ring-inner');
    if (!inner) {
      return;
    }
    inner.classList.toggle('h-8', active);
    inner.classList.toggle('w-8', active);
    inner.classList.toggle('h-5', !active);
    inner.classList.toggle('w-5', !active);
  }

  function bindTargets() {
    document.addEventListener('mouseover', function (event) {
      if (!CS.cursorEnabled()) {
        return;
      }
      var magnetic = event.target.closest('.js-magnetic');
      if (magnetic) {
        CS.setCursorState({ variant: 'button', label: '' });
        return;
      }
      var tagged = event.target.closest('[data-cursor]');
      if (tagged) {
        CS.setCursorState({
          variant: tagged.getAttribute('data-cursor') || 'link',
          label: tagged.getAttribute('data-cursor-label') || '',
        });
      }
    });

    document.addEventListener('mouseout', function (event) {
      if (!CS.cursorEnabled()) {
        return;
      }
      var magnetic = event.target.closest('.js-magnetic');
      var tagged = event.target.closest('[data-cursor]');
      var nextMagnetic = event.relatedTarget && event.relatedTarget.closest
        ? event.relatedTarget.closest('.js-magnetic')
        : null;
      var nextTagged = event.relatedTarget && event.relatedTarget.closest
        ? event.relatedTarget.closest('[data-cursor]')
        : null;
      if ((magnetic && !nextMagnetic) || (tagged && !nextTagged && !nextMagnetic)) {
        CS.setCursorState({ variant: 'default', label: '' });
      }
    });
  }

  function start() {
    var root = document.querySelector('.js-cursor');
    var dot = document.querySelector('.js-cursor-dot');
    var ring = document.querySelector('.js-cursor-ring');

    if (!root || !dot || !ring) {
      return;
    }

    var pos = { x: 0, y: 0, rx: 0, ry: 0 };
    var target = { x: 0, y: 0 };
    var frame;
    var running = false;

    function enable() {
      document.body.classList.add('has-custom-cursor');
      root.style.display = '';
      if (!running) {
        running = true;
        frame = window.requestAnimationFrame(tick);
      }
    }

    function disable() {
      document.body.classList.remove('has-custom-cursor');
      root.style.display = 'none';
      running = false;
      if (frame) {
        window.cancelAnimationFrame(frame);
      }
    }

    function syncEnabled() {
      if (CS.cursorEnabled()) {
        enable();
      } else {
        disable();
      }
    }

    function onMove(event) {
      target.x = event.clientX;
      target.y = event.clientY;
    }

    function tick() {
      if (!running) {
        return;
      }
      pos.x += (target.x - pos.x) * 0.4;
      pos.y += (target.y - pos.y) * 0.4;
      pos.rx += (target.x - pos.rx) * 0.18;
      pos.ry += (target.y - pos.ry) * 0.18;
      dot.style.transform = 'translate3d(' + pos.x + 'px, ' + pos.y + 'px, 0)';
      ring.style.transform = 'translate3d(' + pos.rx + 'px, ' + pos.ry + 'px, 0)';
      frame = window.requestAnimationFrame(tick);
    }

    window.addEventListener('mousemove', onMove, { passive: true });
    document.addEventListener('creative-studio:cursor', function (event) {
      setActive(event.detail.variant !== 'default');
    });

    bindTargets();
    setActive(false);
    syncEnabled();

    window.matchMedia('(max-width: 768px)').addEventListener('change', syncEnabled);
    window.matchMedia('(hover: hover) and (pointer: fine)').addEventListener('change', syncEnabled);
    window.matchMedia('(prefers-reduced-motion: reduce)').addEventListener('change', function (event) {
      CS.reduced = event.matches;
      syncEnabled();
    });
  }

  CS.cursor = { init: start };
  start();
})(window, document);
