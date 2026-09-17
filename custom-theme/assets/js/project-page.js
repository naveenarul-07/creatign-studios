(function (window, document) {
  'use strict';

  var CS = window.CreativeStudio;

  function start() {
    var media = document.querySelector('.js-project-hero-media');
    if (!media) {
      return;
    }

    if (typeof gsap === 'undefined') {
      media.style.clipPath = 'inset(0% 0 0 0)';
      media.style.transform = 'scale(1)';
      return;
    }

    if (CS.reduced) {
      gsap.set(media, { clipPath: 'inset(0% 0 0 0)', scale: 1 });
      return;
    }

    gsap.fromTo(
      media,
      { clipPath: 'inset(100% 0 0 0)', scale: 1.08 },
      {
        clipPath: 'inset(0% 0 0 0)',
        scale: 1,
        duration: 1.1,
        ease: CS.easeOutExpo,
      }
    );
  }

  CS.projectPage = {
    init: function () {
      CS.initOnce('projectPage', start);
    },
  };
  CS.projectPage.init();
})(window, document);
