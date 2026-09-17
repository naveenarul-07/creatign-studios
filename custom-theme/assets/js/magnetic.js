(function (window, document) {
  'use strict';

  var CS = window.CreativeStudio;
  var STIFFNESS = 240;
  var DAMPING = 18;
  var MASS = 0.3;
  var STRENGTH = 0.35;

  function createSpring() {
    var current = { x: 0, y: 0 };
    var velocity = { x: 0, y: 0 };
    var target = { x: 0, y: 0 };
    var last = performance.now();
    var running = false;
    var onUpdate = function () {};

    function step(now) {
      var dt = Math.min((now - last) / 1000, 0.064);
      last = now;

      var accX = (-STIFFNESS * (current.x - target.x) - DAMPING * velocity.x) / MASS;
      var accY = (-STIFFNESS * (current.y - target.y) - DAMPING * velocity.y) / MASS;
      velocity.x += accX * dt;
      velocity.y += accY * dt;
      current.x += velocity.x * dt;
      current.y += velocity.y * dt;

      onUpdate(current.x, current.y);

      var settled =
        Math.abs(velocity.x) < 0.02 &&
        Math.abs(velocity.y) < 0.02 &&
        Math.abs(current.x - target.x) < 0.02 &&
        Math.abs(current.y - target.y) < 0.02;

      if (settled) {
        current.x = target.x;
        current.y = target.y;
        velocity.x = 0;
        velocity.y = 0;
        onUpdate(current.x, current.y);
        running = false;
        return;
      }

      window.requestAnimationFrame(step);
    }

    return {
      set: function (x, y) {
        target.x = x;
        target.y = y;
        if (!running) {
          running = true;
          last = performance.now();
          window.requestAnimationFrame(step);
        }
      },
      onUpdate: function (fn) {
        onUpdate = fn;
      },
    };
  }

  function bind(wrap) {
    var trigger = wrap.querySelector('.js-magnetic') || wrap;
    var strength = Number(trigger.getAttribute('data-magnetic-strength') || STRENGTH);
    var spring = createSpring();

    spring.onUpdate(function (x, y) {
      wrap.style.transform = 'translate3d(' + x + 'px, ' + y + 'px, 0)';
    });

    function onMove(event) {
      if (!CS.cursorEnabled()) {
        return;
      }
      var rect = trigger.getBoundingClientRect();
      var offsetX = event.clientX - (rect.left + rect.width / 2);
      var offsetY = event.clientY - (rect.top + rect.height / 2);
      spring.set(offsetX * strength, offsetY * strength);
    }

    function reset() {
      spring.set(0, 0);
      CS.setCursorState({ variant: 'default', label: '' });
    }

    trigger.addEventListener('mousemove', onMove);
    trigger.addEventListener('mouseenter', function () {
      CS.setCursorState({ variant: 'button', label: '' });
    });
    trigger.addEventListener('mouseleave', reset);
  }

  function start() {
    document.querySelectorAll('.js-magnetic-wrap').forEach(bind);
  }

  CS.magnetic = { init: start };
  start();
})(window, document);
