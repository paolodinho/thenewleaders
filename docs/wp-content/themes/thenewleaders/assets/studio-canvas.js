/* LANDING STUDIO - CANVAS (sua truc tiep kieu Elementor).
 * Chay BEN TRONG iframe xem truoc cua Landing Studio (chi nap khi ?tnl_preview=1
 * va nguoi dung co quyen edit_pages - xem inc/landing-studio.php). KHONG BAO GIO
 * chay tren trang that cho khach xem.
 *
 * Giao tiep voi trang quan tri (cha) qua postMessage, khong dung state rieng -
 * moi thay doi deu bao ve cha (nguon su that = state.sections trong studio.js).
 */
(function () {
  var PARENT_ORIGIN = window.location.origin;
  var COLORS = [
    { key: 'cyan', label: 'Xanh dương', hex: '#5AD3ED' },
    { key: 'green', label: 'Xanh lá', hex: '#AFE56B' },
    { key: 'yellow', label: 'Vàng', hex: '#FFC75A' },
    { key: 'orange', label: 'Cam', hex: '#FF9B52' }
  ];

  function post(msg) {
    if (window.parent && window.parent !== window) window.parent.postMessage(Object.assign({ ns: 'tnls' }, msg), PARENT_ORIGIN);
  }

  function secOf(el) { return el.closest ? el.closest('.tnls-canvas-sec') : null; }
  function idxOf(sec) { return sec ? parseInt(sec.getAttribute('data-tnls-idx'), 10) : -1; }

  /* ---------- 1. Contenteditable cho moi [data-tnls-key] ---------- */
  var fieldTimers = {};
  function syncField(el, sec) {
    var idx = idxOf(sec), key = el.getAttribute('data-tnls-key');
    if (idx < 0 || !key) return;
    var value = el.hasAttribute('data-tnls-multiline')
      ? Array.prototype.map.call(el.children, function (c) { return c.textContent; }).join('\n')
      : el.textContent;
    post({ type: 'field', idx: idx, key: key, value: value });
  }
  function wireEditable(el) {
    var sec = secOf(el);
    if (!sec) return;
    el.setAttribute('contenteditable', 'true');
    el.classList.add('tnls-editable');
    el.addEventListener('input', function () {
      var tid = key(el);
      clearTimeout(fieldTimers[tid]);
      fieldTimers[tid] = setTimeout(function () { syncField(el, sec); }, 500);
    });
    el.addEventListener('blur', function () {
      var tid = key(el);
      clearTimeout(fieldTimers[tid]);
      syncField(el, sec);
    });
    el.addEventListener('keydown', function (e) {
      // Enter trong field 1 dong (khong multiline) -> khong xuong dong, coi nhu xong
      if (e.key === 'Enter' && !el.hasAttribute('data-tnls-multiline')) { e.preventDefault(); el.blur(); }
    });
    function key(node) { return idxOf(secOf(node)) + '::' + node.getAttribute('data-tnls-key'); }
  }
  document.querySelectorAll('[data-tnls-key]').forEach(wireEditable);

  /* ---------- 2. Anh: bam vao anh -> xin cha mo Media Library ---------- */
  function pickImage(sec, keyName) {
    var idx = idxOf(sec);
    if (idx < 0) return;
    post({ type: 'pick-image', idx: idx, key: keyName || sec.getAttribute('data-tnls-img-key') || 'img' });
  }
  document.querySelectorAll('[data-tnls-img]').forEach(function (el) {
    el.style.cursor = 'pointer';
    el.addEventListener('click', function (e) {
      e.preventDefault(); e.stopPropagation();
      pickImage(secOf(el), el.getAttribute('data-tnls-img-key'));
    });
  });
  window.addEventListener('message', function (e) {
    if (e.origin !== PARENT_ORIGIN) return;
    var d = e.data;
    if (!d || d.ns !== 'tnls' || d.type !== 'image-selected') return;
    var sec = document.querySelector('.tnls-canvas-sec[data-tnls-idx="' + d.idx + '"]');
    if (!sec) return;
    var target = sec.querySelector('[data-tnls-img]') || sec.querySelector('img');
    if (!target) return;
    if (target.tagName === 'IMG') target.src = d.value;
    else target.style.backgroundImage = 'url(' + d.value + ')';
  });

  /* ---------- 3. Toolbar noi tren tung khoi (mot toolbar dung chung, di chuyen theo hover) ---------- */
  var bar = document.createElement('div');
  bar.className = 'tnls-cv-bar';
  bar.innerHTML =
    '<span class="tnls-cv-grip" draggable="true" title="Kéo để đổi thứ tự">☰</span>' +
    '<button type="button" data-op="up" title="Lên">▲</button>' +
    '<button type="button" data-op="down" title="Xuống">▼</button>' +
    '<button type="button" data-op="dup" title="Nhân bản">⧉</button>' +
    '<button type="button" class="tnls-cv-img" data-act="img" title="Đổi ảnh" hidden>🖼</button>' +
    '<button type="button" class="tnls-cv-color" data-act="color" title="Đổi màu" hidden>🎨</button>' +
    '<button type="button" data-op="del" class="tnls-cv-del" title="Xoá">✕</button>';
  document.addEventListener('DOMContentLoaded', function () { document.body.appendChild(bar); });
  if (document.body) document.body.appendChild(bar);

  var swatch = document.createElement('div');
  swatch.className = 'tnls-cv-swatch';
  swatch.hidden = true;
  swatch.innerHTML = COLORS.map(function (c) {
    return '<button type="button" data-color="' + c.key + '" title="' + c.label + '" style="background:' + c.hex + '"></button>';
  }).join('');
  document.addEventListener('DOMContentLoaded', function () { document.body.appendChild(swatch); });
  if (document.body) document.body.appendChild(swatch);

  var currentSec = null;
  function positionBar(sec) {
    var r = sec.getBoundingClientRect();
    bar.style.top = (window.scrollY + r.top - bar.offsetHeight - 2) + 'px';
    bar.style.left = Math.max(4, window.scrollX + r.left) + 'px';
  }
  function showBarFor(sec) {
    currentSec = sec;
    sec.classList.add('tnls-cv-hover');
    var imgBtn = bar.querySelector('.tnls-cv-img');
    var colorBtn = bar.querySelector('.tnls-cv-color');
    imgBtn.hidden = !sec.hasAttribute('data-tnls-img-key');
    colorBtn.hidden = !sec.hasAttribute('data-tnls-color-key');
    bar.hidden = false;
    positionBar(sec);
  }
  function hideBar() {
    if (currentSec) currentSec.classList.remove('tnls-cv-hover');
    currentSec = null;
    bar.hidden = true;
    swatch.hidden = true;
  }

  var hideTimer = null;
  function scheduleHide() { clearTimeout(hideTimer); hideTimer = setTimeout(function () {
    if (!bar.matches(':hover') && !swatch.matches(':hover')) hideBar();
  }, 250); }

  document.addEventListener('mouseover', function (e) {
    var sec = secOf(e.target);
    if (!sec) return;
    clearTimeout(hideTimer);
    if (sec !== currentSec) showBarFor(sec);
  });
  document.addEventListener('mouseout', function (e) {
    var to = e.relatedTarget;
    if (to && (secOf(to) || bar.contains(to) || swatch.contains(to))) return;
    scheduleHide();
  });
  bar.addEventListener('mouseover', function () { clearTimeout(hideTimer); });
  bar.addEventListener('mouseout', scheduleHide);
  window.addEventListener('scroll', function () { if (currentSec) positionBar(currentSec); }, true);
  window.addEventListener('resize', function () { if (currentSec) positionBar(currentSec); });

  bar.addEventListener('click', function (e) {
    if (!currentSec) return;
    var idx = idxOf(currentSec);
    var opBtn = e.target.closest('[data-op]');
    if (opBtn) { post({ type: 'op', idx: idx, op: opBtn.getAttribute('data-op') }); return; }
    var act = e.target.closest('[data-act]');
    if (act && act.getAttribute('data-act') === 'img') { pickImage(currentSec); return; }
    if (act && act.getAttribute('data-act') === 'color') {
      var r = act.getBoundingClientRect();
      swatch.style.top = (window.scrollY + r.bottom + 4) + 'px';
      swatch.style.left = (window.scrollX + r.left) + 'px';
      swatch.hidden = false;
    }
  });
  swatch.addEventListener('click', function (e) {
    var b = e.target.closest('[data-color]');
    if (!b || !currentSec) return;
    var idx = idxOf(currentSec), key = currentSec.getAttribute('data-tnls-color-key') || 'color';
    post({ type: 'color', idx: idx, key: key, value: b.getAttribute('data-color') });
    swatch.hidden = true;
  });

  /* ---------- 4. Keo-tha ngay tren canvas ---------- */
  var dragIdx = null;
  bar.querySelector('.tnls-cv-grip').addEventListener('dragstart', function (e) {
    dragIdx = currentSec ? idxOf(currentSec) : null;
    e.dataTransfer.effectAllowed = 'move';
    try { e.dataTransfer.setData('text/plain', String(dragIdx)); } catch (err) {}
  });
  document.addEventListener('dragover', function (e) {
    if (dragIdx === null) return;
    var sec = secOf(e.target);
    if (!sec) return;
    e.preventDefault();
    document.querySelectorAll('.tnls-cv-dragover').forEach(function (el) { el.classList.remove('tnls-cv-dragover'); });
    sec.classList.add('tnls-cv-dragover');
  });
  document.addEventListener('drop', function (e) {
    if (dragIdx === null) return;
    var sec = secOf(e.target);
    document.querySelectorAll('.tnls-cv-dragover').forEach(function (el) { el.classList.remove('tnls-cv-dragover'); });
    if (!sec) { dragIdx = null; return; }
    e.preventDefault();
    var to = idxOf(sec);
    if (to !== dragIdx) post({ type: 'reorder', from: dragIdx, to: to });
    dragIdx = null;
  });
})();
