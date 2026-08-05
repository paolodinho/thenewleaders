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
    return el.closest('#wpadminbar') || el.closest('.tnl-editbar') || el.closest('.tnl-toast') || el.classList.contains('tnl-img-btn');
  }

  /* ---------- ẢNH: một nút nổi dùng chung (tránh chồng ở ảnh nhỏ sát nhau) ---------- */
  var imgCtl, imgSpec, curImg, hideTimer;
  function ensureCtl() {
    if (imgCtl) return;
    imgSpec = document.createElement('span'); imgSpec.className = 'tnl-img-spec';
    imgCtl = document.createElement('button'); imgCtl.type = 'button'; imgCtl.className = 'tnl-img-btn'; imgCtl.textContent = '⇪ Thay ảnh';
    body.appendChild(imgSpec); body.appendChild(imgCtl);
    [imgCtl, imgSpec].forEach(function (e) {
      e.addEventListener('mouseenter', function () { clearTimeout(hideTimer); });
      e.addEventListener('mouseleave', scheduleHide);
    });
    imgCtl.addEventListener('click', function (e) { e.preventDefault(); e.stopPropagation(); if (curImg) openMedia(curImg); });
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
  }
  function scheduleHide() {
    hideTimer = setTimeout(function () {
      if (imgCtl) { imgCtl.classList.remove('show'); imgSpec.classList.remove('show'); }
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
    bar(); setupImages(); setupText();
  }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
  else init();
})();
