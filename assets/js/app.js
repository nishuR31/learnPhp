/* ═══════════════════════════════════════
   PHPForge — app.js
   ═══════════════════════════════════════ */

(function () {
  'use strict';

  const sidebar  = document.getElementById('sidebar');
  const backdrop = document.getElementById('sidebar-backdrop');
  const toggle   = document.getElementById('toggle-sidebar');

  if (!sidebar || !toggle) return;

  /* ── helpers ── */
  function isMobile() { return window.innerWidth <= 768; }

  function openSidebar() {
    sidebar.classList.add('mobile-open');
    if (backdrop) backdrop.classList.add('show');
    document.body.style.overflow = 'hidden'; // prevent scroll-behind
  }

  function closeSidebar() {
    sidebar.classList.remove('mobile-open');
    if (backdrop) backdrop.classList.remove('show');
    document.body.style.overflow = '';
  }

  function toggleDesktop() {
    sidebar.classList.toggle('collapsed');
  }

  /* ── toggle button ── */
  toggle.addEventListener('click', (e) => {
    e.stopPropagation();
    if (isMobile()) {
      sidebar.classList.contains('mobile-open') ? closeSidebar() : openSidebar();
    } else {
      toggleDesktop();
    }
  });

  /* ── backdrop click → close ── */
  if (backdrop) {
    backdrop.addEventListener('click', closeSidebar);
  }

  /* ── nav link click on mobile → close ── */
  sidebar.querySelectorAll('.nav-item').forEach(el => {
    el.addEventListener('click', () => {
      if (isMobile()) closeSidebar();
    });
  });

  /* ── escape key ── */
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && isMobile()) closeSidebar();
  });

  /* ── close on resize to desktop ── */
  window.addEventListener('resize', () => {
    if (!isMobile()) closeSidebar();
  });

  /* ═══════════════════════════════════════
     Copy Code Buttons
     ═══════════════════════════════════════ */
  window.copyCode = function (btn) {
    const block = btn.closest('.code-block, .cs-card');
    const code  = block ? (block.querySelector('pre code')?.innerText || '') : '';
    if (!code) return;
    navigator.clipboard.writeText(code).then(() => {
      const orig = btn.textContent;
      btn.textContent = 'copied!';
      btn.style.color = 'var(--green)';
      btn.style.borderColor = 'var(--green)';
      setTimeout(() => {
        btn.textContent = orig;
        btn.style.color = '';
        btn.style.borderColor = '';
      }, 1600);
    }).catch(() => {
      /* fallback for non-https */
      const ta = document.createElement('textarea');
      ta.value = code;
      ta.style.position = 'fixed';
      ta.style.opacity  = '0';
      document.body.appendChild(ta);
      ta.select();
      document.execCommand('copy');
      document.body.removeChild(ta);
      btn.textContent = 'copied!';
      setTimeout(() => { btn.textContent = 'copy'; }, 1500);
    });
  };

  /* ═══════════════════════════════════════
     Progress Tracking (localStorage)
     ═══════════════════════════════════════ */
  const TOTAL = 13;

  function getVisited() {
    try { return JSON.parse(localStorage.getItem('phpforge_visited') || '[]'); }
    catch { return []; }
  }

  function saveVisited(arr) {
    try { localStorage.setItem('phpforge_visited', JSON.stringify(arr)); }
    catch {}
  }

  function updateProgressBar() {
    const visited = getVisited();
    const pct     = Math.round((Math.min(visited.length, TOTAL) / TOTAL) * 100);
    const fill    = document.getElementById('progress-fill');
    const label   = document.getElementById('progress-pct');
    if (fill)  fill.style.width   = pct + '%';
    if (label) label.textContent  = pct + '%';
  }

  function markVisited(topic) {
    const visited = getVisited();
    if (!visited.includes(topic)) {
      visited.push(topic);
      saveVisited(visited);
    }
    updateProgressBar();
  }

  /* auto-mark theory topic on page load */
  try {
    const params = new URLSearchParams(window.location.search);
    if (params.get('page') === 'theory') {
      markVisited(params.get('topic') || 'intro');
    }
  } catch {}

  updateProgressBar();

})();
