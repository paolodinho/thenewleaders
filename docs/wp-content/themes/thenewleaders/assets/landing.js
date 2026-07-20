/* LANDING BUILDER - The New Leaders: countdown + form đăng ký (AJAX) */
(function () {
  'use strict';

  /* ---------- Đếm ngược ---------- */
  function pad(n) { return (n < 10 ? '0' : '') + n; }
  document.querySelectorAll('.tnl-countdown').forEach(function (el) {
    var deadline = parseInt(el.getAttribute('data-deadline'), 10) * 1000;
    if (!deadline) return;
    var d = el.querySelector('[data-d]'), h = el.querySelector('[data-h]'),
        m = el.querySelector('[data-m]'), s = el.querySelector('[data-s]');
    function tick() {
      var diff = deadline - Date.now();
      if (diff <= 0) { d.textContent = h.textContent = m.textContent = s.textContent = '00'; return; }
      var sec = Math.floor(diff / 1000);
      d.textContent = pad(Math.floor(sec / 86400));
      h.textContent = pad(Math.floor((sec % 86400) / 3600));
      m.textContent = pad(Math.floor((sec % 3600) / 60));
      s.textContent = pad(sec % 60);
    }
    tick();
    setInterval(tick, 1000);
  });

  /* ---------- Form đăng ký ---------- */
  document.querySelectorAll('.tnl-regform').forEach(function (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var msg = form.querySelector('.tnl-regform__msg');
      var btn = form.querySelector('.tnl-regform__submit');
      msg.className = 'tnl-regform__msg';
      msg.textContent = '';

      var data = new FormData(form);
      data.append('action', 'tnl_submit_lead');

      btn.disabled = true;
      var oldTxt = btn.textContent;
      btn.textContent = 'Đang gửi...';

      fetch((window.tnlLanding && tnlLanding.ajax) || '/wp-admin/admin-ajax.php', {
        method: 'POST', body: data, credentials: 'same-origin'
      })
        .then(function (r) { return r.json().catch(function () { return { success: false, data: { msg: 'Lỗi kết nối.' } }; }); })
        .then(function (res) {
          if (res && res.success) {
            msg.className = 'tnl-regform__msg is-ok';
            msg.textContent = (res.data && res.data.msg) || 'Đăng ký thành công!';
            form.reset();
          } else {
            msg.className = 'tnl-regform__msg is-err';
            msg.textContent = (res && res.data && res.data.msg) || 'Có lỗi xảy ra, vui lòng thử lại.';
          }
        })
        .catch(function () {
          msg.className = 'tnl-regform__msg is-err';
          msg.textContent = 'Không gửi được, kiểm tra kết nối mạng.';
        })
        .finally(function () {
          btn.disabled = false;
          btn.textContent = oldTxt;
        });
    });
  });
})();
