/* EQ Quiz — tương tác, chấm điểm client-side (5 phương diện × 5 câu, mỗi câu 0–5 điểm) */
(function () {
  'use strict';
  const root = document.getElementById('eq-quiz');
  if (!root) return;

  let D;
  try { D = JSON.parse(root.dataset.quiz); } catch (e) { return; }

  const TOTAL_STEPS = 1 + D.steps.length;     // info + 5 aspect pages
  const AVG_RATIO = 0.7;                       // mốc "trung bình" ~70%
  const state = { step: 0, info: {}, answers: D.steps.map(() => Array(5).fill(null)) };

  const el = (tag, cls, html) => { const e = document.createElement(tag); if (cls) e.className = cls; if (html != null) e.innerHTML = html; return e; };
  const esc = (s) => String(s).replace(/[&<>"]/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]));

  function render() {
    root.innerHTML = '';
    if (state.step >= TOTAL_STEPS) { renderResults(); return; }
    if (state.step === 0) renderInfo();
    else renderAspect(state.step - 1);
    root.scrollIntoView({ block: 'start', behavior: 'smooth' });
  }

  function progressBar(current) {
    const wrap = el('div', 'eq-progress');
    const fill = el('div', 'eq-progress__fill');
    fill.style.width = ((current) / TOTAL_STEPS * 100) + '%';
    wrap.appendChild(fill);
    const label = el('span', 'eq-progress__label', (current + 1) + '/' + TOTAL_STEPS);
    const box = el('div', 'eq-progress__box'); box.appendChild(wrap); box.appendChild(label);
    return box;
  }

  function renderInfo() {
    const card = el('div', 'eq-card');
    card.appendChild(progressBar(0));
    card.appendChild(el('h2', 'eq-card__title', esc(D.info_title)));
    const form = el('div', 'eq-info');
    D.fields.forEach((label, i) => {
      const f = el('div', 'eq-field');
      f.appendChild(el('label', null, esc(label)));
      const inp = el('input'); inp.type = (i === 2 ? 'email' : 'text'); inp.value = state.info[i] || '';
      inp.addEventListener('input', () => { state.info[i] = inp.value; });
      f.appendChild(inp);
      const err = el('span', 'eq-err'); f.appendChild(err);
      form.appendChild(f);
    });
    card.appendChild(form);
    const actions = el('div', 'eq-actions');
    const next = el('button', 'btn btn--primary', esc(D.next) + ' 1/' + TOTAL_STEPS);
    next.type = 'button';
    next.addEventListener('click', () => {
      let ok = true;
      [...card.querySelectorAll('.eq-field')].forEach((f, i) => {
        const v = (state.info[i] || '').trim();
        const err = f.querySelector('.eq-err');
        let msg = '';
        if (!v) msg = D.required;
        else if (i === 2 && !/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(v)) msg = D.required;
        err.textContent = msg; f.classList.toggle('is-err', !!msg); if (msg) ok = false;
      });
      if (ok) { state.step = 1; render(); }
    });
    actions.appendChild(next);
    card.appendChild(actions);
    root.appendChild(card);
  }

  function renderAspect(ai) {
    const stepData = D.steps[ai];
    const card = el('div', 'eq-card');
    card.appendChild(progressBar(ai + 1));
    const head = el('div', 'eq-aspect-head');
    head.style.background = stepData.bg;
    head.appendChild(el('h2', 'eq-aspect-head__title', esc(stepData.title)));
    card.appendChild(head);

    stepData.q.forEach((q, qi) => {
      const block = el('div', 'eq-q');
      block.appendChild(el('p', 'eq-q__text', esc(q)));
      const opts = el('div', 'eq-opts');
      D.options.forEach(([label, val]) => {
        const o = el('button', 'eq-opt');
        o.type = 'button';
        o.textContent = label;
        if (state.answers[ai][qi] === val) o.classList.add('is-sel');
        o.addEventListener('click', () => {
          state.answers[ai][qi] = val;
          [...opts.children].forEach(c => c.classList.remove('is-sel'));
          o.classList.add('is-sel');
          block.classList.remove('is-err');
        });
        opts.appendChild(o);
      });
      block.appendChild(opts);
      block.appendChild(el('span', 'eq-err', ''));
      card.appendChild(block);
    });

    const actions = el('div', 'eq-actions');
    const back = el('button', 'btn btn--outline-dark', esc(D.back));
    back.type = 'button';
    back.addEventListener('click', () => { state.step--; render(); });
    actions.appendChild(back);

    const isLast = ai === D.steps.length - 1;
    const next = el('button', 'btn btn--primary', isLast ? esc(D.submit) : esc(D.next) + ' ' + (ai + 2) + '/' + TOTAL_STEPS);
    next.type = 'button';
    next.addEventListener('click', () => {
      let ok = true;
      [...card.querySelectorAll('.eq-q')].forEach((b, qi) => {
        const answered = state.answers[ai][qi] !== null;
        b.querySelector('.eq-err').textContent = answered ? '' : D.required;
        b.classList.toggle('is-err', !answered);
        if (!answered) ok = false;
      });
      if (!ok) { card.querySelector('.is-err').scrollIntoView({ block: 'center', behavior: 'smooth' }); return; }
      if (isLast) { state.step = TOTAL_STEPS; renderResults(); }
      else { state.step++; render(); }
    });
    actions.appendChild(next);
    card.appendChild(actions);
    root.appendChild(card);
  }

  function renderResults() {
    root.innerHTML = '';
    const card = el('div', 'eq-card eq-result');
    card.appendChild(el('h2', 'eq-result__title', esc(D.res_title)));
    D.steps.forEach((s, ai) => {
      const score = state.answers[ai].reduce((a, b) => a + (b || 0), 0);
      const pct = score / 25 * 100;
      const row = el('div', 'eq-res-row');
      const top = el('div', 'eq-res-row__top');
      top.appendChild(el('span', 'eq-res-row__name', esc(s.title)));
      top.appendChild(el('span', 'eq-res-row__score', esc(D.you_scored) + ' ' + score + ' ' + esc(D.out_of) + ' 25'));
      row.appendChild(top);

      const bar = el('div', 'eq-bar');
      const yourMark = el('span', 'eq-bar__mark eq-bar__mark--you');
      yourMark.style.left = pct + '%';
      yourMark.appendChild(el('span', 'eq-bar__tip', esc(D.your_score)));
      const avgMark = el('span', 'eq-bar__mark eq-bar__mark--avg');
      avgMark.style.left = (AVG_RATIO * 100) + '%';
      avgMark.appendChild(el('span', 'eq-bar__tip eq-bar__tip--avg', esc(D.avg)));
      const fill = el('span', 'eq-bar__fill'); fill.style.width = pct + '%'; fill.style.background = s.bg;
      bar.appendChild(fill); bar.appendChild(avgMark); bar.appendChild(yourMark);
      row.appendChild(bar);

      const ends = el('div', 'eq-bar__ends');
      ends.appendChild(el('span', null, esc(D.opp)));
      ends.appendChild(el('span', null, esc(D.strength)));
      row.appendChild(ends);
      card.appendChild(row);
    });
    const actions = el('div', 'eq-actions');
    const restart = el('button', 'btn btn--outline-dark', esc(D.restart));
    restart.type = 'button';
    restart.addEventListener('click', () => { state.step = 0; state.answers = D.steps.map(() => Array(5).fill(null)); render(); });
    actions.appendChild(restart);
    card.appendChild(actions);
    root.appendChild(card);
    root.scrollIntoView({ block: 'start', behavior: 'smooth' });
    sendResults();
  }

  let sent = false;
  function sendResults() {
    if (sent || !window.tnlData || !tnlData.ajaxUrl) return;
    sent = true;
    const fd = new FormData();
    fd.append('action', 'tnl_form');
    fd.append('nonce', tnlData.nonce || '');
    fd.append('form_type', 'EQ Quiz Result');
    D.fields.forEach((label, i) => fd.append('fields[' + label + ']', state.info[i] || ''));
    D.steps.forEach((s, ai) => {
      const score = state.answers[ai].reduce((a, b) => a + (b || 0), 0);
      fd.append('fields[' + s.title + ']', score + '/25');
    });
    fetch(tnlData.ajaxUrl, { method: 'POST', body: fd, credentials: 'same-origin' }).catch(() => {});
  }

  render();
})();
