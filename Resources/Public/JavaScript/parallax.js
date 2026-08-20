(function () {
  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)');
  var heroes = [];
  var ticking = false;

  function collect() {
    heroes = Array.prototype.slice.call(document.querySelectorAll('.parallax-hero'));
  }

  function shift() {
    ticking = false;
    if (reduced.matches) {
      return;
    }
    var vh = window.innerHeight || 1;
    heroes.forEach(function (hero) {
      var img = hero.querySelector('.parallax-hero__img');
      if (!img) {
        return;
      }
      var rect = hero.getBoundingClientRect();
      if (rect.bottom < 0 || rect.top > vh) {
        return;
      }
      var progress = (vh / 2 - (rect.top + rect.height / 2)) / vh;
      var max = Math.max(80, rect.height * 0.45);
      img.style.transform = 'translate3d(0, ' + (progress * max) + 'px, 0)';
    });
  }

  function onScroll() {
    if (!ticking) {
      ticking = true;
      window.requestAnimationFrame(shift);
    }
  }

  collect();
  shift();
  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', function () {
    collect();
    onScroll();
  });
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
      collect();
      shift();
    });
  }
})();
