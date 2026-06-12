/**
 * The New Leaders — Main JS
 */

(function () {
  'use strict';

  // ============================================================
  // STICKY HEADER
  // ============================================================
  const header = document.getElementById('site-header');
  if (header) {
    const onScroll = () => header.classList.toggle('is-scrolled', window.scrollY > 40);
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  // ============================================================
  // MOBILE NAV
  // ============================================================
  const hamburger = document.querySelector('.site-header__hamburger');
  if (hamburger && header) {
    hamburger.addEventListener('click', () => {
      const isOpen = header.classList.toggle('is-open');
      hamburger.setAttribute('aria-expanded', isOpen);
      document.body.style.overflow = isOpen ? 'hidden' : '';
    });
  }
  document.querySelectorAll('.nav-menu a').forEach(link => {
    link.addEventListener('click', () => {
      header?.classList.remove('is-open');
      hamburger?.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    });
  });

  // Mega dropdown: accordion trên mobile (chỉ khi menu mobile đang mở)
  document.querySelectorAll('.nav-toggle').forEach(btn => {
    btn.addEventListener('click', () => {
      if (!header?.classList.contains('is-open')) return; // desktop dùng hover
      const li = btn.closest('.nav-item');
      const open = li.classList.toggle('is-open');
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  });

  // ============================================================
  // SMOOTH SCROLL
  // ============================================================
  document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', (e) => {
      const target = document.querySelector(link.getAttribute('href'));
      if (!target) return;
      e.preventDefault();
      const top = target.getBoundingClientRect().top + window.scrollY - 56;
      window.scrollTo({ top, behavior: 'smooth' });
    });
  });

  // ============================================================
  // HERO VIDEO MUTE TOGGLE
  // ============================================================
  const muteBtn = document.querySelector('.hero__mute-btn');
  const heroVideo = document.querySelector('.hero__video');
  if (muteBtn && heroVideo) {
    muteBtn.addEventListener('click', () => {
      heroVideo.muted = !heroVideo.muted;
      const isMuted = heroVideo.muted;
      muteBtn.querySelector('.icon-muted').style.display  = isMuted ? '' : 'none';
      muteBtn.querySelector('.icon-unmuted').style.display = isMuted ? 'none' : '';
      muteBtn.querySelector('span').textContent = isMuted ? 'Unmute' : 'Mute';
    });
  }

  // ============================================================
  // GROWING CAROUSEL
  // ============================================================
  const track = document.getElementById('growingTrack');
  const prevBtn = document.getElementById('growingPrev');
  const nextBtn = document.getElementById('growingNext');
  if (track && prevBtn && nextBtn) {
    let offset = 0;

    // STEP = 1 item width = 50% of wrap (dynamic, responsive)
    const getStep = () => {
      const first = track.querySelector('.growing__item');
      return first ? first.offsetWidth : track.parentElement.offsetWidth / 2;
    };

    const getMax = () => {
      const items = track.querySelectorAll('.growing__item');
      const step = getStep();
      return Math.max(0, items.length * step - track.parentElement.offsetWidth);
    };

    const slide = (dir) => {
      const step = getStep();
      offset = Math.max(0, Math.min(offset + dir * step, getMax()));
      track.style.transform = `translateX(-${offset}px)`;
    };

    prevBtn.addEventListener('click', () => slide(-1));
    nextBtn.addEventListener('click', () => slide(1));

    // Drag to scroll
    let startX = 0, dragging = false;
    track.addEventListener('mousedown', (e) => { dragging = true; startX = e.clientX; track.style.transition = 'none'; });
    track.addEventListener('mousemove', (e) => {
      if (!dragging) return;
      const diff = startX - e.clientX;
      offset = Math.max(0, Math.min(offset + diff, getMax()));
      track.style.transform = `translateX(-${offset}px)`;
      startX = e.clientX;
    });
    track.addEventListener('mouseup',   () => { dragging = false; track.style.transition = ''; });
    track.addEventListener('mouseleave',() => { dragging = false; track.style.transition = ''; });
  }

  // ============================================================
  // CTA WORDS ANIMATION
  // ============================================================
  const words = document.querySelectorAll('.cta-word');
  if (words.length) {
    let current = 0;
    words[0].classList.add('active');
    setInterval(() => {
      words[current].classList.remove('active');
      current = (current + 1) % words.length;
      words[current].classList.add('active');
    }, 800);
  }

  // ============================================================
  // WHAT WE DO — PILLS HIGHLIGHT WIPE (scroll-linked / scrubbed)
  // ============================================================
  const pills = Array.from(document.querySelectorAll('.wwd-pill'));
  const pillsWrap = document.querySelector('.what-we-do__pills');
  if (pills.length && pillsWrap) {
    const STAGGER = 0.14;                       // overlap between consecutive pills
    const span = 1 - STAGGER * (pills.length - 1); // each pill's own reveal length
    let ticking = false;

    const updatePills = () => {
      ticking = false;
      const rect = pillsWrap.getBoundingClientRect();
      const vh = window.innerHeight || document.documentElement.clientHeight;
      // progress 0 → 1 as the block rises from 88% to 35% of the viewport
      const startY = vh * 0.88;
      const endY = vh * 0.35;
      let p = (startY - rect.top) / (startY - endY);
      p = Math.max(0, Math.min(1, p));
      for (let i = 0; i < pills.length; i++) {
        let pp = (p - i * STAGGER) / span;       // staggered sub-progress
        pp = Math.max(0, Math.min(1, pp));
        pills[i].style.clipPath = `inset(0 ${((1 - pp) * 100).toFixed(2)}% 0 0)`;
      }
    };

    const onScrollPills = () => {
      if (!ticking) { ticking = true; requestAnimationFrame(updatePills); }
    };
    window.addEventListener('scroll', onScrollPills, { passive: true });
    window.addEventListener('resize', onScrollPills, { passive: true });
    updatePills();
  }

  // ============================================================
  // SCROLL REVEAL
  // ============================================================
  if ('IntersectionObserver' in window) {
    const els = document.querySelectorAll(
      '.wwd-card, .tcard, .value-card, .why-us-card, .about__point, .growing__item'
    );
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

    els.forEach((el, i) => {
      el.style.setProperty('--reveal-delay', `${(i % 4) * 80}ms`);
      el.classList.add('reveal');
      observer.observe(el);
    });
  }

  // ============================================================
  // AJAX FORMS (contact / newsletter / order)
  // ============================================================
  document.querySelectorAll('.tnl-ajax-form').forEach((form) => {
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const msg = form.querySelector('.tnl-form-msg') || (() => { const m = document.createElement('p'); m.className = 'tnl-form-msg'; form.appendChild(m); return m; })();
      const btn = form.querySelector('[type="submit"]');
      const lang = document.documentElement.lang === 'vi';

      // validate required
      let ok = true;
      form.querySelectorAll('input, textarea, select').forEach((el) => {
        if (el.hasAttribute('required') && !el.value.trim()) ok = false;
        if (el.type === 'email' && el.value && !/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(el.value)) ok = false;
      });
      if (!ok) {
        msg.textContent = lang ? 'Vui lòng điền đầy đủ thông tin hợp lệ.' : 'Please fill in all fields correctly.';
        msg.className = 'tnl-form-msg is-error';
        return;
      }

      const fd = new FormData();
      fd.append('action', 'tnl_form');
      fd.append('nonce', (window.tnlData && tnlData.nonce) || '');
      fd.append('form_type', form.dataset.formType || 'Form');
      form.querySelectorAll('input, textarea, select').forEach((el) => {
        if (el.name) fd.append('fields[' + (el.previousElementSibling && el.previousElementSibling.textContent ? el.previousElementSibling.textContent.trim() : el.name) + ']', el.value);
      });

      if (btn) { btn.disabled = true; btn.dataset.label = btn.textContent; btn.textContent = lang ? 'Đang gửi...' : 'Sending...'; }
      fetch((window.tnlData && tnlData.ajaxUrl) || '/wp-admin/admin-ajax.php', { method: 'POST', body: fd, credentials: 'same-origin' })
        .then((r) => r.json()).catch(() => ({ success: true }))
        .then(() => {
          msg.textContent = lang ? 'Cảm ơn bạn! Chúng tôi sẽ liên hệ sớm nhất.' : 'Thank you! We will get back to you soon.';
          msg.className = 'tnl-form-msg is-success';
          form.reset();
        })
        .finally(() => { if (btn) { btn.disabled = false; btn.textContent = btn.dataset.label; } });
    });
  });

  // ============================================================
  // PARTNERS CAROUSEL — 8 logo / trang, tự chạy + dots (giống live)
  // ============================================================
  document.querySelectorAll('[data-partners-carousel]').forEach((carousel) => {
    const track = carousel.querySelector('.partners__track');
    const slides = carousel.querySelectorAll('.partners__slide');
    const dots = carousel.querySelectorAll('.partners__dot');
    if (!track || slides.length <= 1) return;

    let index = 0;
    let timer = null;
    const AUTOPLAY = 4500;

    const go = (i) => {
      index = (i + slides.length) % slides.length;
      track.style.transform = `translateX(-${index * 100}%)`;
      dots.forEach((d, di) => d.classList.toggle('is-active', di === index));
    };
    const next = () => go(index + 1);
    const start = () => { stop(); timer = setInterval(next, AUTOPLAY); };
    const stop = () => { if (timer) { clearInterval(timer); timer = null; } };

    dots.forEach((dot) => {
      dot.addEventListener('click', () => { go(parseInt(dot.dataset.slide, 10)); start(); });
    });
    carousel.addEventListener('mouseenter', stop);
    carousel.addEventListener('mouseleave', start);

    // Swipe trên mobile
    let startX = 0;
    carousel.addEventListener('touchstart', (e) => { startX = e.touches[0].clientX; stop(); }, { passive: true });
    carousel.addEventListener('touchend', (e) => {
      const dx = e.changedTouches[0].clientX - startX;
      if (Math.abs(dx) > 40) go(index + (dx < 0 ? 1 : -1));
      start();
    }, { passive: true });

    go(0);
    start();
  });

  // ============================================================
  // VALUES SLIDER — 1 value/slide, 2 visible at once (flex 50%), khớp live site
  // ============================================================
  (function () {
    const track = document.getElementById('valuesTrack');
    const prevBtn = document.getElementById('valuesPrev');
    const nextBtn = document.getElementById('valuesNext');
    if (!track || !prevBtn || !nextBtn) return;

    const slides = track.querySelectorAll('.values__slide');
    if (!slides.length) return;

    let idx = 0;
    const total = slides.length;

    const go = (i) => {
      idx = (i + total) % total;
      // Dùng px để move đúng 1 slide width (50% viewport)
      const slideW = slides[0].offsetWidth;
      track.style.transform = 'translateX(-' + (idx * slideW) + 'px)';
    };

    prevBtn.addEventListener('click', () => go(idx - 1));
    nextBtn.addEventListener('click', () => go(idx + 1));

    // Swipe trên mobile
    let startX = 0;
    const slider = track.closest('.values__slider');
    if (slider) {
      slider.addEventListener('touchstart', (e) => { startX = e.touches[0].clientX; }, { passive: true });
      slider.addEventListener('touchend', (e) => {
        const dx = e.changedTouches[0].clientX - startX;
        if (Math.abs(dx) > 40) go(idx + (dx < 0 ? 1 : -1));
      }, { passive: true });
    }

    go(0);
  })();

  // ============================================================
  // CHỐNG "MỒ CÔI" CHỮ — không để 1 từ vô nghĩa đứng riêng 1 dòng trên nút.
  // Giữ 2 từ cuối dính nhau bằng non-breaking space ( ).
  // ============================================================
  document.querySelectorAll('.btn, .hero-cta__btn, .video-section__btn, .pg-hero__cta-btn').forEach(function (el) {
    if (el.children.length) return; // bỏ qua nút có icon/element con
    var t = el.textContent.replace(/\s+/g, ' ').trim();
    var i = t.lastIndexOf(' ');
    if (i > 0) el.textContent = t.slice(0, i) + ' ' + t.slice(i + 1);
  });

  // ============================================================
  // VIDEO SECTION — play/pause toggle
  // ============================================================
  (function () {
    var section = document.querySelector('.video-section');
    if (!section) return;
    var video = section.querySelector('.video-section__video');
    var playBtn = section.querySelector('.video-section__play');
    if (!video || !playBtn) return;
    var playing = false;
    video.pause();
    var iconPlay = '<svg width="44" height="50" viewBox="0 0 44 50" fill="white" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M42.5774 22.9379C43.9107 23.7077 43.9107 25.6322 42.5774 26.402L3.60955 48.9003C2.27622 49.6702 0.609556 48.7079 0.609556 47.1683L0.609558 2.17173C0.609558 0.632107 2.27623 -0.330193 3.60956 0.439707L42.5774 22.9379Z"/></svg>';
    var iconPause = '<svg width="36" height="42" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><rect x="5" y="3" width="4" height="18" rx="1"/><rect x="15" y="3" width="4" height="18" rx="1"/></svg>';
    playBtn.addEventListener('click', function () {
      if (!playing) { video.play(); playing = true; playBtn.innerHTML = iconPause; }
      else { video.pause(); playing = false; playBtn.innerHTML = iconPlay; }
    });
  })();


})();
