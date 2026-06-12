/* clone.js — wire lại tương tác cho markup tĩnh của live (React không hydrate).
   Tất cả dựa trên cấu trúc/class thật của live, query runtime, không hardcode id React. */
(function () {
  'use strict';
  var ready = function (fn) {
    if (document.readyState !== 'loading') fn();
    else document.addEventListener('DOMContentLoaded', fn);
  };

  // 1) VIDEO: ép muted + autoplay + loop (autoPlay attr của React không luôn chạy)
  function wireVideos() {
    [].forEach.call(document.querySelectorAll('video'), function (v) {
      v.muted = true; v.loop = (v.loop || v.hasAttribute('loop'));
      v.setAttribute('playsinline', '');
      var p = v.play();
      if (p && p.catch) p.catch(function () {/* autoplay bị chặn -> bỏ qua */});
    });
  }

  // 2) HERO buttons: "Bật tiếng" toggle mute, "Đi tiếp" cuộn qua hero
  function wireHeroButtons() {
    var heroVideo = document.querySelector('video');
    [].forEach.call(document.querySelectorAll('button'), function (btn) {
      var span = btn.querySelector('span');
      var label = (span ? span.textContent : btn.textContent || '').trim();
      if (label === 'Bật tiếng' || label === 'Tắt tiếng' || label === 'Unmute' || label === 'Mute') {
        btn.addEventListener('click', function () {
          if (!heroVideo) return;
          heroVideo.muted = !heroVideo.muted;
          if (!heroVideo.muted) { heroVideo.play().catch(function(){}); }
          var on = heroVideo.muted;
          if (span) span.textContent = on ? (label.indexOf('Bật') >= 0 || label.indexOf('Tắt') >= 0 ? 'Bật tiếng' : 'Unmute')
                                           : (label.indexOf('Bật') >= 0 || label.indexOf('Tắt') >= 0 ? 'Tắt tiếng' : 'Mute');
        });
      }
      if (label === 'Đi tiếp' || label === 'Skip' || label === 'Continue') {
        btn.addEventListener('click', function () {
          var hero = btn.closest('section, [class*="h-screen"], [class*="min-h"]') || document.body.firstElementChild;
          var top = hero ? (hero.getBoundingClientRect().bottom + window.scrollY) : window.innerHeight;
          window.scrollTo({ top: top - 80, behavior: 'smooth' });
        });
      }
    });
  }

  // 3) HAMBURGER (mobile): toggle collapse #navbar (flowbite: class hidden <-> block)
  function wireHamburger() {
    var toggle = document.querySelector('[data-testid="flowbite-navbar-toggle"]');
    var collapse = document.getElementById('navbar') || document.querySelector('[data-testid="flowbite-navbar-collapse"]');
    if (!toggle || !collapse) return;
    toggle.addEventListener('click', function () {
      collapse.classList.toggle('hidden');
      var open = !collapse.classList.contains('hidden');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  }

  // 4) CAROUSEL (embla-style): viewport .overflow-hidden > track .flex > slides[role=group]
  function wireCarousels() {
    var roots = document.querySelectorAll('[aria-roledescription="carousel"]');
    [].forEach.call(roots, function (root) {
      var viewport = root.querySelector('.overflow-hidden');
      if (!viewport) return;
      var track = viewport.firstElementChild;
      if (!track) return;
      var slides = [].filter.call(track.children, function (c) {
        return c.getAttribute('role') === 'group' || c.getAttribute('aria-roledescription') === 'slide';
      });
      if (slides.length < 2) return;
      track.style.transition = 'transform .5s ease';
      track.style.willChange = 'transform';
      var idx = 0;
      function go(i) {
        idx = (i + slides.length) % slides.length;
        var x = slides[idx].offsetLeft - slides[0].offsetLeft;
        track.style.transform = 'translateX(' + (-x) + 'px)';
      }
      // nút prev/next: button có sr-only "Previous/Next slide", nằm trong root
      var btns = [].filter.call(root.querySelectorAll('button'), function (b) {
        return /slide/i.test(b.textContent || '');
      });
      btns.forEach(function (b) {
        // React render nút ở trạng thái disabled (vì không hydrate) -> bật lại
        b.disabled = false; b.removeAttribute('disabled');
        var prev = /prev|trước/i.test(b.textContent || '');
        b.addEventListener('click', function (e) { e.preventDefault(); go(idx + (prev ? -1 : 1)); });
      });
      // autoplay 4s, dừng khi hover, đi vòng
      var timer = setInterval(function () { go(idx + 1); }, 4000);
      root.addEventListener('mouseenter', function () { clearInterval(timer); });
      root.addEventListener('mouseleave', function () { timer = setInterval(function () { go(idx + 1); }, 4000); });
      window.addEventListener('resize', function () { go(idx); });
    });
  }

  ready(function () {
    wireVideos();
    wireHeroButtons();
    wireHamburger();
    wireCarousels();
  });
})();
