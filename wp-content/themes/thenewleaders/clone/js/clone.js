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

  // 5) NAV DROPDOWNS — submenu không có trong static DOM (React render on-open).
  //    Dựng lại từ data của live, mở bằng hover (desktop) + click (mobile/touch).
  function navBase() {
    var m = location.pathname.match(/^(.*?\/)(vi|en)\//);
    return { base: m ? m[1] : '/', lang: m ? m[2] : 'vi' };
  }
  function href(rel) {
    var b = navBase();
    rel = rel.replace(/^\/(vi|en)\//, '').replace(/^\//, '');
    return b.base + b.lang + '/' + rel;
  }
  var DD = {
    'Sản phẩm & Dịch vụ': { mega: true, cols: [
      [ { t: 'Chương trình đào tạo', h: 'our-services', head: true },
        { t: 'Doanh nghiệp', sub: true },
        { t: 'Dành cho quản lý', h: 'our-services/for-manager' },
        { t: 'Dành cho đội nhóm', h: 'our-services/for-team-member' } ],
      [ { t: 'Cá nhân', sub: true },
        { t: 'Coaching cho lãnh đạo', h: 'our-services/executive-coach' },
        { t: 'Khóa cá nhân', h: 'our-services/individual-courses', arrow: true } ],
      [ { t: 'Sản phẩm', h: 'products', head: true },
        { t: 'SELI - Strategic EQ Leadership Index', h: 'products/seli-strategic-eq-leadership-index', badge: 'công cụ' },
        { t: 'Cẩm nang EQ cho quản lý, lãnh đạo', h: 'products/heart-heart-hand' },
        { t: 'Bộ bài giao tiếp EQ', h: 'products#card' },
        { t: 'Sách điện tử', h: 'products/the-story-of-empathy' },
        { t: 'The EQ Calendar', h: 'products/the-eq-calendar', badge: 'New 2026' } ]
    ] },
    'Đánh giá & Tài nguyên': { cols: [[
      { t: 'Bài trắc nghiệm Trí tuệ cảm xúc', h: 'eq-quiz' },
      { t: 'Tài nguyên', h: 'resources' },
      { t: 'EQ với Ngân Trần', h: 'eq-with-ngan-tran' }
    ]] },
    'Sự kiện': { cols: [[
      { t: 'Sự kiện đang diễn ra', h: 'events#upcoming-events' },
      { t: 'Workshop', h: 'events#partner-events' },
      { t: 'Sự kiện đã diễn ra', h: 'events#previous-events' }
    ]] }
  };
  function ddItem(it) {
    if (it.sub) return '<p class="font-bold !text-[#232323] mt-3 mb-1">' + it.t + '</p>';
    var badge = it.badge ? ' <span class="align-middle text-xs text-white bg-primary rounded-full px-2 py-0.5 ml-1">' + it.badge + '</span>' : '';
    var arrow = it.arrow ? ' <span aria-hidden="true">›</span>' : '';
    var cls = 'block py-1.5 hover:!text-primary !text-[#232323] ' + (it.head ? 'font-bold' : '');
    return '<a href="' + href(it.h) + '" class="' + cls + '">' + it.t + badge + arrow + '</a>';
  }
  function buildPanel(label, cfg) {
    var panel = document.createElement('div');
    panel.className = 'tnl-dd z-50 divide-y divide-gray-100 rounded shadow border border-gray-200 bg-white text-gray-900';
    panel.style.cssText = 'position:absolute;display:none;';
    var cols = cfg.cols.map(function (col) {
      return '<div>' + col.map(ddItem).join('') + '</div>';
    }).join('');
    var gridCls = cfg.mega
      ? 'mx-auto w-full max-w-screen-xl p-6 grid grid-cols-1 md:grid-cols-3 gap-x-10 text-md md:text-xl font-normal'
      : 'p-4 text-md md:text-lg font-normal min-w-[240px]';
    panel.innerHTML = '<div class="py-1 focus:outline-none"><div class="' + gridCls + '">' + cols + '</div></div>';
    return panel;
  }
  function wireDropdowns() {
    var header = document.querySelector('nav.navbar') || document.querySelector('nav');
    [].forEach.call(document.querySelectorAll('button[aria-haspopup="menu"]'), function (btn) {
      var label = (btn.textContent || '').replace(/\s+/g, ' ').trim();
      var cfg = DD[label];
      if (!cfg) return;
      // Nav dùng <button> trực tiếp trong <ul> (không có <li>) -> trigger hover là chính btn,
      // KHÔNG dùng parentElement (sẽ là <ul> chung cho cả 3 nút).
      var panel = buildPanel(label, cfg);
      (header || document.body).appendChild(panel);

      function place() {
        if (cfg.mega) {
          var hb = (header || li).getBoundingClientRect();
          panel.style.position = 'fixed';
          panel.style.left = '50%';
          panel.style.transform = 'translateX(-50%)';
          panel.style.top = (hb.bottom) + 'px';
          panel.style.width = 'min(100% - 2rem, 1280px)';
        } else {
          var r = btn.getBoundingClientRect();
          panel.style.position = 'fixed';
          panel.style.left = r.left + 'px';
          panel.style.top = (r.bottom + 8) + 'px';
        }
      }
      var open = false, hideT;
      function show() { clearTimeout(hideT); place(); panel.style.display = 'block'; btn.setAttribute('aria-expanded', 'true'); open = true; }
      function hide() { panel.style.display = 'none'; btn.setAttribute('aria-expanded', 'false'); open = false; }
      function lazyHide() { hideT = setTimeout(hide, 180); }

      btn.addEventListener('mouseenter', show);
      btn.addEventListener('mouseleave', lazyHide);
      panel.addEventListener('mouseenter', function () { clearTimeout(hideT); });
      panel.addEventListener('mouseleave', lazyHide);
      btn.addEventListener('click', function (e) { e.preventDefault(); open ? hide() : show(); });
      window.addEventListener('resize', function () { if (open) place(); });
      window.addEventListener('scroll', function () { if (open) place(); }, { passive: true });
    });
  }

  ready(function () {
    wireVideos();
    wireHeroButtons();
    wireHamburger();
    wireCarousels();
    wireDropdowns();
  });
})();
