/* INLINE EDITOR - The New Leaders: thay ảnh + sửa chữ ngay trên trang */
(function () {
  'use strict';
  if (typeof tnlEdit === 'undefined' || !tnlEdit.active) return;

  // KHONG gom 'button' - da nghi la nguyen nhan "gay roi" lan truoc (2026-07-12): rat nhieu
  // <button> tren site la nut chuc nang that (mobile menu toggle, mega-menu dropdown, combobox
  // doi ngon ngu...), gan contenteditable + preventDefault vao do se lam hong tuong tac that.
  // Nut CTA can sua chu nam trong the <a> (h1..blockquote/figcaption) da duoc cover roi.
  var TEXT_SEL = 'h1,h2,h3,h4,h5,h6,p,li,blockquote,figcaption';
  var body = document.body;

  function toast(msg, err) {
    var t = document.querySelector('.tnl-toast');
    if (!t) { t = document.createElement('div'); t.className = 'tnl-toast'; body.appendChild(t); }
    t.textContent = msg; t.className = 'tnl-toast show' + (err ? ' err' : '');
    clearTimeout(t._h); t._h = setTimeout(function () { t.className = 'tnl-toast'; }, 2200);
  }

  function save(type, find, replace, ok) {
    var d = new FormData();
    d.append('action', 'tnl_save_override');
    d.append('nonce', tnlEdit.nonce);
    d.append('pagekey', tnlEdit.pagekey);
    d.append('type', type);
    d.append('find', find);
    d.append('replace', replace);
    fetch(tnlEdit.ajax, { method: 'POST', body: d, credentials: 'same-origin' })
      .then(function (r) { return r.json(); })
      .then(function (res) {
        if (res && res.success) { toast('Đã lưu ✓'); ok && ok(); }
        else { toast((res && res.data && res.data.msg) || 'Lỗi lưu', true); }
      })
      .catch(function () { toast('Lỗi kết nối', true); });
  }

  function inChrome(el) {
    return el.closest('#wpadminbar') || el.closest('.tnl-editbar') || el.closest('.tnl-toast')
      || el.closest('.tnl-addblock-btn') || el.closest('.tnl-blockpicker')
      || el.classList.contains('tnl-img-btn') || el.classList.contains('tnl-vid-btn');
  }

  /* ---------- BỐ CỤC: đảo trái/phải trong khối flex-row 2 phần tử (ảnh-chữ) ----------
   * Dùng CSS `order` (inline style) thay vì đảo DOM - an toàn với mọi cách viết class
   * (Tailwind order-*, flex-row-reverse...) vì override đè lên bằng specificity cao nhất,
   * không cần đoán/sửa class gốc. */
  function findFlipContainer(el) {
    var p = el.parentElement;
    var hops = 0;
    while (p && p !== body && hops < 6) {
      var cs = getComputedStyle(p);
      if ((cs.display === 'flex' || cs.display === 'inline-flex') && cs.flexDirection.indexOf('row') === 0) {
        var kids = Array.prototype.filter.call(p.children, function (c) { return c.nodeType === 1; });
        if (kids.length === 2) return p;
      }
      p = p.parentElement; hops++;
    }
    return null;
  }
  function flipContainer(container) {
    var kids = Array.prototype.filter.call(container.children, function (c) { return c.nodeType === 1; });
    if (kids.length !== 2) return;
    var before = container.outerHTML;
    var cur0 = parseInt(getComputedStyle(kids[0]).order, 10) || 0;
    var cur1 = parseInt(getComputedStyle(kids[1]).order, 10) || 0;
    if (cur0 <= cur1) { kids[0].style.order = '2'; kids[1].style.order = '1'; }
    else { kids[0].style.order = '1'; kids[1].style.order = '2'; }
    var after = container.outerHTML;
    save('layout', before, after, function () {});
  }

  /* ---------- ẢNH: một nút nổi dùng chung (tránh chồng ở ảnh nhỏ sát nhau) ---------- */
  var imgCtl, imgSpec, flipCtl, curImg, hideTimer;
  function ensureCtl() {
    if (imgCtl) return;
    imgSpec = document.createElement('span'); imgSpec.className = 'tnl-img-spec';
    imgCtl = document.createElement('button'); imgCtl.type = 'button'; imgCtl.className = 'tnl-img-btn'; imgCtl.textContent = '⇪ Thay ảnh';
    flipCtl = document.createElement('button'); flipCtl.type = 'button'; flipCtl.className = 'tnl-img-btn tnl-flip-btn'; flipCtl.textContent = '⇄ Đảo bên';
    body.appendChild(imgSpec); body.appendChild(imgCtl); body.appendChild(flipCtl);
    [imgCtl, imgSpec, flipCtl].forEach(function (e) {
      e.addEventListener('mouseenter', function () { clearTimeout(hideTimer); });
      e.addEventListener('mouseleave', scheduleHide);
    });
    imgCtl.addEventListener('click', function (e) { e.preventDefault(); e.stopPropagation(); if (curImg) openMedia(curImg); });
    flipCtl.addEventListener('click', function (e) {
      e.preventDefault(); e.stopPropagation();
      if (!curImg) return;
      var c = findFlipContainer(curImg);
      if (c) flipContainer(c);
    });
  }
  function showCtl(img) {
    ensureCtl(); clearTimeout(hideTimer); curImg = img;
    var r = img.getBoundingClientRect();
    var w = img.naturalWidth || img.width, h = img.naturalHeight || img.height;
    imgSpec.innerHTML = 'Khuyến nghị: <b>' + w + '×' + h + 'px</b> · JPG/PNG/WebP · &lt; 500KB';
    var top = Math.min(Math.max(r.top + 8, 8), window.innerHeight - 46);
    var left = Math.min(Math.max(r.left + 8, 8), window.innerWidth - 140);
    imgCtl.style.top = top + 'px'; imgCtl.style.left = left + 'px';
    imgSpec.style.top = (top + 40) + 'px'; imgSpec.style.left = left + 'px';
    imgCtl.classList.add('show'); imgSpec.classList.add('show');
    var flipC = findFlipContainer(img);
    if (flipC) {
      flipCtl.style.top = top + 'px'; flipCtl.style.left = (left + 118) + 'px';
      flipCtl.classList.add('show');
    } else {
      flipCtl.classList.remove('show');
    }
  }
  function scheduleHide() {
    hideTimer = setTimeout(function () {
      if (imgCtl) { imgCtl.classList.remove('show'); imgSpec.classList.remove('show'); flipCtl.classList.remove('show'); }
    }, 160);
  }
  function setupImages() {
    document.querySelectorAll('img').forEach(function (img) {
      if (inChrome(img) || img.dataset.tnlImg) return;
      if ((img.naturalWidth || img.width) < 24) return; // bỏ icon quá nhỏ
      img.dataset.tnlImg = '1';
      img.classList.add('tnl-editable-img');
      img._tnlOrig = img.outerHTML;
      img.addEventListener('mouseenter', function () { showCtl(img); });
      img.addEventListener('mouseleave', scheduleHide);
    });
  }

  var frame;
  function openMedia(img) {
    if (!window.wp || !wp.media) { toast('Chưa tải được thư viện ảnh', true); return; }
    frame = wp.media({ title: 'Chọn / tải ảnh thay thế', button: { text: 'Dùng ảnh này' }, multiple: false });
    frame.on('select', function () {
      var a = frame.state().get('selection').first().toJSON();
      var url = a.url;
      var before = img._tnlOrig || img.outerHTML;
      // tạo img mới: giữ class (trừ marker), alt; bỏ srcset/sizes để dùng ảnh mới
      var clone = img.cloneNode(false);
      clone.removeAttribute('srcset'); clone.removeAttribute('sizes');
      clone.classList.remove('tnl-editable-img');
      clone.setAttribute('src', url);
      if (a.alt) clone.setAttribute('alt', a.alt);
      var after = clone.outerHTML;
      save('img', before, after, function () {
        img.setAttribute('src', url); img.removeAttribute('srcset'); img.removeAttribute('sizes');
        img._tnlOrig = img.outerHTML; // chain cho lần sửa sau
      });
    });
    frame.open();
  }

  /* ---------- VIDEO: nút nổi riêng để thay video nền (dùng chung style .tnl-img-btn) ---------- */
  var vidCtl, curVid, vidHideTimer;
  function ensureVidCtl() {
    if (vidCtl) return;
    vidCtl = document.createElement('button'); vidCtl.type = 'button'; vidCtl.className = 'tnl-img-btn tnl-vid-btn'; vidCtl.textContent = '🎬 Thay video';
    body.appendChild(vidCtl);
    vidCtl.addEventListener('mouseenter', function () { clearTimeout(vidHideTimer); });
    vidCtl.addEventListener('mouseleave', scheduleVidHide);
    vidCtl.addEventListener('click', function (e) { e.preventDefault(); e.stopPropagation(); if (curVid) openVideoMedia(curVid); });
  }
  function showVidCtl(vid) {
    ensureVidCtl(); clearTimeout(vidHideTimer); curVid = vid;
    var r = vid.getBoundingClientRect();
    var top = Math.min(Math.max(r.top + 8, 8), window.innerHeight - 46);
    var left = Math.min(Math.max(r.left + 8, 8), window.innerWidth - 150);
    vidCtl.style.top = top + 'px'; vidCtl.style.left = left + 'px';
    vidCtl.classList.add('show');
  }
  function scheduleVidHide() {
    vidHideTimer = setTimeout(function () { if (vidCtl) vidCtl.classList.remove('show'); }, 160);
  }
  function setupVideos() {
    document.querySelectorAll('video').forEach(function (vid) {
      if (inChrome(vid) || vid.dataset.tnlVid) return;
      vid.dataset.tnlVid = '1';
      vid.classList.add('tnl-editable-vid');
      vid._tnlOrig = vid.outerHTML;
      vid.addEventListener('mouseenter', function () { showVidCtl(vid); });
      vid.addEventListener('mouseleave', scheduleVidHide);
    });
  }

  var vidFrame;
  function openVideoMedia(vid) {
    if (!window.wp || !wp.media) { toast('Chưa tải được thư viện media', true); return; }
    vidFrame = wp.media({ title: 'Chọn / tải video thay thế', button: { text: 'Dùng video này' }, multiple: false, library: { type: 'video' } });
    vidFrame.on('select', function () {
      var a = vidFrame.state().get('selection').first().toJSON();
      var url = a.url;
      var before = vid._tnlOrig || vid.outerHTML;
      var clone = vid.cloneNode(false);
      clone.classList.remove('tnl-editable-vid');
      var src = document.createElement('source');
      src.setAttribute('src', url);
      src.setAttribute('type', a.mime || 'video/mp4');
      clone.appendChild(src);
      var after = clone.outerHTML;
      save('video', before, after, function () {
        vid.querySelectorAll('source').forEach(function (s) { s.remove(); });
        var s2 = document.createElement('source'); s2.setAttribute('src', url); s2.setAttribute('type', a.mime || 'video/mp4');
        vid.appendChild(s2);
        vid.load();
        vid._tnlOrig = vid.outerHTML;
      });
    });
    vidFrame.open();
  }

  /* ---------- THÊM KHỐI: nút nổi ở cạnh dưới mỗi khối lớn (data-sentry-component gốc React
   * đánh dấu ranh giới khối/section thật - dùng lại làm điểm neo chèn, an toàn hơn tự đoán). ---------- */
  var SECTION_SEL = '[data-sentry-component="Padding"], [data-sentry-component="Section"]';
  var addCtl, curSection, addHideTimer;
  function ensureAddCtl() {
    if (addCtl) return;
    addCtl = document.createElement('button');
    addCtl.type = 'button'; addCtl.className = 'tnl-addblock-btn'; addCtl.textContent = '+ Thêm khối';
    body.appendChild(addCtl);
    addCtl.addEventListener('mouseenter', function () { clearTimeout(addHideTimer); });
    addCtl.addEventListener('mouseleave', scheduleAddHide);
    addCtl.addEventListener('click', function (e) {
      e.preventDefault(); e.stopPropagation();
      if (curSection) openBlockPicker(curSection);
    });
  }
  function showAddCtl(sec) {
    ensureAddCtl(); clearTimeout(addHideTimer); curSection = sec;
    var r = sec.getBoundingClientRect();
    var top = Math.min(Math.max(r.bottom - 18, 8), window.innerHeight - 40);
    var left = Math.max(8, r.left + r.width / 2 - 60);
    addCtl.style.top = top + 'px'; addCtl.style.left = left + 'px';
    addCtl.classList.add('show');
  }
  function scheduleAddHide() {
    addHideTimer = setTimeout(function () { if (addCtl) addCtl.classList.remove('show'); }, 300);
  }
  function setupSectionInsert() {
    document.querySelectorAll(SECTION_SEL).forEach(function (sec) {
      if (inChrome(sec) || sec.dataset.tnlSecIns) return;
      sec.dataset.tnlSecIns = '1';
      sec.addEventListener('mouseenter', function () { showAddCtl(sec); });
      sec.addEventListener('mouseleave', scheduleAddHide);
    });
  }

  /* ---------- PICKER chọn loại khối + gọi AJAX dựng HTML + chèn vào trang ---------- */
  var picker;
  function ensurePicker() {
    if (picker) return;
    picker = document.createElement('div'); picker.className = 'tnl-blockpicker'; picker.hidden = true;
    var box = document.createElement('div'); box.className = 'tnl-blockpicker__box';
    box.innerHTML = '<div class="tnl-blockpicker__head"><b>Chọn khối để thêm</b><button type="button" class="tnl-blockpicker__close">✕</button></div><div class="tnl-blockpicker__grid"></div>';
    picker.appendChild(box);
    body.appendChild(picker);
    picker.addEventListener('click', function (e) { if (e.target === picker) picker.hidden = true; });
    box.querySelector('.tnl-blockpicker__close').addEventListener('click', function () { picker.hidden = true; });
    var grid = box.querySelector('.tnl-blockpicker__grid');
    var groups = {};
    Object.keys(tnlEdit.blockTypes || {}).forEach(function (type) {
      var g = tnlEdit.blockTypes[type].group || 'Khác';
      (groups[g] = groups[g] || []).push(type);
    });
    Object.keys(groups).forEach(function (g) {
      var h = document.createElement('h4'); h.textContent = g; h.className = 'tnl-blockpicker__gname'; grid.appendChild(h);
      var row = document.createElement('div'); row.className = 'tnl-blockpicker__row';
      groups[g].forEach(function (type) {
        var b = document.createElement('button'); b.type = 'button'; b.className = 'tnl-blockpicker__item';
        b.textContent = tnlEdit.blockTypes[type].label;
        b.addEventListener('click', function () { picker.hidden = true; insertBlock(type); });
        row.appendChild(b);
      });
      grid.appendChild(row);
    });
  }
  function openBlockPicker(sec) {
    ensurePicker();
    curSection = sec;
    picker.hidden = false;
  }
  function insertBlock(type) {
    if (!curSection) return;
    var sec = curSection;
    var d = new FormData();
    d.append('action', 'tnl_render_block');
    d.append('nonce', tnlEdit.nonce);
    d.append('type', type);
    fetch(tnlEdit.ajax, { method: 'POST', body: d, credentials: 'same-origin' })
      .then(function (r) { return r.json(); })
      .then(function (res) {
        if (!res || !res.success) { toast((res && res.data && res.data.msg) || 'Lỗi dựng khối', true); return; }
        var before = sec.outerHTML;
        var wrap = document.createElement('div');
        wrap.innerHTML = res.data.html;
        var newEl = wrap.firstElementChild;
        if (!newEl) { toast('Khối rỗng', true); return; }
        sec.insertAdjacentElement('afterend', newEl);
        var after = before + newEl.outerHTML;
        save('insert', before, after, function () {
          // gan lai listener sua chu/anh/video cho noi dung vua chen
          setupImages(); setupVideos(); setupSectionInsert(); setupText();
          newEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
      })
      .catch(function () { toast('Lỗi kết nối', true); });
  }

  /* ---------- CHỮ ---------- */
  function setupText() {
    var nodes = document.querySelectorAll(TEXT_SEL);
    nodes.forEach(function (el) {
      if (inChrome(el) || el.dataset.tnlTxt) return;
      if (el.parentElement && el.parentElement.closest(TEXT_SEL)) return; // tránh lồng nhau
      var txt = (el.textContent || '').trim();
      if (!txt) return;
      el.dataset.tnlTxt = '1';
      el.classList.add('tnl-editable-text');

      el.addEventListener('click', function (e) {
        if (el.getAttribute('contenteditable') === 'true') return;
        e.preventDefault(); e.stopPropagation();
        el._tnlOrig = el.outerHTML;
        el._tnlOrigInner = el.innerHTML;
        el.setAttribute('contenteditable', 'true');
        el.focus();
      }, true);

      el.addEventListener('blur', function () {
        if (el.getAttribute('contenteditable') !== 'true') return;
        el.setAttribute('contenteditable', 'false');
        el.removeAttribute('contenteditable');
        if (el.innerHTML === el._tnlOrigInner) return; // không đổi
        var after = el.outerHTML.replace(' contenteditable="true"', '');
        save('text', el._tnlOrig, after, function () { el._tnlOrig = el.outerHTML; });
      });

      // Enter = xuống dòng thường; Ctrl/Cmd+Enter = xong
      el.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && (e.metaKey || e.ctrlKey)) { e.preventDefault(); el.blur(); }
        if (e.key === 'Escape') { el.innerHTML = el._tnlOrigInner; el.blur(); }
      });
    });
  }

  /* ---------- THANH CÔNG CỤ ---------- */
  function bar() {
    var b = document.createElement('div');
    b.className = 'tnl-editbar';
    b.innerHTML = '<span class="tnl-editbar__dot"></span><b>Chế độ sửa</b>' +
      '<span class="tnl-editbar__hint">Bấm vào chữ để sửa · di vào ảnh để thay</span>' +
      '<button class="tnl-eb-reset">Hoàn tác trang này</button>' +
      '<button class="tnl-eb-done">Xong</button>';
    body.appendChild(b);
    b.querySelector('.tnl-eb-done').addEventListener('click', function () {
      var u = new URL(location.href); u.searchParams.delete('tnl_edit'); location.href = u.toString();
    });
    b.querySelector('.tnl-eb-reset').addEventListener('click', function () {
      if (!confirm('Hoàn tác MỌI chỉnh sửa trên trang này, trả về bản gốc?')) return;
      var d = new FormData();
      d.append('action', 'tnl_reset_overrides'); d.append('nonce', tnlEdit.nonce); d.append('pagekey', tnlEdit.pagekey);
      fetch(tnlEdit.ajax, { method: 'POST', body: d, credentials: 'same-origin' })
        .then(function (r) { return r.json(); })
        .then(function () { location.reload(); });
    });
  }

  function init() {
    body.classList.add('tnl-editing');
    bar(); setupImages(); setupVideos(); setupText(); setupSectionInsert();
  }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
  else init();
})();
