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
      || el.closest('.tnl-addblock-btn') || el.closest('.tnl-sectool') || el.closest('.tnl-blockpicker')
      || el.closest('.tnl-txttool')
      || el.classList.contains('tnl-img-btn') || el.classList.contains('tnl-vid-btn') || el.classList.contains('tnl-dup-btn');
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

  /* ---------- NHÂN BẢN: nhận ra ảnh đang nằm trong 1 danh sách lặp (logo, thẻ, ảnh gallery...)
   * để có thể "+ thêm 1 cái nữa cùng kiểu" thay vì chỉ thay được ảnh đã có sẵn. Nhận diện bằng
   * cấu trúc (đi lên tìm cấp có >=2 phần tử anh em cùng tên thẻ), không đoán theo tên class cụ
   * thể - áp dụng được cho mọi khối lặp có sẵn trên trang, không chỉ khối do Landing Studio dựng. */
  function findRepeatItem(img) {
    var el = img, hops = 0;
    while (el && el.parentElement && el.parentElement !== body && hops < 6) {
      var parent = el.parentElement;
      var sibs = Array.prototype.filter.call(parent.children, function (c) { return c.nodeType === 1; });
      if (sibs.length >= 2) {
        var sameTag = sibs.filter(function (s) { return s.tagName === el.tagName; });
        if (sameTag.length >= 2) return el;
      }
      el = parent; hops++;
    }
    return null;
  }
  /* ---------- KÉO-THẢ đổi vị trí (chỉ trong cùng 1 danh sách lặp - an toàn, không cho kéo
   * sang chỗ khác cấu trúc khác vì dễ vỡ layout trên HTML tĩnh nhiều lớp). ---------- */
  var dragEl = null;
  function markDraggable(item) {
    if (item.dataset.tnlDrag) return;
    item.dataset.tnlDrag = '1';
    item.classList.add('tnl-drag-item');
    item.setAttribute('draggable', 'true');
    item.addEventListener('dragstart', function (e) {
      dragEl = item;
      item.classList.add('tnl-dragging');
      e.dataTransfer.effectAllowed = 'move';
      try { e.dataTransfer.setData('text/plain', ''); } catch (err) {}
    });
    item.addEventListener('dragend', function () {
      item.classList.remove('tnl-dragging');
      document.querySelectorAll('.tnl-drop-before,.tnl-drop-after').forEach(function (el) {
        el.classList.remove('tnl-drop-before', 'tnl-drop-after');
      });
      dragEl = null;
    });
    item.addEventListener('dragover', function (e) {
      if (!dragEl || dragEl === item || dragEl.parentElement !== item.parentElement || dragEl.tagName !== item.tagName) return;
      e.preventDefault();
      e.dataTransfer.dropEffect = 'move';
      var r = item.getBoundingClientRect();
      var before = (e.clientX - r.left) < r.width / 2;
      item.classList.toggle('tnl-drop-before', before);
      item.classList.toggle('tnl-drop-after', !before);
    });
    item.addEventListener('dragleave', function () {
      item.classList.remove('tnl-drop-before', 'tnl-drop-after');
    });
    item.addEventListener('drop', function (e) {
      e.preventDefault();
      var before = item.classList.contains('tnl-drop-before');
      item.classList.remove('tnl-drop-before', 'tnl-drop-after');
      if (!dragEl || dragEl === item || dragEl.parentElement !== item.parentElement) return;
      doDragReorder(dragEl, item, before);
    });
  }
  /* Ghép lại đúng đoạn HTML gốc (đọc từ innerHTML của cha, giữ nguyên khoảng trắng) rồi
   * dựng chuỗi mới với phần tử kéo (a) chuyển tới trước/sau đích (b) - cùng kỹ thuật
   * find/replace-theo-vị-trí-thật đã dùng cho đổi chỗ khối, áp dụng khoảng cách bất kỳ. */
  function doDragReorder(a, b, before) {
    var parent = a.parentElement;
    var pHTML = parent.innerHTML;
    var aHTML = a.outerHTML, bHTML = b.outerHTML;
    var aIdx = pHTML.indexOf(aHTML);
    var bIdx = pHTML.indexOf(bHTML);
    if (aIdx === -1 || bIdx === -1 || aIdx === bIdx) { toast('Không xác định được vị trí', true); return; }
    var lo = Math.min(aIdx, bIdx);
    var hi = Math.max(aIdx + aHTML.length, bIdx + bHTML.length);
    var span = pHTML.substring(lo, hi);
    var withoutA = span.split(aHTML).join('');
    var bPos = withoutA.indexOf(bHTML);
    if (bPos === -1) { toast('Không dựng lại được vị trí mới', true); return; }
    var insertPos = before ? bPos : bPos + bHTML.length;
    var newSpan = withoutA.slice(0, insertPos) + aHTML + withoutA.slice(insertPos);
    if (newSpan === span) { toast('Không đổi được', true); return; }
    save('reorder', span, newSpan, function () {
      if (before) parent.insertBefore(a, b); else parent.insertBefore(a, b.nextSibling);
      toast('Đã đổi vị trí ✓');
    });
  }

  function duplicateItem(item) {
    var before = item.outerHTML;
    var clone = item.cloneNode(true);
    item.insertAdjacentElement('afterend', clone);
    var after = before + clone.outerHTML;
    save('insert', before, after, function () {
      setupImages(); setupVideos(); setupText();
      var newImg = clone.tagName === 'IMG' ? clone : clone.querySelector('img');
      clone.scrollIntoView({ behavior: 'smooth', block: 'center' });
      if (newImg) openMedia(newImg); // mở luôn thư viện ảnh để chọn ảnh mới cho bản sao
    });
  }

  /* ---------- ẢNH: một nút nổi dùng chung (tránh chồng ở ảnh nhỏ sát nhau) ---------- */
  var imgCtl, imgSpec, flipCtl, dupCtl, curImg, hideTimer;
  function ensureCtl() {
    if (imgCtl) return;
    imgSpec = document.createElement('span'); imgSpec.className = 'tnl-img-spec';
    imgCtl = document.createElement('button'); imgCtl.type = 'button'; imgCtl.className = 'tnl-img-btn'; imgCtl.textContent = '⇪ Thay ảnh';
    flipCtl = document.createElement('button'); flipCtl.type = 'button'; flipCtl.className = 'tnl-img-btn tnl-flip-btn'; flipCtl.textContent = '⇄ Đảo bên';
    dupCtl = document.createElement('button'); dupCtl.type = 'button'; dupCtl.className = 'tnl-img-btn tnl-dup-btn'; dupCtl.textContent = '🧬 Nhân bản mục này';
    body.appendChild(imgSpec); body.appendChild(imgCtl); body.appendChild(flipCtl); body.appendChild(dupCtl);
    [imgCtl, imgSpec, flipCtl, dupCtl].forEach(function (e) {
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
    dupCtl.addEventListener('click', function (e) {
      e.preventDefault(); e.stopPropagation();
      if (!curImg) return;
      var item = findRepeatItem(curImg);
      if (item) duplicateItem(item);
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
    var nextLeft = left + 118;
    var flipC = findFlipContainer(img);
    if (flipC) {
      flipCtl.style.top = top + 'px'; flipCtl.style.left = nextLeft + 'px';
      flipCtl.classList.add('show');
      nextLeft += 108;
    } else {
      flipCtl.classList.remove('show');
    }
    var repeatItem = findRepeatItem(img);
    if (repeatItem) {
      dupCtl.style.top = top + 'px'; dupCtl.style.left = nextLeft + 'px';
      dupCtl.classList.add('show');
    } else {
      dupCtl.classList.remove('show');
    }
  }
  function scheduleHide() {
    hideTimer = setTimeout(function () {
      if (imgCtl) { imgCtl.classList.remove('show'); imgSpec.classList.remove('show'); flipCtl.classList.remove('show'); dupCtl.classList.remove('show'); }
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
      var item = findRepeatItem(img);
      if (item) markDraggable(item);
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
  var addCtl, secTool, upBtn, downBtn, delBtn, curSection, addHideTimer;
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

    // Cụm nút góc trên-phải khối: đổi vị trí lên/xuống + xoá.
    secTool = document.createElement('div'); secTool.className = 'tnl-sectool';
    upBtn = document.createElement('button'); upBtn.type = 'button'; upBtn.className = 'tnl-sectool__btn'; upBtn.title = 'Đưa khối lên trên'; upBtn.textContent = '↑';
    downBtn = document.createElement('button'); downBtn.type = 'button'; downBtn.className = 'tnl-sectool__btn'; downBtn.title = 'Đưa khối xuống dưới'; downBtn.textContent = '↓';
    delBtn = document.createElement('button'); delBtn.type = 'button'; delBtn.className = 'tnl-sectool__btn tnl-sectool__del'; delBtn.title = 'Xoá khối'; delBtn.textContent = '🗑';
    secTool.appendChild(upBtn); secTool.appendChild(downBtn); secTool.appendChild(delBtn);
    body.appendChild(secTool);
    secTool.addEventListener('mouseenter', function () { clearTimeout(addHideTimer); });
    secTool.addEventListener('mouseleave', scheduleAddHide);
    upBtn.addEventListener('click', function (e) { e.preventDefault(); e.stopPropagation(); if (curSection) moveSection(curSection, -1); });
    downBtn.addEventListener('click', function (e) { e.preventDefault(); e.stopPropagation(); if (curSection) moveSection(curSection, 1); });
    delBtn.addEventListener('click', function (e) {
      e.preventDefault(); e.stopPropagation();
      if (!curSection) return;
      if (!confirm('Xoá hẳn khối này khỏi trang?')) return;
      var sec = curSection;
      var before = sec.outerHTML;
      save('delete', before, '', function () {
        sec.remove();
        addCtl.classList.remove('show'); secTool.classList.remove('show');
        curSection = null;
      });
    });
  }
  function showAddCtl(sec) {
    ensureAddCtl(); clearTimeout(addHideTimer); curSection = sec;
    var r = sec.getBoundingClientRect();
    var top = Math.min(Math.max(r.bottom - 18, 8), window.innerHeight - 40);
    var left = Math.max(8, r.left + r.width / 2 - 60);
    addCtl.style.top = top + 'px'; addCtl.style.left = left + 'px';
    addCtl.classList.add('show');
    var ttop = Math.min(Math.max(r.top + 8, 8), window.innerHeight - 40);
    var tleft = Math.min(Math.max(r.right - 132, 8), window.innerWidth - 140);
    secTool.style.top = ttop + 'px'; secTool.style.left = tleft + 'px';
    secTool.classList.add('show');
  }
  function scheduleAddHide() {
    addHideTimer = setTimeout(function () {
      if (addCtl) addCtl.classList.remove('show');
      if (secTool) secTool.classList.remove('show');
    }, 300);
  }
  /* Chỉ lấy khối NGOÀI CÙNG (không lồng trong 1 khối khác cũng khớp SECTION_SEL) -
   * tránh "+ Thêm khối" bám vào 1 mảnh nhỏ (vd Padding con) khiến khối mới bị chèn
   * lọt vào giữa khối đang có thay vì tạo hẳn 1 khối/section mới độc lập. */
  function isTopLevelSection(el) {
    var p = el.parentElement;
    while (p && p !== body) {
      if (p.matches && p.matches(SECTION_SEL)) return false;
      p = p.parentElement;
    }
    return true;
  }
  /* Tìm khối liền kề (cùng cấp) theo hướng dir (-1 = lên/trước, 1 = xuống/sau) để đổi chỗ. */
  function findAdjSection(sec, dir) {
    var el = dir < 0 ? sec.previousElementSibling : sec.nextElementSibling;
    while (el) {
      if (el.matches && el.matches(SECTION_SEL) && isTopLevelSection(el)) return el;
      el = dir < 0 ? el.previousElementSibling : el.nextElementSibling;
    }
    return null;
  }
  /* Đổi chỗ 2 khối liền kề: lấy đúng đoạn HTML gốc (kể cả khoảng trắng ở giữa) từ
   * innerHTML của cha để "find" khớp chính xác với markup thật trên server - không đoán,
   * không tự ráp lại (an toàn hơn khi trang là HTML tĩnh nhiều lớp phức tạp). */
  function moveSection(sec, dir) {
    var other = findAdjSection(sec, dir);
    if (!other) { toast('Không còn khối để đổi chỗ theo hướng này', true); return; }
    var a = dir < 0 ? other : sec;
    var b = dir < 0 ? sec : other;
    var parent = a.parentElement;
    var pHTML = parent.innerHTML;
    var aHTML = a.outerHTML, bHTML = b.outerHTML;
    var aIdx = pHTML.indexOf(aHTML);
    if (aIdx === -1) { toast('Không xác định được vị trí khối', true); return; }
    var afterA = aIdx + aHTML.length;
    var bIdx = pHTML.indexOf(bHTML, afterA);
    if (bIdx === -1) { toast('Không xác định được vị trí khối', true); return; }
    var gap = pHTML.substring(afterA, bIdx);
    var oldSpan = pHTML.substring(aIdx, bIdx + bHTML.length);
    var newSpan = bHTML + gap + aHTML;
    save('reorder', oldSpan, newSpan, function () {
      if (dir < 0) parent.insertBefore(sec, other); else parent.insertBefore(other, sec);
      scheduleAddHide();
      sec.scrollIntoView({ behavior: 'smooth', block: 'center' });
    });
  }
  function setupSectionInsert() {
    document.querySelectorAll(SECTION_SEL).forEach(function (sec) {
      if (inChrome(sec) || sec.dataset.tnlSecIns || !isTopLevelSection(sec)) return;
      sec.dataset.tnlSecIns = '1';
      sec.addEventListener('mouseenter', function () { showAddCtl(sec); });
      sec.addEventListener('mouseleave', scheduleAddHide);
    });
  }

  /* ---------- MINH HOẠ (wireframe) cho từng loại khối - để chọn mà không cần đoán ----------
   * Không chụp ảnh thật (không có), thay bằng sơ đồ bố cục thu nhỏ: đủ để nhận ra dạng khối
   * (2 cột ảnh-chữ, 3 thẻ, bảng giá...) trước khi bấm chèn. */
  var GLYPH_KIND = {
    hero: 'hero', herodark: 'herodark', intro: 'colorhead', richtext: 'colorhead',
    panel: 'split', feat: 'split', twocol: 'split', band: 'band', contact: 'band',
    cards3: 'cards3', prog: 'cards4', cred: 'darkstat', reports: 'tagcards',
    steps: 'steps', timeline: 'timeline', pricing: 'price', compare: 'compare',
    bigtesti: 'avatarbig', testi3: 'quotecards', team: 'team', quote: 'quote',
    video: 'video', faq: 'faq', infocards: 'checkimg', checklist: 'checklist',
    countdown: 'countdown', regform: 'form', logos: 'logos', gallery: 'gallery',
    map: 'map', spacer: 'spacer'
  };
  var C_OR = '#FF4F21', C_DK = '#1D1D1D', C_LN = '#D8D3CE', C_BG = '#F1EDEA';
  function svgWrap(inner) {
    return '<svg viewBox="0 0 120 72" xmlns="http://www.w3.org/2000/svg">' +
      '<rect x="0" y="0" width="120" height="72" rx="6" fill="#fff" stroke="#EAE6E1"/>' + inner + '</svg>';
  }
  var GLYPHS = {
    hero: svgWrap('<rect x="6" y="6" width="108" height="60" rx="4" fill="' + C_BG + '"/><rect x="30" y="26" width="60" height="8" rx="2" fill="' + C_DK + '"/><rect x="40" y="38" width="40" height="5" rx="2" fill="#B4A99E"/><rect x="45" y="48" width="30" height="9" rx="4.5" fill="' + C_OR + '"/>'),
    herodark: svgWrap('<rect x="6" y="6" width="108" height="60" rx="4" fill="' + C_DK + '"/><rect x="30" y="20" width="60" height="8" rx="2" fill="#fff"/><rect x="40" y="32" width="40" height="5" rx="2" fill="#999"/><rect x="46" y="42" width="28" height="9" rx="4.5" fill="' + C_OR + '"/><rect x="30" y="56" width="60" height="6" rx="2" fill="#3a3a3a"/>'),
    colorhead: svgWrap('<rect x="10" y="12" width="70" height="9" rx="2" fill="' + C_OR + '"/><rect x="10" y="30" width="100" height="5" rx="2" fill="#ddd"/><rect x="10" y="40" width="100" height="5" rx="2" fill="#ddd"/><rect x="10" y="50" width="70" height="5" rx="2" fill="#ddd"/>'),
    split: svgWrap('<rect x="6" y="10" width="50" height="52" rx="4" fill="' + C_OR + '"/><rect x="16" y="24" width="30" height="6" rx="2" fill="#fff"/><rect x="16" y="34" width="30" height="4" rx="2" fill="rgba(255,255,255,.7)"/><rect x="64" y="10" width="50" height="52" rx="4" fill="' + C_BG + '"/>'),
    band: svgWrap('<rect x="6" y="18" width="108" height="36" rx="6" fill="' + C_OR + '"/><rect x="24" y="30" width="72" height="7" rx="2" fill="#fff"/><rect x="46" y="42" width="28" height="8" rx="4" fill="#fff"/>'),
    cards3: svgWrap('<rect x="8" y="16" width="30" height="40" rx="4" fill="' + C_BG + '"/><rect x="45" y="16" width="30" height="40" rx="4" fill="' + C_BG + '"/><rect x="82" y="16" width="30" height="40" rx="4" fill="' + C_BG + '"/><circle cx="23" cy="26" r="3" fill="' + C_OR + '"/><circle cx="60" cy="26" r="3" fill="' + C_OR + '"/><circle cx="97" cy="26" r="3" fill="' + C_OR + '"/>'),
    cards4: svgWrap('<rect x="6" y="18" width="24" height="36" rx="3" fill="' + C_BG + '"/><rect x="34" y="18" width="24" height="36" rx="3" fill="' + C_BG + '"/><rect x="62" y="18" width="24" height="36" rx="3" fill="' + C_BG + '"/><rect x="90" y="18" width="24" height="36" rx="3" fill="' + C_BG + '"/>'),
    darkstat: svgWrap('<rect x="6" y="6" width="108" height="60" rx="4" fill="' + C_DK + '"/><rect x="16" y="28" width="24" height="12" rx="2" fill="#AFE56B"/><rect x="48" y="28" width="24" height="12" rx="2" fill="#AFE56B"/><rect x="80" y="28" width="24" height="12" rx="2" fill="#AFE56B"/>'),
    tagcards: svgWrap('<rect x="8" y="14" width="32" height="42" rx="4" fill="' + C_BG + '"/><rect x="47" y="14" width="32" height="42" rx="4" fill="' + C_BG + '"/><rect x="86" y="14" width="26" height="42" rx="4" fill="' + C_BG + '"/><rect x="13" y="19" width="18" height="7" rx="3.5" fill="' + C_OR + '"/><rect x="52" y="19" width="18" height="7" rx="3.5" fill="' + C_OR + '"/>'),
    steps: svgWrap('<line x1="20" y1="36" x2="100" y2="36" stroke="' + C_LN + '" stroke-width="3"/><circle cx="20" cy="36" r="9" fill="' + C_OR + '"/><circle cx="60" cy="36" r="9" fill="' + C_OR + '"/><circle cx="100" cy="36" r="9" fill="' + C_OR + '"/>'),
    timeline: svgWrap('<line x1="20" y1="10" x2="20" y2="62" stroke="' + C_LN + '" stroke-width="3"/><circle cx="20" cy="18" r="4" fill="' + C_OR + '"/><rect x="32" y="14" width="70" height="6" rx="2" fill="#ddd"/><circle cx="20" cy="36" r="4" fill="' + C_OR + '"/><rect x="32" y="32" width="70" height="6" rx="2" fill="#ddd"/><circle cx="20" cy="54" r="4" fill="' + C_OR + '"/><rect x="32" y="50" width="70" height="6" rx="2" fill="#ddd"/>'),
    price: svgWrap('<rect x="30" y="6" width="60" height="60" rx="6" fill="' + C_BG + '" stroke="' + C_OR + '" stroke-width="2"/><rect x="42" y="16" width="36" height="10" rx="2" fill="' + C_DK + '"/><rect x="48" y="32" width="24" height="4" rx="2" fill="#B4A99E"/><rect x="48" y="40" width="24" height="4" rx="2" fill="#B4A99E"/><rect x="44" y="50" width="32" height="9" rx="4.5" fill="' + C_OR + '"/>'),
    compare: svgWrap('<rect x="8" y="10" width="48" height="50" rx="4" fill="' + C_BG + '"/><rect x="64" y="6" width="48" height="58" rx="4" fill="#fff" stroke="' + C_OR + '" stroke-width="2"/><rect x="16" y="18" width="32" height="5" rx="2" fill="#B4A99E"/><rect x="72" y="16" width="32" height="5" rx="2" fill="' + C_OR + '"/>'),
    avatarbig: svgWrap('<circle cx="24" cy="36" r="14" fill="' + C_BG + '"/><rect x="46" y="26" width="64" height="5" rx="2" fill="#ccc"/><rect x="46" y="36" width="50" height="5" rx="2" fill="#ccc"/><rect x="46" y="46" width="30" height="5" rx="2" fill="' + C_OR + '"/>'),
    quotecards: svgWrap('<rect x="8" y="16" width="30" height="40" rx="4" fill="' + C_BG + '"/><rect x="45" y="16" width="30" height="40" rx="4" fill="' + C_BG + '"/><rect x="82" y="16" width="30" height="40" rx="4" fill="' + C_BG + '"/><circle cx="23" cy="46" r="5" fill="#fff" stroke="' + C_OR + '"/><circle cx="60" cy="46" r="5" fill="#fff" stroke="' + C_OR + '"/><circle cx="97" cy="46" r="5" fill="#fff" stroke="' + C_OR + '"/>'),
    team: svgWrap('<circle cx="24" cy="26" r="12" fill="' + C_BG + '"/><circle cx="60" cy="26" r="12" fill="' + C_BG + '"/><circle cx="96" cy="26" r="12" fill="' + C_BG + '"/><rect x="14" y="44" width="20" height="4" rx="2" fill="#ccc"/><rect x="50" y="44" width="20" height="4" rx="2" fill="#ccc"/><rect x="86" y="44" width="20" height="4" rx="2" fill="#ccc"/>'),
    quote: svgWrap('<text x="60" y="34" font-size="26" text-anchor="middle" fill="' + C_OR + '" font-family="Georgia,serif">"</text><rect x="24" y="40" width="72" height="5" rx="2" fill="#ccc"/><rect x="36" y="50" width="48" height="5" rx="2" fill="#ccc"/>'),
    video: svgWrap('<rect x="10" y="10" width="100" height="52" rx="4" fill="' + C_DK + '"/><circle cx="60" cy="36" r="12" fill="rgba(255,255,255,.9)"/><path d="M56 30l10 6-10 6z" fill="' + C_OR + '"/>'),
    faq: svgWrap('<rect x="10" y="10" width="100" height="12" rx="3" fill="' + C_BG + '"/><rect x="10" y="26" width="100" height="12" rx="3" fill="' + C_BG + '"/><rect x="10" y="42" width="100" height="12" rx="3" fill="' + C_BG + '"/><text x="102" y="19" font-size="10" fill="' + C_OR + '">+</text><text x="102" y="35" font-size="10" fill="' + C_OR + '">+</text><text x="102" y="51" font-size="10" fill="' + C_OR + '">+</text>'),
    checkimg: svgWrap('<rect x="8" y="12" width="46" height="48" rx="4" fill="' + C_BG + '"/><rect x="64" y="18" width="8" height="8" rx="2" fill="' + C_OR + '"/><rect x="76" y="19" width="34" height="5" rx="2" fill="#ccc"/><rect x="64" y="34" width="8" height="8" rx="2" fill="' + C_OR + '"/><rect x="76" y="35" width="34" height="5" rx="2" fill="#ccc"/><rect x="64" y="50" width="8" height="8" rx="2" fill="' + C_OR + '"/><rect x="76" y="51" width="34" height="5" rx="2" fill="#ccc"/>'),
    checklist: svgWrap('<rect x="16" y="14" width="10" height="10" rx="2" fill="' + C_OR + '"/><rect x="32" y="16" width="72" height="6" rx="2" fill="#ccc"/><rect x="16" y="32" width="10" height="10" rx="2" fill="' + C_OR + '"/><rect x="32" y="34" width="72" height="6" rx="2" fill="#ccc"/><rect x="16" y="50" width="10" height="10" rx="2" fill="' + C_OR + '"/><rect x="32" y="52" width="72" height="6" rx="2" fill="#ccc"/>'),
    countdown: svgWrap('<rect x="8" y="22" width="22" height="28" rx="3" fill="' + C_DK + '"/><rect x="34" y="22" width="22" height="28" rx="3" fill="' + C_DK + '"/><rect x="60" y="22" width="22" height="28" rx="3" fill="' + C_DK + '"/><rect x="86" y="22" width="22" height="28" rx="3" fill="' + C_DK + '"/>'),
    form: svgWrap('<rect x="14" y="12" width="92" height="10" rx="2" fill="' + C_BG + '"/><rect x="14" y="28" width="92" height="10" rx="2" fill="' + C_BG + '"/><rect x="14" y="44" width="40" height="10" rx="5" fill="' + C_OR + '"/>'),
    logos: svgWrap('<rect x="8" y="30" width="16" height="10" rx="2" fill="#ccc"/><rect x="32" y="30" width="16" height="10" rx="2" fill="#ccc"/><rect x="56" y="30" width="16" height="10" rx="2" fill="#ccc"/><rect x="80" y="30" width="16" height="10" rx="2" fill="#ccc"/><rect x="104" y="30" width="10" height="10" rx="2" fill="#ccc"/>'),
    gallery: svgWrap('<rect x="8" y="10" width="32" height="24" rx="3" fill="' + C_BG + '"/><rect x="44" y="10" width="32" height="24" rx="3" fill="' + C_BG + '"/><rect x="80" y="10" width="32" height="24" rx="3" fill="' + C_BG + '"/><rect x="8" y="38" width="32" height="24" rx="3" fill="' + C_BG + '"/><rect x="44" y="38" width="32" height="24" rx="3" fill="' + C_BG + '"/><rect x="80" y="38" width="32" height="24" rx="3" fill="' + C_BG + '"/>'),
    map: svgWrap('<rect x="8" y="10" width="104" height="52" rx="4" fill="' + C_BG + '"/><path d="M60 26c-6 0-10 4-10 10 0 8 10 18 10 18s10-10 10-18c0-6-4-10-10-10z" fill="' + C_OR + '"/><circle cx="60" cy="36" r="4" fill="#fff"/>'),
    spacer: svgWrap('<line x1="20" y1="36" x2="100" y2="36" stroke="' + C_LN + '" stroke-width="2" stroke-dasharray="4 4"/>')
  };
  function glyphFor(type) { return GLYPHS[GLYPH_KIND[type]] || GLYPHS.colorhead; }

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
        b.innerHTML = '<span class="tnl-blockpicker__thumb">' + glyphFor(type) + '</span><span class="tnl-blockpicker__lbl">' + tnlEdit.blockTypes[type].label + '</span>';
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
        // Khoi chen boc trong .tnl-landing (de an style), nen khong co san
        // data-sentry-component nhu section that -> tu gan de no cung nhan duoc
        // nut "+ Them khoi"/"Xoa khoi" ngay ben duoi, chen lien tiep duoc.
        newEl.setAttribute('data-sentry-component', 'Section');
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
  /* ---------- ĐỊNH DẠNG CHỮ: đậm/nghiêng/màu cho phần đang bôi đen trong ô đang sửa.
   * Dùng execCommand (vẫn chạy tốt trên mọi trình duyệt hiện tại cho contenteditable,
   * đơn giản hơn nhiều so với tự viết lại cơ chế chọn vùng bôi đen). Mã màu nhập tay
   * (không giới hạn palette) - theo đúng yêu cầu Hiếu. */
  var FONT_SIZES = [13, 14, 16, 18, 20, 24, 28, 32, 40, 48];
  var txtTool, sizeSel, curTxtEl;
  function askHex(label) {
    var hex = prompt(label + ' (vd #FF4F21):', '');
    if (hex === null) return null;
    hex = hex.trim();
    if (hex === '') return null;
    if (!/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/.test(hex)) { toast('Mã màu không hợp lệ, ví dụ #FF4F21', true); return null; }
    return hex;
  }
  /* execCommand('fontSize') chỉ có 7 mức cố định (không theo px) - dùng mẹo: đặt tạm mức 7
   * rồi thay the <font size="7"> vừa sinh ra bằng <span style="font-size:Npx"> theo đúng px
   * người dùng chọn. */
  function applyFontSize(px) {
    document.execCommand('fontSize', false, '7');
    (curTxtEl || body).querySelectorAll('font[size="7"]').forEach(function (f) {
      var span = document.createElement('span');
      span.style.fontSize = px + 'px';
      while (f.firstChild) span.appendChild(f.firstChild);
      f.parentNode.replaceChild(span, f);
    });
  }
  function ensureTxtTool() {
    if (txtTool) return;
    txtTool = document.createElement('div'); txtTool.className = 'tnl-txttool';
    var sizeOpts = FONT_SIZES.map(function (s) { return '<option value="' + s + '">' + s + 'px</option>'; }).join('');
    function grp(rows) { return '<div class="tnl-txttool__grp">' + rows + '</div>'; }
    function btn(cmd, label, icon) {
      return '<button type="button" class="tnl-txttool__b" data-cmd="' + cmd + '" title="' + label + '">'
        + '<span class="tnl-txttool__ic">' + icon + '</span><span class="tnl-txttool__tx">' + label + '</span></button>';
    }
    txtTool.innerHTML =
      grp('<select class="tnl-txttool__size" title="Cỡ chữ"><option value="">Cỡ chữ</option>' + sizeOpts + '</select>') +
      grp(btn('bold', 'Đậm', '<b>B</b>') + btn('italic', 'Nghiêng', '<i>I</i>') + btn('underline', 'Gạch chân', '<u>U</u>') + btn('strikeThrough', 'Gạch ngang', '<s>S</s>')) +
      grp('<button type="button" class="tnl-txttool__b tnl-txttool__color" title="Màu chữ"><span class="tnl-txttool__ic">🎨</span><span class="tnl-txttool__tx">Màu chữ</span></button>'
        + '<button type="button" class="tnl-txttool__b tnl-txttool__hilite" title="Tô màu nền"><span class="tnl-txttool__ic">🖍</span><span class="tnl-txttool__tx">Tô nền</span></button>') +
      grp(btn('justifyLeft', 'Căn trái', '⬅') + btn('justifyCenter', 'Căn giữa', '⬌') + btn('justifyRight', 'Căn phải', '➡')) +
      grp(btn('insertUnorderedList', 'Danh sách', '☰') + '<button type="button" class="tnl-txttool__b tnl-txttool__clear" title="Xoá hết định dạng, về chữ thường"><span class="tnl-txttool__ic">↺</span><span class="tnl-txttool__tx">Về mặc định</span></button>');
    body.appendChild(txtTool);
    // Giữ nguyên vùng bôi đen khi bấm nút (không để nút "cướp" focus khỏi ô đang sửa).
    txtTool.addEventListener('mousedown', function (e) { if (e.target.tagName !== 'SELECT') e.preventDefault(); });
    txtTool.querySelectorAll('[data-cmd]').forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.preventDefault(); e.stopPropagation();
        document.execCommand(btn.getAttribute('data-cmd'));
      });
    });
    sizeSel = txtTool.querySelector('.tnl-txttool__size');
    // <select> cần nhận focus thật để mở được dropdown -> trình duyệt tự xoá vùng bôi đen
    // trong ô đang sửa lúc đó. Phải tự lưu lại vùng bôi đen NGAY TRƯỚC khi mất (mousedown,
    // trước khi focus chuyển đi), rồi khôi phục lại đúng vùng đó trước khi áp cỡ chữ.
    var savedRange = null;
    sizeSel.addEventListener('mousedown', function () {
      var sel = window.getSelection();
      if (sel.rangeCount && !sel.isCollapsed) savedRange = sel.getRangeAt(0).cloneRange();
    });
    sizeSel.addEventListener('change', function () {
      if (sizeSel.value) {
        if (savedRange && curTxtEl) {
          curTxtEl.focus();
          var sel = window.getSelection();
          sel.removeAllRanges();
          sel.addRange(savedRange);
        }
        applyFontSize(parseInt(sizeSel.value, 10));
      }
      sizeSel.value = '';
    });
    txtTool.querySelector('.tnl-txttool__color').addEventListener('click', function (e) {
      e.preventDefault(); e.stopPropagation();
      var hex = askHex('Nhập mã màu chữ cho phần đang bôi đen');
      if (!hex) return;
      document.execCommand('styleWithCSS', false, true);
      document.execCommand('foreColor', false, hex);
    });
    txtTool.querySelector('.tnl-txttool__hilite').addEventListener('click', function (e) {
      e.preventDefault(); e.stopPropagation();
      var hex = askHex('Nhập mã màu tô nền cho phần đang bôi đen');
      if (!hex) return;
      document.execCommand('styleWithCSS', false, true);
      document.execCommand('hiliteColor', false, hex);
    });
    txtTool.querySelector('.tnl-txttool__clear').addEventListener('click', function (e) {
      e.preventDefault(); e.stopPropagation(); document.execCommand('removeFormat');
    });
  }
  function showTxtTool(el) {
    ensureTxtTool();
    curTxtEl = el;
    var r = el.getBoundingClientRect();
    var top = Math.max(8, r.top - 44);
    var left = Math.min(Math.max(r.left, 8), window.innerWidth - 420);
    txtTool.style.top = top + 'px'; txtTool.style.left = left + 'px';
    txtTool.classList.add('show');
  }
  function hideTxtTool() { if (txtTool) txtTool.classList.remove('show'); }

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
        showTxtTool(el);
      }, true);

      el.addEventListener('blur', function () {
        if (el.getAttribute('contenteditable') !== 'true') return;
        el.setAttribute('contenteditable', 'false');
        el.removeAttribute('contenteditable');
        hideTxtTool();
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
      '<button class="tnl-eb-save">💾 Lưu</button>' +
      '<button class="tnl-eb-done">Xong</button>';
    body.appendChild(b);
    // Mọi sửa (chữ/ảnh/video/bố cục/thêm khối) đã tự lưu ngay khi thao tác xong (blur/chọn xong).
    // Nút này chốt luôn ô chữ đang gõ dở (nếu có) rồi báo lại cho Hiếu yên tâm là đã lưu hết.
    b.querySelector('.tnl-eb-save').addEventListener('click', function () {
      var ed = document.querySelector('[contenteditable="true"]');
      if (ed) ed.blur();
      toast('Đã lưu tất cả ✓');
    });
    b.querySelector('.tnl-eb-done').addEventListener('click', function () {
      var ed = document.querySelector('[contenteditable="true"]');
      if (ed) ed.blur();
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
