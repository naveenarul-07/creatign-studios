(function (window, document) {
  'use strict';

  var CS = window.CreativeStudio;
  var open = false;

  function start() {
    var header = document.querySelector('.js-site-header');
    var toggle = document.querySelector('.js-menu-toggle');
    var menu = document.querySelector('.js-site-menu');
    var items = document.querySelectorAll('.js-site-menu-item');
    var iconOpen = document.querySelector('.js-menu-icon-open');
    var iconClose = document.querySelector('.js-menu-icon-close');

    if (!header) {
      return;
    }

    function setScrolled() {
      if (window.scrollY > 24) {
        header.classList.add('bg-ink/70', 'backdrop-blur-md');
      } else {
        header.classList.remove('bg-ink/70', 'backdrop-blur-md');
      }
    }

    function playEnter() {
      if (typeof gsap === 'undefined') {
        header.style.opacity = '1';
        header.style.transform = 'none';
        return;
      }
      if (CS.reduced) {
        gsap.set(header, { y: 0, opacity: 1 });
        return;
      }
      gsap.to(header, {
        y: 0,
        opacity: 1,
        duration: 0.8,
        delay: 0.05,
        ease: CS.easeOutExpo,
      });
    }

    function setOpen(next) {
      open = next;
      if (!toggle || !menu) {
        return;
      }

      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      toggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
      menu.setAttribute('aria-hidden', open ? 'false' : 'true');
      document.body.style.overflow = open ? 'hidden' : '';

      if (iconOpen && iconClose) {
        iconOpen.classList.toggle('hidden', open);
        iconClose.classList.toggle('hidden', !open);
      }

      if (CS.lenisInstance) {
        if (open) {
          CS.lenisInstance.stop();
        } else {
          CS.lenisInstance.start();
        }
      }

      if (typeof gsap === 'undefined') {
        menu.style.clipPath = open ? 'inset(0 0 0% 0)' : 'inset(0 0 100% 0)';
        menu.classList.toggle('pointer-events-none', !open);
        return;
      }

      if (open) {
        menu.classList.remove('pointer-events-none');
        gsap.fromTo(
          menu,
          { clipPath: 'inset(0 0 100% 0)' },
          {
            clipPath: 'inset(0 0 0% 0)',
            duration: CS.reduced ? 0 : 0.7,
            ease: CS.easeInOutExpo,
          }
        );
        gsap.fromTo(
          items,
          { y: 40, opacity: 0 },
          {
            y: 0,
            opacity: 1,
            duration: CS.reduced ? 0 : 0.6,
            ease: CS.easeOutExpo,
            delay: CS.reduced ? 0 : 0.15,
            stagger: CS.reduced ? 0 : 0.06,
          }
        );
      } else {
        gsap.to(menu, {
          clipPath: 'inset(0 0 100% 0)',
          duration: CS.reduced ? 0 : 0.7,
          ease: CS.easeInOutExpo,
          onComplete: function () {
            menu.classList.add('pointer-events-none');
            gsap.set(items, { y: 40, opacity: 0 });
          },
        });
      }
    }

    window.addEventListener('scroll', setScrolled, { passive: true });
    setScrolled();

    if (toggle) {
      toggle.addEventListener('click', function () {
        setOpen(!open);
      });
    }

    document.querySelectorAll('.js-site-menu-link').forEach(function (link) {
      link.addEventListener('click', function () {
        setOpen(false);
      });
    });

    CS.onReady(playEnter);
  }

  CS.navbar = { init: start };
  start();
})(window, document);
