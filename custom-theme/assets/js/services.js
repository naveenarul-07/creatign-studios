(function (window, document) {
  'use strict';

  var CS = window.CreativeStudio;

  function setActive(row, active) {
    var toggle = row.querySelector('.js-service-toggle');
    var head = row.querySelector('.js-service-head');
    var number = row.querySelector('.js-service-number');
    var arrow = row.querySelector('.js-service-arrow');
    var body = row.querySelector('.js-service-body');
    var copy = row.querySelector('.js-service-copy');

    if (toggle) {
      toggle.setAttribute('aria-expanded', active ? 'true' : 'false');
    }
    if (head) {
      head.classList.toggle('bg-paper', active);
      head.classList.toggle('text-ink', active);
      head.classList.toggle('md:py-10', active);
      head.classList.toggle('bg-transparent', !active);
      head.classList.toggle('md:py-8', !active);
    }
    if (number) {
      number.classList.toggle('translate-x-2', active);
      number.classList.toggle('text-accent-hot', active);
      number.classList.toggle('text-muted', !active);
    }
    if (arrow) {
      arrow.classList.toggle('rotate-45', active);
    }
    if (body) {
      body.classList.toggle('grid-rows-[1fr]', active);
      body.classList.toggle('grid-rows-[0fr]', !active);
    }
    if (copy) {
      copy.classList.toggle('bg-paper', active);
      copy.classList.toggle('text-ink/80', active);
      copy.classList.toggle('text-paper-dim', !active);
    }
  }

  function start() {
    var rows = Array.prototype.slice.call(document.querySelectorAll('.js-service-row'));
    if (!rows.length) {
      return;
    }

    var active = null;
    var pinned = null;

    function open(id) {
      active = id;
      CS.setCursorState({ variant: 'link' });
      rows.forEach(function (row) {
        setActive(row, row.getAttribute('data-service-id') === active);
      });
    }

    function close() {
      active = pinned;
      CS.setCursorState({ variant: 'default', label: '' });
      rows.forEach(function (row) {
        setActive(row, row.getAttribute('data-service-id') === active);
      });
    }

    function toggle(id) {
      if (pinned === id) {
        pinned = null;
        if (CS.isMobile()) {
          active = null;
        }
      } else {
        pinned = id;
        active = id;
      }
      rows.forEach(function (row) {
        setActive(row, row.getAttribute('data-service-id') === active);
      });
    }

    rows.forEach(function (row) {
      var id = row.getAttribute('data-service-id');
      row.addEventListener('mouseenter', function () {
        if (!CS.isMobile()) {
          open(id);
        }
      });
      row.addEventListener('mouseleave', function () {
        if (!CS.isMobile()) {
          close();
        }
      });
      var button = row.querySelector('.js-service-toggle');
      if (button) {
        button.addEventListener('click', function () {
          toggle(id);
        });
      }
    });
  }

  CS.services = {
    init: function () {
      CS.initOnce('services', start);
    },
  };
  CS.services.init();
})(window, document);
