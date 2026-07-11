/* clone.js — wire lại tương tác cho markup tĩnh của live (React không hydrate).
   Tất cả dựa trên cấu trúc/class thật của live, query runtime, không hardcode id React. */
(function () {
  'use strict';
  var ready = function (fn) {
    if (document.readyState !== 'loading') fn();
    else document.addEventListener('DOMContentLoaded', fn);
  };

  // 1) VIDEO:
  //    - Video có thuộc tính autoplay (hero nền) -> ép muted + autoplay + loop.
  //    - Video KHÔNG có autoplay (vd testimonial, có poster + nút play) -> KHÔNG tự chạy,
  //      giữ poster, chỉ chạy khi bấm nút play / click vào video (đúng như live).
  function wireVideos() {
    [].forEach.call(document.querySelectorAll('video'), function (v) {
      v.setAttribute('playsinline', '');
      if (v.hasAttribute('autoplay') || v.autoplay) {
        v.muted = true; v.loop = (v.loop || v.hasAttribute('loop'));
        var p = v.play();
        if (p && p.catch) p.catch(function () {/* autoplay bị chặn -> bỏ qua */});
      } else {
        try { v.pause(); } catch (e) {}
        wireClickToPlay(v);
      }
    });
  }

  function wireClickToPlay(v) {
    // overlay phủ (lớp đen + nút play) thường là sibling ngay sau <video>
    var overlay = v.nextElementSibling;
    if (!(overlay && /\babsolute\b/.test(overlay.className || ''))) {
      overlay = (v.parentElement &&
        [].slice.call(v.parentElement.children).filter(function (c) {
          return c !== v && /\babsolute\b/.test(c.className || '') && c.querySelector('button,svg');
        })[0]) || overlay;
    }
    var playBtn = overlay ? overlay.querySelector('button') : null;
    var started = false;
    function start(e) {
      if (e) { e.preventDefault(); }
      if (started) { v.paused ? v.play().catch(function(){}) : v.pause(); return; }
      started = true;
      v.muted = false; v.controls = true;
      var p = v.play();
      if (p && p.catch) p.catch(function () { v.muted = true; v.play().catch(function(){}); });
      if (overlay) overlay.style.display = 'none';
    }
    if (playBtn) playBtn.addEventListener('click', start);
    v.addEventListener('click', start);
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
    var hash = '', hi = rel.indexOf('#');
    if (hi >= 0) { hash = rel.slice(hi); rel = rel.slice(0, hi); }
    var u = b.base + b.lang + '/' + rel;
    if (rel && !/\.[a-z0-9]+$/i.test(rel) && u.slice(-1) !== '/') u += '/';
    return u + hash;
  }
  // URL của trang hiện tại ở ngôn ngữ khác (cho nút chuyển VI/EN)
  function langUrl(lang) {
    var nb = navBase(), p = location.pathname;
    var rel = (p.indexOf(nb.base) === 0) ? p.slice(nb.base.length) : p.replace(/^\//, '');
    rel = rel.replace(/^(vi|en)(\/|$)/, '');
    rel = rel.replace(/^\//, '');
    var u = nb.base + lang + '/' + rel;
    if (rel && u.slice(-1) !== '/') u += '/';
    return u + location.search + location.hash;
  }
  function wireLangSwitch() {
    [].forEach.call(document.querySelectorAll('img[src*="en.svg"],img[src*="vi.svg"]'), function (img) {
      var lang = /en\.svg/.test(img.getAttribute('src') || '') ? 'en' : 'vi';
      var box = img.closest('div') || img.parentElement;
      if (!box) return;
      box.style.cursor = 'pointer';
      box.addEventListener('click', function () { location.href = langUrl(lang); });
    });
  }
  var DD_ALL = {
    vi: {
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
    },
    en: {
      'Our Services & Products': { mega: true, cols: [
        [ { t: 'Training programs', h: 'our-services', head: true },
          { t: 'Business', sub: true },
          { t: 'For Leader/Manager', h: 'our-services/for-manager' },
          { t: 'For Team member', h: 'our-services/for-team-member' } ],
        [ { t: 'Individual', sub: true },
          { t: 'Executive coach', h: 'our-services/executive-coach' },
          { t: 'Individual courses', h: 'our-services/individual-courses', arrow: true } ],
        [ { t: 'Our Products', h: 'products', head: true },
          { t: 'Tet Gift Box', h: 'products/tet-gift-box', badge: 'New 2026' },
          { t: 'The Emotional Intelligence (EQ) guidebook for Leaders, Managers', h: 'products/heart-heart-hand' },
          { t: 'The Emotional Intelligence (EQ) Decks', h: 'products#card' },
          { t: 'Ebook', h: 'products/the-story-of-empathy' },
          { t: 'The EQ Calendar', h: 'products/the-eq-calendar', badge: 'New 2026' } ]
      ] },
      'Assessment & Resources': { cols: [[
        { t: 'Emotional Intelligence Quiz', h: 'eq-quiz' },
        { t: 'Resources', h: 'resources' },
        { t: 'EQ with Ngan Tran', h: 'eq-with-ngan-tran' }
      ]] },
      'Events': { cols: [[
        { t: 'Current Event', h: 'events#upcoming-events' },
        { t: 'Workshop', h: 'events#partner-events' },
        { t: 'Previous Event', h: 'events#previous-events' }
      ]] }
    }
  };
  var DD = DD_ALL[navBase().lang] || DD_ALL.vi;
  function ddItem(it) {
    if (it.sub) return '<p class="font-bold !text-[#232323] mt-3 mb-1">' + it.t + '</p>';
    var badge = it.badge ? ' <span class="align-middle text-xs text-white bg-primary rounded-full px-2 py-0.5 ml-1 whitespace-nowrap">' + it.badge + '</span>' : '';
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

      function isMobile() { return window.matchMedia('(max-width: 767px)').matches; }

      function place() {
        if (isMobile()) {
          // Mobile: xổ inline ngay dưới nút trong menu hamburger (không nổi, không tràn)
          panel.style.position = 'static';
          panel.style.left = ''; panel.style.top = ''; panel.style.transform = '';
          panel.style.width = '100%';
          panel.style.boxShadow = 'none'; panel.style.border = '0';
          if (btn.nextElementSibling !== panel) btn.insertAdjacentElement('afterend', panel);
          return;
        }
        // Desktop: panel nổi dưới header (đưa lại vào header nếu trước đó đã inline cho mobile)
        if (panel.parentElement !== (header || document.body)) (header || document.body).appendChild(panel);
        panel.style.boxShadow = ''; panel.style.border = '';
        if (cfg.mega) {
          var hb = (header || document.body).getBoundingClientRect();
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

      btn.addEventListener('mouseenter', function () { if (!isMobile()) show(); });
      btn.addEventListener('mouseleave', function () { if (!isMobile()) lazyHide(); });
      panel.addEventListener('mouseenter', function () { if (!isMobile()) clearTimeout(hideT); });
      panel.addEventListener('mouseleave', function () { if (!isMobile()) lazyHide(); });
      btn.addEventListener('click', function (e) { e.preventDefault(); open ? hide() : show(); });
      window.addEventListener('resize', function () { if (open) place(); });
      window.addEventListener('scroll', function () { if (open) place(); }, { passive: true });
    });
  }

  // 6) INTERNAL LINK REWRITER — markup live dùng link kiểu live (/vi/x, /x, vi.html,
  //    bare-relative) -> chuẩn hoá về base+lang đúng cho cả Local lẫn demo gh-pages.
  function isAsset(p) {
    return /\.(svg|png|jpe?g|webp|gif|ico|css|js|mp4|webm|pdf|woff2?|xml|json)(\?|#|$)/i.test(p)
        || /\/(wp-content|wp-includes|wp-admin|wp-json|clone|_next)\//.test(p);
  }
  function wireInternalLinks() {
    var nb = navBase();
    var baseClean = nb.base.replace(/^\//, '').replace(/\/$/, ''); // 'thenewleaders' hoặc ''
    [].forEach.call(document.querySelectorAll('a[href]'), function (a) {
      var raw = a.getAttribute('href');
      if (!raw || /^(#|mailto:|tel:|javascript:)/i.test(raw)) return;
      // external/absolute http: chỉ xử lý nếu cùng origin
      if (/^https?:\/\//i.test(raw)) {
        try { var uu = new URL(raw); if (uu.origin !== location.origin) return; raw = uu.pathname + uu.search + uu.hash; }
        catch (e) { return; }
      }
      if (isAsset(raw)) return;
      // tách query/hash
      var suffix = '', qi = raw.search(/[?#]/);
      if (qi >= 0) { suffix = raw.slice(qi); raw = raw.slice(0, qi); }
      if (!raw && suffix) return; // link chỉ có hash đã loại ở trên
      var rel;
      if (raw.charAt(0) === '/') {
        rel = raw.replace(/^\//, '');
      } else {
        try { rel = new URL(raw, location.href).pathname.replace(/^\//, ''); } catch (e) { return; }
      }
      if (baseClean && rel.indexOf(baseClean + '/') === 0) rel = rel.slice(baseClean.length + 1);
      // giữ lang đích nếu link tự khai báo (để nút chuyển VI/EN đúng)
      var linkLang = nb.lang, m = rel.match(/^(vi|en)(\/|$)/);
      if (m) { linkLang = m[1]; rel = rel.slice(m[0].length); }
      rel = rel.replace(/\.html$/, '').replace(/^\//, '');
      var newHref = nb.base + linkLang + '/' + rel;
      if (rel && !/\.[a-z0-9]+$/i.test(rel) && newHref.slice(-1) !== '/') newHref += '/';
      a.setAttribute('href', newHref + suffix);
    });
  }

  // 7) PILL HIGHLIGHT WIPE — markup live dùng <div style="clip-path:inset(0 100% 0 0)">
  //    (framer-motion reveal khi cuộn). React không hydrate -> ô kẹt ẩn/cắt chữ.
  //    Tự reveal theo scroll bằng cùng công thức wipe có stagger.
  function wirePillWipe() {
    var pills = [].slice.call(document.querySelectorAll('[style*="clip-path"]'))
      .filter(function (el) { return /clip-path\s*:\s*inset\(/i.test(el.getAttribute('style') || ''); });
    if (!pills.length) return;
    // gom theo container cha (mỗi nhóm có tiến trình cuộn riêng)
    var groups = [];
    pills.forEach(function (el) {
      var wrap = el.parentElement;
      var g = groups.filter(function (x) { return x.wrap === wrap; })[0];
      if (!g) { g = { wrap: wrap, items: [] }; groups.push(g); }
      g.items.push(el);
    });
    function makeUpdater(g) {
      var STAGGER = 0.14, span = 1 - STAGGER * (g.items.length - 1);
      return function () {
        var rect = g.wrap.getBoundingClientRect();
        var vh = window.innerHeight || document.documentElement.clientHeight;
        var startY = vh * 0.88, endY = vh * 0.35;
        var p = (startY - rect.top) / (startY - endY);
        p = Math.max(0, Math.min(1, p));
        for (var i = 0; i < g.items.length; i++) {
          var pp = (p - i * STAGGER) / span;
          pp = Math.max(0, Math.min(1, pp));
          g.items[i].style.clipPath = 'inset(0 ' + ((1 - pp) * 100).toFixed(2) + '% 0 0)';
        }
      };
    }
    var updaters = groups.map(makeUpdater), ticking = false;
    function runAll() { ticking = false; updaters.forEach(function (u) { u(); }); }
    function onScroll() { if (!ticking) { ticking = true; requestAnimationFrame(runAll); } }
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll, { passive: true });
    runAll();
  }

  ready(function () {
    wireVideos();
    wireHeroButtons();
    wireHamburger();
    wireCarousels();
    wireInternalLinks();
    wireLangSwitch();
    wireDropdowns();
    wirePillWipe();
  });
})();
