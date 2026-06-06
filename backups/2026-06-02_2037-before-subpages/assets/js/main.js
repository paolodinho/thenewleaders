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
    const STEP = 376; // 360px card + 16px gap
    let offset = 0;

    const getMax = () => {
      const items = track.querySelectorAll('.growing__item');
      return Math.max(0, items.length * STEP - track.parentElement.offsetWidth);
    };

    const slide = (dir) => {
      offset = Math.max(0, Math.min(offset + dir * STEP, getMax()));
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

})();
