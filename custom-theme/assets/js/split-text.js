(function (window, document) {
  'use strict';

  var CS = window.CreativeStudio;

  function playHero() {
    if (typeof gsap === 'undefined') {
      return;
    }

    var wrap = document.querySelector('.js-hero-canvas-wrap');
    var eyebrow = document.querySelector('.js-hero-eyebrow');
    var lines = document.querySelectorAll('.js-hero-line');
    var body = document.querySelector('.js-hero-body');
    var ctas = document.querySelector('.js-hero-ctas');
    var scroll = document.querySelector('.js-hero-scroll');

    if (CS.reduced) {
      var reducedTargets = [wrap, eyebrow, body, ctas, scroll].filter(Boolean);
      lines.forEach(function (line) {
        reducedTargets.push(line);
      });
      if (reducedTargets.length) {
        gsap.set(reducedTargets, { opacity: 1, y: 0, clearProps: 'filter' });
      }
      return;
    }

    if (wrap) {
      gsap.to(wrap, { opacity: 1, duration: 1.2, ease: CS.easeOutExpo });
    }
    if (eyebrow) {
      gsap.to(eyebrow, { opacity: 1, y: 0, delay: 0.15, duration: 0.7, ease: CS.easeOutExpo });
    }
    if (lines.length) {
      gsap.to(lines, {
        y: '0%',
        duration: 1.05,
        ease: CS.easeOutExpo,
        delay: 0.28,
        stagger: 0.12,
      });
    }
    if (body) {
      gsap.to(body, { opacity: 1, y: 0, delay: 0.85, duration: 0.8, ease: CS.easeOutExpo });
    }
    if (ctas) {
      gsap.to(ctas, { opacity: 1, y: 0, delay: 1.05, duration: 0.7, ease: CS.easeOutExpo });
    }
    if (scroll) {
      gsap.to(scroll, { opacity: 1, delay: 1.3, duration: 0.4, ease: CS.easeOutExpo });
    }
  }

  function playSplits() {
    if (typeof gsap === 'undefined') {
      return;
    }

    var words = document.querySelectorAll('.js-split-word');
    var lines = document.querySelectorAll('.js-split-line');

    if (CS.reduced) {
      if (words.length) {
        gsap.set(words, { y: '0%', opacity: 1 });
      }
      if (lines.length) {
        gsap.set(lines, { y: '0%' });
      }
      return;
    }

    window.setTimeout(function () {
      words.forEach(function (word) {
        gsap.to(word, {
          y: '0%',
          opacity: 1,
          duration: 0.75,
          delay: Number(word.getAttribute('data-delay') || 0),
          ease: CS.easeOutExpo,
        });
      });
      lines.forEach(function (line) {
        gsap.to(line, {
          y: '0%',
          duration: 0.9,
          delay: Number(line.getAttribute('data-delay') || 0),
          ease: CS.easeOutExpo,
        });
      });
    }, 60);
  }

  function playIntroParallax() {
    var intro = document.querySelector('.js-intro');
    var target = document.querySelector('.js-intro-parallax');
    if (!intro || !target || typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
      return;
    }
    if (CS.reduced) {
      return;
    }
    gsap.registerPlugin(ScrollTrigger);
    gsap.fromTo(
      target,
      { y: 40 },
      {
        y: -40,
        ease: 'none',
        scrollTrigger: {
          trigger: intro,
          start: 'top bottom',
          end: 'bottom top',
          scrub: true,
        },
      }
    );
  }

  function start() {
    playSplits();
    playIntroParallax();
    CS.onReady(playHero);
  }

  CS.splitText = {
    init: function () {
      CS.initOnce('splitText', start);
    },
  };
  CS.splitText.init();
})(window, document);
