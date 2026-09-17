(function (window, document) {
  'use strict';

  var CS = window.CreativeStudio;

  function start() {
    var items = Array.prototype.slice.call(document.querySelectorAll('.js-testimonial-item'));
    var tabs = Array.prototype.slice.call(document.querySelectorAll('.js-testimonial-tab'));
    if (!items.length) {
      return;
    }

    var index = 0;
    var timer;
    var animating = false;

    function setTabs(next) {
      tabs.forEach(function (tab, i) {
        var selected = i === next;
        tab.classList.toggle('bg-accent', selected);
        tab.classList.toggle('bg-line', !selected);
        tab.setAttribute('aria-selected', selected ? 'true' : 'false');
      });
    }

    function show(next, immediate) {
      if (next === index && !immediate) {
        return;
      }
      if (animating) {
        return;
      }
      var current = items[index];
      var incoming = items[next];
      if (!incoming) {
        return;
      }

      function enter() {
        items.forEach(function (item, i) {
          if (i !== next) {
            item.style.pointerEvents = 'none';
          }
        });
        incoming.style.pointerEvents = '';
        if (typeof gsap === 'undefined' || CS.reduced || immediate) {
          if (typeof gsap !== 'undefined') {
            gsap.set(incoming, { opacity: 1, y: 0, filter: 'blur(0px)' });
          }
          incoming.style.opacity = '1';
          incoming.style.transform = 'none';
          incoming.style.filter = 'none';
          animating = false;
          return;
        }
        gsap.fromTo(
          incoming,
          { opacity: 0, y: 24, filter: 'blur(8px)' },
          {
            opacity: 1,
            y: 0,
            filter: 'blur(0px)',
            duration: 0.7,
            ease: CS.easeOutExpo,
            onComplete: function () {
              animating = false;
            },
          }
        );
      }

      animating = true;
      setTabs(next);

      if (immediate || CS.reduced || typeof gsap === 'undefined' || !current) {
        if (current && current !== incoming) {
          current.style.opacity = '0';
          current.style.pointerEvents = 'none';
        }
        index = next;
        enter();
        return;
      }

      gsap.to(current, {
        opacity: 0,
        y: -16,
        filter: 'blur(8px)',
        duration: 0.7,
        ease: CS.easeOutExpo,
        onComplete: function () {
          current.style.pointerEvents = 'none';
          index = next;
          enter();
        },
      });
    }

    function next() {
      show((index + 1) % items.length);
    }

    function startTimer() {
      window.clearInterval(timer);
      if (CS.reduced || items.length < 2) {
        return;
      }
      timer = window.setInterval(next, 7000);
    }

    if (typeof gsap !== 'undefined' && !CS.reduced) {
      gsap.fromTo(
        items[0],
        { opacity: 0, y: 24, filter: 'blur(8px)' },
        { opacity: 1, y: 0, filter: 'blur(0px)', duration: 0.7, ease: CS.easeOutExpo }
      );
    } else {
      items[0].style.opacity = '1';
      items[0].style.transform = 'none';
      items[0].style.filter = 'none';
    }

    tabs.forEach(function (tab) {
      tab.addEventListener('click', function () {
        var nextIndex = Number(tab.getAttribute('data-index') || 0);
        show(nextIndex);
        startTimer();
      });
    });

    startTimer();
  }

  CS.testimonials = {
    init: function () {
      CS.initOnce('testimonials', start);
    },
  };
  CS.testimonials.init();
})(window, document);
