(function (window, document) {
  'use strict';

  var CS = window.CreativeStudio;

  function start() {
    var heading = document.querySelector('.js-work-heading');
    if (heading && typeof gsap !== 'undefined') {
      if (CS.reduced) {
        gsap.set(heading, { y: '0%' });
      } else {
        gsap.to(heading, {
          y: '0%',
          duration: 0.9,
          ease: CS.easeOutExpo,
        });
      }
    }

    var cards = Array.prototype.slice.call(document.querySelectorAll('.js-project-card'));
    cards.forEach(function (card) {
      var index = Number(card.getAttribute('data-index') || 0);
      var visual = card.querySelector('.js-project-visual-shift');
      var link = card.querySelector('.js-project-link');

      if (typeof gsap !== 'undefined') {
        if (CS.reduced) {
          gsap.set(card, { opacity: 1, x: 0 });
        } else {
          window.setTimeout(function () {
            gsap.to(card, {
              opacity: 1,
              x: 0,
              duration: 0.8,
              delay: (index % 4) * 0.05,
              ease: CS.easeOutExpo,
            });
          }, 120 + index * 90);
        }
      } else {
        card.style.opacity = '1';
        card.style.transform = 'none';
      }

      if (!link || !visual || CS.reduced) {
        return;
      }

      link.addEventListener('mousemove', function (event) {
        var rect = visual.getBoundingClientRect();
        var px = (event.clientX - rect.left) / rect.width - 0.5;
        var py = (event.clientY - rect.top) / rect.height - 0.5;
        visual.style.transform =
          'translate3d(' + px * -10 + 'px, ' + py * -8 + 'px, 0) scale(1.04)';
      });

      link.addEventListener('mouseleave', function () {
        visual.style.transform = 'translate3d(0, 0, 0) scale(1)';
        CS.setCursorState({ variant: 'default', label: '' });
      });
    });
  }

  CS.projectCards = {
    init: function () {
      CS.initOnce('projectCards', start);
    },
  };
  CS.projectCards.init();
})(window, document);
