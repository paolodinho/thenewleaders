/* LANDING STUDIO - UI (vanilla JS + wp.media). Data model:
 * state.sections = [{type, fields:{k:v}, items:[{k:v},...]}, ...]
 */
(function () {
  if (typeof tnlStudio === 'undefined' || !tnlStudio.post) return;

  var state = {
    sections: (tnlStudio.data && tnlStudio.data.sections) || [],
    status: tnlStudio.post.status,
    dirty: false,
    openIndex: -1
  };

  var $list = document.getElementById('tnls-sections');
  var $frame = document.getElementById('tnls-frame');
  var $title = document.getElementById('tnls-title');
  var $msg = document.getElementById('tnls-savemsg');
  var $statusLabel = document.getElementById('tnls-status-label');
  var $view = document.getElementById('tnls-view');
  var schema = tnlStudio.schema;

  /* ---------- helpers ---------- */
  function esc(s) {
    return String(s == null ? '' : s).replace(/[&<>"']/g, function (c) {
      return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
    });
  }
  function markDirty() {
    state.dirty = true;
    $msg.textContent = 'Có thay đổi chưa lưu';
    $msg.className = 'tnls-savemsg is-dirty';
    schedulePreview();
  }

  /* ---------- live preview: doi 0.8s sau lan go cuoi -> cap nhat iframe, khong luu ---------- */
  var previewTimer = null, previewBusy = false, previewAgain = false;
  function schedulePreview() {
    clearTimeout(previewTimer);
    previewTimer = setTimeout(runPreview, 800);
  }
  function runPreview() {
    if (previewBusy) { previewAgain = true; return; }
    previewBusy = true;
    var note = document.querySelector('.tnls-preview-note');
    if (note) note.textContent = 'Đang cập nhật xem trước...';
    var fd = new FormData();
    fd.append('action', 'tnl_studio_preview');
    fd.append('nonce', tnlStudio.nonce);
    fd.append('post_id', tnlStudio.post.id);
    fd.append('data', JSON.stringify({ sections: state.sections }));
    fetch(tnlStudio.ajax, { method: 'POST', credentials: 'same-origin', body: fd })
      .then(function (r) { return r.json(); })
      .then(function (r) {
        if (r && r.success) {
          $frame.src = r.data.preview;
          if (note) note.textContent = 'Xem trước bản đang sửa (chưa lưu)';
        } else if (note) { note.textContent = 'Không cập nhật được xem trước'; }
      })
      .catch(function () { if (note) note.textContent = 'Không cập nhật được xem trước'; })
      .finally(function () {
        previewBusy = false;
        if (previewAgain) { previewAgain = false; schedulePreview(); }
      });
  }
  function setStatusLabel() {
    $statusLabel.textContent = state.status === 'publish' ? 'Đang chạy' : 'Bản nháp';
    $statusLabel.className = 'tnls-status ' + (state.status === 'publish' ? 'is-live' : 'is-draft');
  }
  function defaultSection(type) {
    var sc = schema[type], s = { type: type, fields: {}, items: [] };
    Object.keys(sc.fields || {}).forEach(function (k) { s.fields[k] = sc.fields[k][2] || ''; });
    if (sc.items) {
      for (var i = 0; i < (sc.items.default || 1); i++) {
        var row = {};
        Object.keys(sc.items.fields).forEach(function (k) { row[k] = sc.items.fields[k][2] || ''; });
        s.items.push(row);
      }
    }
    return s;
  }
  function sectionTitle(s) {
    var sc = schema[s.type];
    if (!sc) return s.type;
    var t = s.fields && (s.fields.title || s.fields.q || s.fields.badge || s.fields.label);
    return t ? t : sc.label;
  }

  /* ---------- render section list ---------- */
  function render() {
    $list.innerHTML = '';
    state.sections.forEach(function (s, idx) {
      var sc = schema[s.type];
      var li = document.createElement('li');
      li.className = 'tnls-item' + (state.openIndex === idx ? ' is-open' : '');
      li.draggable = true;
      li.dataset.idx = idx;

      var head = document.createElement('div');
      head.className = 'tnls-item-head';
      head.innerHTML =
        '<span class="tnls-grip" title="Kéo để đổi thứ tự">☰</span>' +
        '<span class="tnls-item-name"><b>' + esc(sc ? sc.label : s.type) + '</b><i>' + esc(sectionTitle(s)) + '</i></span>' +
        '<span class="tnls-item-acts">' +
        '<button class="tnls-ib" data-act="up" title="Lên">▲</button>' +
        '<button class="tnls-ib" data-act="down" title="Xuống">▼</button>' +
        '<button class="tnls-ib" data-act="dup" title="Nhân bản">⧉</button>' +
        '<button class="tnls-ib tnls-ib-del" data-act="del" title="Xoá">✕</button></span>';
      li.appendChild(head);

      if (state.openIndex === idx) li.appendChild(buildForm(s, idx));
      $list.appendChild(li);
    });
    if (!state.sections.length) {
      $list.innerHTML = '<li class="tnls-empty">Chưa có khối nào. Bấm "+ Thêm khối".</li>';
    }
  }

  /* ---------- form for one section ---------- */
  function fieldInput(def, val, onChange, hint) {
    var type = def[0], label = def[1];
    var hintText = hint && hint[0] ? hint[0] : '';
    var maxChars = hint && hint[1] ? parseInt(hint[1], 10) : 0;
    var wrap = document.createElement('label');
    wrap.className = 'tnls-field';
    var span = document.createElement('span');
    span.textContent = label;
    var counter = null;
    if (maxChars > 0 && (type === 'text' || type === 'textarea')) {
      counter = document.createElement('i');
      counter.className = 'tnls-count';
      span.appendChild(counter);
    }
    wrap.appendChild(span);
    if (hintText) {
      var hintEl = document.createElement('small');
      hintEl.className = 'tnls-fhint';
      hintEl.textContent = hintText;
      wrap.appendChild(hintEl);
    }
    function paintCount(v) {
      if (!counter) return;
      var n = (v || '').length;
      counter.textContent = n + '/' + maxChars;
      counter.classList.toggle('is-over', n > maxChars);
    }
    paintCount(val);
    var input;
    if (type === 'textarea') {
      input = document.createElement('textarea');
      input.rows = 3; input.value = val || '';
      input.addEventListener('input', function () { onChange(input.value); paintCount(input.value); });
    } else if (type === 'select') {
      input = document.createElement('select');
      var opts = def[3] || {};
      Object.keys(opts).forEach(function (k) {
        var o = document.createElement('option');
        o.value = k; o.textContent = opts[k];
        if (k === val) o.selected = true;
        input.appendChild(o);
      });
      input.addEventListener('change', function () { onChange(input.value); });
    } else if (type === 'check') {
      wrap.className = 'tnls-field tnls-field-check';
      input = document.createElement('input');
      input.type = 'checkbox'; input.checked = !!val;
      input.addEventListener('change', function () { onChange(input.checked ? '1' : ''); });
      wrap.insertBefore(input, span);
      return wrap;
    } else if (type === 'image') {
      var box = document.createElement('div');
      box.className = 'tnls-imgpick';
      var thumb = document.createElement('div');
      thumb.className = 'tnls-imgpick-thumb';
      function paint(v) {
        thumb.style.backgroundImage = 'url(' + (v || tnlStudio.ph) + ')';
        thumb.classList.toggle('is-ph', !v);
      }
      paint(val);
      var btn = document.createElement('button');
      btn.type = 'button'; btn.className = 'button'; btn.textContent = val ? 'Đổi ảnh' : 'Chọn ảnh';
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        var frame = wp.media({ title: 'Chọn ảnh', multiple: false, library: { type: 'image' } });
        frame.on('select', function () {
          var att = frame.state().get('selection').first().toJSON();
          onChange(att.url); paint(att.url); btn.textContent = 'Đổi ảnh';
        });
        frame.open();
      });
      var rm = document.createElement('button');
      rm.type = 'button'; rm.className = 'button tnls-imgpick-rm'; rm.textContent = 'Bỏ ảnh';
      rm.addEventListener('click', function (e) { e.preventDefault(); onChange(''); paint(''); btn.textContent = 'Chọn ảnh'; });
      box.appendChild(thumb); box.appendChild(btn); box.appendChild(rm);
      wrap.appendChild(box);
      return wrap;
    } else {
      input = document.createElement('input');
      input.type = 'text'; input.value = val || '';
      input.addEventListener('input', function () { onChange(input.value); paintCount(input.value); });
    }
    wrap.appendChild(input);
    return wrap;
  }

  function buildForm(s, idx) {
    var sc = schema[s.type];
    var hints = (tnlStudio.hints && tnlStudio.hints[s.type]) || {};
    var form = document.createElement('div');
    form.className = 'tnls-item-form';
    Object.keys(sc.fields || {}).forEach(function (k) {
      form.appendChild(fieldInput(sc.fields[k], s.fields[k], function (v) {
        s.fields[k] = v; markDirty();
        var nameEl = form.parentElement && form.parentElement.querySelector('.tnls-item-name i');
        if (nameEl) nameEl.textContent = sectionTitle(s);
      }, hints[k]));
    });
    if (sc.items) {
      var itWrap = document.createElement('div');
      itWrap.className = 'tnls-items';
      var h = document.createElement('div');
      h.className = 'tnls-items-head';
      h.innerHTML = '<strong>' + esc(sc.items.label) + ' (' + s.items.length + ')</strong>';
      var add = document.createElement('button');
      add.type = 'button'; add.className = 'button'; add.textContent = '+ Thêm ' + sc.items.label.toLowerCase();
      add.addEventListener('click', function () {
        var row = {};
        Object.keys(sc.items.fields).forEach(function (k) { row[k] = sc.items.fields[k][2] || ''; });
        s.items.push(row); markDirty(); render();
      });
      h.appendChild(add);
      itWrap.appendChild(h);
      s.items.forEach(function (row, ri) {
        var rbox = document.createElement('div');
        rbox.className = 'tnls-item-row';
        var rhead = document.createElement('div');
        rhead.className = 'tnls-item-row-head';
        rhead.innerHTML = '<span>' + esc(sc.items.label) + ' ' + (ri + 1) + '</span>';
        var del = document.createElement('button');
        del.type = 'button'; del.className = 'tnls-ib tnls-ib-del'; del.textContent = '✕';
        del.addEventListener('click', function () { s.items.splice(ri, 1); markDirty(); render(); });
        rhead.appendChild(del);
        rbox.appendChild(rhead);
        Object.keys(sc.items.fields).forEach(function (k) {
          rbox.appendChild(fieldInput(sc.items.fields[k], row[k], function (v) { row[k] = v; markDirty(); }, hints['items.' + k]));
        });
        itWrap.appendChild(rbox);
      });
      form.appendChild(itWrap);
    }
    return form;
  }

  /* ---------- list interactions ---------- */
  $list.addEventListener('click', function (e) {
    var btn = e.target.closest('.tnls-ib');
    var li = e.target.closest('.tnls-item');
    if (!li) return;
    var idx = parseInt(li.dataset.idx, 10);
    if (btn) {
      var act = btn.dataset.act;
      if (act === 'del') {
        if (!confirm('Xoá khối này?')) return;
        state.sections.splice(idx, 1);
        if (state.openIndex === idx) state.openIndex = -1;
      } else if (act === 'dup') {
        state.sections.splice(idx + 1, 0, JSON.parse(JSON.stringify(state.sections[idx])));
      } else if (act === 'up' && idx > 0) {
        var t = state.sections[idx - 1]; state.sections[idx - 1] = state.sections[idx]; state.sections[idx] = t;
        if (state.openIndex === idx) state.openIndex = idx - 1;
      } else if (act === 'down' && idx < state.sections.length - 1) {
        var t2 = state.sections[idx + 1]; state.sections[idx + 1] = state.sections[idx]; state.sections[idx] = t2;
        if (state.openIndex === idx) state.openIndex = idx + 1;
      }
      markDirty(); render();
      return;
    }
    if (e.target.closest('.tnls-item-form')) return; // click trong form
    if (e.target.closest('.tnls-item-head')) {
      state.openIndex = state.openIndex === idx ? -1 : idx;
      render();
    }
  });

  /* drag & drop */
  var dragIdx = null;
  $list.addEventListener('dragstart', function (e) {
    var li = e.target.closest('.tnls-item');
    if (!li) return;
    dragIdx = parseInt(li.dataset.idx, 10);
    li.classList.add('is-drag');
    e.dataTransfer.effectAllowed = 'move';
    try { e.dataTransfer.setData('text/plain', String(dragIdx)); } catch (err) {}
  });
  $list.addEventListener('dragover', function (e) {
    e.preventDefault();
    var li = e.target.closest('.tnls-item');
    if (!li || dragIdx === null) return;
    document.querySelectorAll('.tnls-item.is-over').forEach(function (el) { el.classList.remove('is-over'); });
    li.classList.add('is-over');
  });
  $list.addEventListener('drop', function (e) {
    e.preventDefault();
    var li = e.target.closest('.tnls-item');
    if (!li || dragIdx === null) return;
    var to = parseInt(li.dataset.idx, 10);
    if (to !== dragIdx) {
      var moved = state.sections.splice(dragIdx, 1)[0];
      state.sections.splice(to, 0, moved);
      state.openIndex = -1;
      markDirty();
    }
    dragIdx = null;
    render();
  });
  $list.addEventListener('dragend', function () {
    dragIdx = null;
    document.querySelectorAll('.is-drag,.is-over').forEach(function (el) { el.classList.remove('is-drag', 'is-over'); });
  });

  /* ---------- picker: mock preview cho tung khoi ---------- */
  function mockPreview(type) {
    var M = {
      hero:      '<div class="pv pv-hero"><i class="pv-b pv-w pv-60"></i><i class="pv-b pv-w2 pv-40"></i><i class="pv-pill"></i></div>',
      herodark:  '<div class="pv pv-dark"><i class="pv-badge"></i><i class="pv-b pv-w pv-55"></i><span class="pv-cd"><u></u><u></u><u></u><u></u></span></div>',
      intro:     '<div class="pv"><i class="pv-hl pv-cyan"></i><i class="pv-b pv-70"></i><i class="pv-b pv-55"></i></div>',
      panel:     '<div class="pv pv-split"><span class="pv-half pv-cyanbg"><i class="pv-b pv-dkb pv-60"></i><i class="pv-b pv-dkb2 pv-80"></i></span><span class="pv-half pv-imgbg"></span></div>',
      feat:      '<div class="pv pv-split"><span class="pv-half pv-imgbg"></span><span class="pv-half"><i class="pv-b pv-60"></i><i class="pv-b pv-80"></i><i class="pv-b pv-70"></i></span></div>',
      cards3:    '<div class="pv pv-row"><span class="pv-card"><b>⭐</b><i class="pv-b pv-70"></i></span><span class="pv-card"><b>💡</b><i class="pv-b pv-70"></i></span><span class="pv-card"><b>🎯</b><i class="pv-b pv-70"></i></span></div>',
      prog:      '<div class="pv pv-row"><span class="pv-card pv-bl"></span><span class="pv-card pv-bl"></span><span class="pv-card pv-bl"></span><span class="pv-card pv-bl"></span></div>',
      cred:      '<div class="pv pv-dark pv-row"><span class="pv-card pv-dkcard"><b class="pv-green">20+</b></span><span class="pv-card pv-dkcard"><b class="pv-green">1k+</b></span><span class="pv-card pv-dkcard"><b class="pv-green">50+</b></span></div>',
      reports:   '<div class="pv pv-row"><span class="pv-card"><i class="pv-tag"></i><i class="pv-b pv-70"></i></span><span class="pv-card"><i class="pv-tag"></i><i class="pv-b pv-70"></i></span><span class="pv-card"><i class="pv-tag"></i><i class="pv-b pv-70"></i></span></div>',
      steps:     '<div class="pv pv-row"><span class="pv-stp"><b>1</b><i class="pv-b pv-80"></i></span><span class="pv-stp"><b>2</b><i class="pv-b pv-80"></i></span><span class="pv-stp"><b>3</b><i class="pv-b pv-80"></i></span></div>',
      pricing:   '<div class="pv"><span class="pv-price"><i class="pv-b pv-strike pv-40"></i><b class="pv-orange">1.2tr</b><i class="pv-b pv-60"></i><i class="pv-pill pv-pill-o"></i></span></div>',
      bigtesti:  '<div class="pv"><i class="pv-hl pv-pale"></i><span class="pv-trow"><u class="pv-ava"></u><span><i class="pv-b pv-80"></i><i class="pv-b pv-50"></i></span></span></div>',
      testi3:    '<div class="pv pv-row"><span class="pv-card"><i class="pv-b pv-80"></i><span class="pv-who"><u class="pv-ava pv-ava-s"></u><i class="pv-b pv-40"></i></span></span><span class="pv-card"><i class="pv-b pv-80"></i><span class="pv-who"><u class="pv-ava pv-ava-s"></u><i class="pv-b pv-40"></i></span></span></div>',
      quote:     '<div class="pv pv-center"><b class="pv-orange" style="font-size:18px">"</b><i class="pv-b pv-70"></i><i class="pv-b pv-45"></i></div>',
      video:     '<div class="pv pv-center"><span class="pv-video"><u class="pv-play"></u></span></div>',
      twocol:    '<div class="pv pv-split"><span class="pv-half"><i class="pv-b pv-80"></i><i class="pv-b pv-70"></i><i class="pv-b pv-75"></i></span><span class="pv-half"><i class="pv-b pv-80"></i><i class="pv-b pv-70"></i><i class="pv-b pv-75"></i></span></div>',
      faq:       '<div class="pv"><span class="pv-faq"><i class="pv-b pv-70"></i><b>+</b></span><span class="pv-faq"><i class="pv-b pv-60"></i><b>+</b></span><span class="pv-faq"><i class="pv-b pv-65"></i><b>+</b></span></div>',
      infocards: '<div class="pv pv-row"><span class="pv-card"><b>📅</b></span><span class="pv-card"><b>🕐</b></span><span class="pv-card"><b>📍</b></span><span class="pv-card"><b>🎟️</b></span></div>',
      countdown: '<div class="pv pv-dark pv-center"><span class="pv-cd"><u></u><u></u><u></u><u></u></span></div>',
      regform:   '<div class="pv pv-center"><span class="pv-form"><i class="pv-inp"></i><i class="pv-inp"></i><i class="pv-pill pv-pill-o" style="width:70%"></i></span></div>',
      band:      '<div class="pv pv-dark pv-center"><i class="pv-b pv-w pv-60"></i><i class="pv-pill"></i></div>',
      contact:   '<div class="pv pv-orangebg pv-center"><i class="pv-b pv-w pv-50"></i><i class="pv-b pv-w2 pv-65"></i><i class="pv-pill"></i></div>',
      team:      '<div class="pv pv-row"><span class="pv-stp"><u class="pv-ava"></u><i class="pv-b pv-70"></i></span><span class="pv-stp"><u class="pv-ava"></u><i class="pv-b pv-70"></i></span><span class="pv-stp"><u class="pv-ava"></u><i class="pv-b pv-70"></i></span></div>',
      logos:     '<div class="pv pv-row"><i class="pv-b pv-30"></i><i class="pv-b pv-30"></i><i class="pv-b pv-30"></i><i class="pv-b pv-30"></i></div>',
      timeline:  '<div class="pv"><span class="pv-trow"><u class="pv-ava pv-ava-s"></u><i class="pv-b pv-70"></i></span><span class="pv-trow"><u class="pv-ava pv-ava-s"></u><i class="pv-b pv-60"></i></span></div>',
      checklist: '<div class="pv pv-split"><span class="pv-half pv-imgbg"></span><span class="pv-half"><i class="pv-b pv-70"></i><i class="pv-b pv-60"></i><i class="pv-b pv-65"></i></span></div>',
      gallery:   '<div class="pv pv-row"><span class="pv-half pv-imgbg" style="flex:1"></span><span class="pv-half pv-imgbg" style="flex:1"></span><span class="pv-half pv-imgbg" style="flex:1"></span></div>',
      compare:   '<div class="pv pv-row"><span class="pv-price" style="width:auto"><i class="pv-b pv-60"></i><b class="pv-orange">$</b></span><span class="pv-price" style="width:auto"><i class="pv-b pv-60"></i><b class="pv-orange">$</b></span></div>',
      map:       '<div class="pv"><span class="pv-half pv-imgbg" style="width:80%;height:70%"></span></div>',
      richtext:  '<div class="pv"><i class="pv-b pv-80"></i><i class="pv-b pv-70"></i><i class="pv-b pv-75"></i></div>',
      spacer:    '<div class="pv pv-center"><i class="pv-b pv-w2 pv-40" style="background:#ddd"></i></div>'
    };
    return M[type] || '<div class="pv"></div>';
  }

  var $picker = document.getElementById('tnls-picker');
  var $pickerGroups = document.getElementById('tnls-picker-groups');
  function openPicker() {
    var groups = {};
    Object.keys(schema).forEach(function (type) {
      var g = schema[type].group || 'Khác';
      (groups[g] = groups[g] || []).push(type);
    });
    $pickerGroups.innerHTML = '';
    Object.keys(groups).forEach(function (g) {
      var h = document.createElement('h4'); h.textContent = g;
      $pickerGroups.appendChild(h);
      var grid = document.createElement('div');
      grid.className = 'tnls-picker-grid';
      groups[g].forEach(function (type) {
        var b = document.createElement('button');
        b.type = 'button'; b.className = 'tnls-picker-item';
        b.innerHTML = mockPreview(type) + '<span class="tnls-picker-name">' + esc(schema[type].label) + '</span>';
        b.addEventListener('click', function () {
          state.sections.push(defaultSection(type));
          state.openIndex = state.sections.length - 1;
          $picker.hidden = true;
          markDirty(); render();
          $list.lastElementChild && $list.lastElementChild.scrollIntoView({ behavior: 'smooth' });
        });
        grid.appendChild(b);
      });
      $pickerGroups.appendChild(grid);
    });
    $picker.hidden = false;
  }
  document.getElementById('tnls-add').addEventListener('click', openPicker);
  document.getElementById('tnls-picker-close').addEventListener('click', function () { $picker.hidden = true; });
  $picker.addEventListener('click', function (e) { if (e.target === $picker) $picker.hidden = true; });

  /* ---------- cai dat trang (slug / parent / SEO) ---------- */
  var $settings = document.getElementById('tnls-settings');
  var $slug = document.getElementById('tnls-slug');
  var $parent = document.getElementById('tnls-parent');
  var $seoTitle = document.getElementById('tnls-seo-title');
  var $seoDesc = document.getElementById('tnls-seo-desc');
  (function initSettings() {
    if (!$settings) return;
    document.getElementById('tnls-url-prefix').textContent = tnlStudio.homeUrl;
    (tnlStudio.parents || []).forEach(function (p) {
      if (p.id === tnlStudio.post.id) return;
      var o = document.createElement('option');
      o.value = p.id; o.textContent = p.title;
      if (p.id === tnlStudio.post.parent) o.selected = true;
      $parent.appendChild(o);
    });
    $slug.value = tnlStudio.post.slug || '';
    $seoTitle.value = tnlStudio.post.seoTitle || '';
    $seoTitle.placeholder = $title.value;
    $seoDesc.value = tnlStudio.post.seoDesc || '';
    function wireCount(inp, max) {
      var c = document.querySelector('.tnls-count[data-for="' + inp.id + '"]');
      function paint() { if (c) { c.textContent = inp.value.length + '/' + max; c.classList.toggle('is-over', inp.value.length > max); } }
      inp.addEventListener('input', function () { paint(); markDirty(); });
      paint();
    }
    wireCount($seoTitle, 60);
    wireCount($seoDesc, 160);
    $slug.addEventListener('input', markDirty);
    $parent.addEventListener('change', markDirty);
    document.getElementById('tnls-settings-btn').addEventListener('click', function () { $settings.hidden = false; });
    document.getElementById('tnls-settings-close').addEventListener('click', function () { $settings.hidden = true; });
    $settings.addEventListener('click', function (e) { if (e.target === $settings) $settings.hidden = true; });
  })();

  /* ---------- save ---------- */
  function save(status, cb) {
    $msg.textContent = 'Đang lưu...'; $msg.className = 'tnls-savemsg';
    var fd = new FormData();
    fd.append('action', 'tnl_studio_save');
    fd.append('nonce', tnlStudio.nonce);
    fd.append('post_id', tnlStudio.post.id);
    fd.append('title', $title.value);
    fd.append('status', status || state.status);
    fd.append('data', JSON.stringify({ sections: state.sections }));
    if ($slug) fd.append('slug', $slug.value);
    if ($parent) fd.append('parent', $parent.value);
    if ($seoTitle) fd.append('seo_title', $seoTitle.value);
    if ($seoDesc) fd.append('seo_desc', $seoDesc.value);
    fetch(tnlStudio.ajax, { method: 'POST', credentials: 'same-origin', body: fd })
      .then(function (r) { return r.json(); })
      .then(function (r) {
        if (!r || !r.success) throw new Error((r && r.data) || 'Lỗi không xác định');
        state.dirty = false;
        state.status = r.data.status;
        setStatusLabel();
        $msg.textContent = 'Đã lưu ✓'; $msg.className = 'tnls-savemsg is-ok';
        $view.href = r.data.permalink;
        $frame.src = r.data.preview;
        if (cb) cb(r.data);
      })
      .catch(function (err) {
        $msg.textContent = 'Lỗi: ' + err.message; $msg.className = 'tnls-savemsg is-err';
      });
  }
  document.getElementById('tnls-save-draft').addEventListener('click', function () { save(null); });
  document.getElementById('tnls-publish').addEventListener('click', function () { save('publish'); });
  $title.addEventListener('input', markDirty);
  window.addEventListener('beforeunload', function (e) {
    if (state.dirty) { e.preventDefault(); e.returnValue = ''; }
  });

  /* ---------- preview device toggle ---------- */
  document.querySelectorAll('.tnls-devices button').forEach(function (b) {
    b.addEventListener('click', function () {
      document.querySelectorAll('.tnls-devices button').forEach(function (x) { x.classList.remove('active'); });
      b.classList.add('active');
      $frame.style.width = b.dataset.w;
    });
  });

  /* ---------- init ---------- */
  setStatusLabel();
  $view.href = tnlStudio.post.permalink;
  $frame.src = tnlStudio.post.preview;
  render();
})();
