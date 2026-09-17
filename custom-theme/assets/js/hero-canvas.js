(function (window, document) {
  'use strict';

  var CS = window.CreativeStudio;

  function start() {
    var canvas = document.querySelector('.js-hero-canvas');
    if (!canvas) {
      return;
    }

    var ctx = canvas.getContext('2d', { alpha: true });
    var mouse = { x: 0, y: 0 };
    var frame;
    var drawing = true;

    function resize() {
      var ratio = Math.min(window.devicePixelRatio || 1, 2);
      canvas.width = canvas.offsetWidth * ratio;
      canvas.height = canvas.offsetHeight * ratio;
      ctx.setTransform(ratio, 0, 0, ratio, 0, 0);
    }

    resize();
    window.addEventListener('resize', resize);

    window.addEventListener(
      'mousemove',
      function (event) {
        mouse.x = event.clientX;
        mouse.y = event.clientY;
      },
      { passive: true }
    );

    var orbs = [
      { x: 0.74, y: 0.36, r: 280, color: '212,255,63', speed: 0.00035 },
      { x: 0.64, y: 0.56, r: 200, color: '255,77,28', speed: 0.0005 },
      { x: 0.86, y: 0.48, r: 150, color: '244,240,230', speed: 0.00028 },
    ];

    function draw(now) {
      if (!drawing) {
        return;
      }
      if (!CS.ready()) {
        frame = window.requestAnimationFrame(draw);
        return;
      }

      var width = canvas.offsetWidth;
      var height = canvas.offsetHeight;
      ctx.clearRect(0, 0, width, height);

      var mx = mouse.x || width * 0.7;
      var my = mouse.y || height * 0.4;
      var isMobile = CS.isMobile();
      var reduced = CS.reduced;
      var parallaxX = isMobile || reduced ? 0 : (mx / window.innerWidth - 0.5) * 40;
      var parallaxY = isMobile || reduced ? 0 : (my / window.innerHeight - 0.5) * 28;

      orbs.forEach(function (orb, i) {
        var ox =
          orb.x * width +
          Math.sin(now * orb.speed + i) * (reduced ? 0 : 18) +
          parallaxX * (i + 1) * 0.25;
        var oy =
          orb.y * height +
          Math.cos(now * orb.speed + i * 1.3) * (reduced ? 0 : 14) +
          parallaxY * (i + 1) * 0.2;
        var gradient = ctx.createRadialGradient(ox, oy, 0, ox, oy, orb.r);
        gradient.addColorStop(0, 'rgba(' + orb.color + ',0.72)');
        gradient.addColorStop(0.45, 'rgba(' + orb.color + ',0.2)');
        gradient.addColorStop(1, 'rgba(0,0,0,0)');
        ctx.fillStyle = gradient;
        ctx.beginPath();
        ctx.arc(ox, oy, orb.r, 0, Math.PI * 2);
        ctx.fill();
      });

      if (!isMobile) {
        ctx.strokeStyle = 'rgba(244,240,230,0.08)';
        ctx.lineWidth = 1;
        var gap = 56;
        var influence = 110;
        var x;
        var y;
        for (x = 0; x <= width; x += gap) {
          ctx.beginPath();
          for (y = 0; y <= height; y += 12) {
            var dx = x - mx;
            var dy = y - my;
            var dist = Math.sqrt(dx * dx + dy * dy) || 1;
            var force = Math.max(influence - dist, 0) / influence;
            var px = x + (dx / dist) * force * -18;
            var py = y + (dy / dist) * force * -18;
            if (y === 0) {
              ctx.moveTo(px, py);
            } else {
              ctx.lineTo(px, py);
            }
          }
          ctx.stroke();
        }
      }

      frame = window.requestAnimationFrame(draw);
    }

    frame = window.requestAnimationFrame(draw);
  }

  CS.heroCanvas = {
    init: function () {
      CS.initOnce('heroCanvas', start);
    },
  };
  CS.heroCanvas.init();
})(window, document);
