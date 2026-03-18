<?php
declare(strict_types=1);

function render_page(string $page, string $topic): void {
    $topics = get_topics();
    render_html_open($page, $topic, $topics);

    echo '<div id="app">';
    render_sidebar($page, $topic, $topics);
    echo '<div id="main">';
    render_topbar($page, $topic, $topics);
    echo '<div id="content">';

    match($page) {
        'home'       => render_home(),
        'theory'     => render_theory($topic, $topics),
        'examples'   => render_examples(),
        'quiz'       => render_quiz(),
        'cheatsheet' => render_cheatsheet(),
        'playground' => render_playground(),
        default      => render_home(),
    };

    echo '</div></div></div>';
    render_html_close();
}

function render_html_open(string $page, string $topic, array $topics): void {
    $title_map = [
        'home' => 'PHPForge — Learn PHP',
        'theory' => 'Theory: ' . ($topics[$topic]['title'] ?? 'PHP'),
        'examples' => 'Code Examples',
        'quiz' => 'PHP Quizzes',
        'cheatsheet' => 'PHP Cheat Sheet',
        'playground' => 'PHP Playground',
    ];
    $title = $title_map[$page] ?? 'PHPForge';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= h($title) ?> | PHPForge</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@300;400;600;700&family=Syne:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<?php
}

function render_html_close(): void {
?>
<script src="/assets/js/app.js"></script>
</body>
</html>
<?php
}

function render_sidebar(string $page, string $topic, array $topics): void {
?>
<nav id="sidebar">
  <div class="sidebar-inner">
    <div class="sidebar-header">
      <a href="/?page=home" class="logo">
        <span class="logo-bracket">&lt;?</span>PHPForge<span class="logo-bracket">?&gt;</span>
      </a>
      <div class="logo-sub">// learn · build · master</div>
    </div>
    <div class="sidebar-nav">
      <div class="nav-section"><span>Start Here</span></div>
      <a href="<?= url('home') ?>" class="nav-item<?= active_page('home', $page) ?>">
        <span class="icon">⚡</span> Overview
      </a>

      <div class="nav-section"><span>Theory</span></div>
      <?php foreach ($topics as $key => $t): ?>
      <a href="<?= url('theory', $key) ?>" class="nav-item<?= active_page('theory', $page) && $topic === $key ? ' active' : '' ?>">
        <span class="icon"><?= $t['icon'] ?></span> <?= h($t['title']) ?>
      </a>
      <?php endforeach; ?>

      <div class="nav-section"><span>Practice</span></div>
      <a href="<?= url('playground') ?>" class="nav-item<?= active_page('playground', $page) ?>">
        <span class="icon">🧪</span> Playground
      </a>
      <a href="<?= url('examples') ?>" class="nav-item<?= active_page('examples', $page) ?>">
        <span class="icon">💡</span> Examples
      </a>
      <a href="<?= url('quiz') ?>" class="nav-item<?= active_page('quiz', $page) ?>">
        <span class="icon">🎯</span> Quizzes
      </a>
      <a href="<?= url('cheatsheet') ?>" class="nav-item<?= active_page('cheatsheet', $page) ?>">
        <span class="icon">📋</span> Cheat Sheet
      </a>
    </div>
    <div class="sidebar-footer">
      <div class="progress-label">
        <span>Progress</span><span id="progress-pct">0%</span>
      </div>
      <div class="progress-bar"><div class="progress-fill" id="progress-fill"></div></div>
    </div>
  </div>
</nav>
<div id="sidebar-backdrop"></div>
<?php
}

function render_topbar(string $page, string $topic, array $topics): void {
    $titles = [
        'home' => 'PHPForge', 'theory' => 'Theory',
        'playground' => 'Playground', 'examples' => 'Examples',
        'quiz' => 'Quiz', 'cheatsheet' => 'Cheat Sheet',
    ];
    $crumb = $page === 'theory' ? ($topics[$topic]['title'] ?? '') : '';
?>
<div id="topbar">
  <button id="toggle-sidebar" aria-label="Toggle sidebar">☰</button>
  <div class="topbar-title"><?= h($titles[$page] ?? 'PHPForge') ?></div>
  <?php if ($crumb): ?>
  <div class="topbar-crumb"><span><?= h($crumb) ?></span></div>
  <?php endif; ?>
  <div class="topbar-right">
    <span class="php-badge">PHP <?= PHP_VERSION ?></span>
  </div>
</div>
<?php
}

// ─── Page Renderers ───────────────────────────────────────────────────

function render_home(): void {
    $topics = get_topics();
    $examples = get_examples();
?>
<div class="section">
  <div class="hero">
    <div class="hero-badge">⚡ Full PHP Learning Platform</div>
    <h1>Master <em>PHP</em> from<br>Zero to Production</h1>
    <p>13 theory modules, real code examples, quizzes, cheat sheet — all in one place. Running on real PHP <?= PHP_VERSION ?>.</p>
    <div class="hero-grid">
      <a href="<?= url('theory', 'intro') ?>" class="hero-card">
        <div class="hero-card-icon">📖</div>
        <h3>Theory Modules</h3>
        <p>13 topics from syntax to OOP &amp; MySQL</p>
      </a>
      <a href="<?= url('playground') ?>" class="hero-card">
        <div class="hero-card-icon">🧪</div>
        <h3>Playground</h3>
        <p>Write &amp; explain PHP code in-browser</p>
      </a>
      <a href="<?= url('quiz') ?>" class="hero-card">
        <div class="hero-card-icon">🎯</div>
        <h3>Quizzes</h3>
        <p>40+ questions across all difficulty levels</p>
      </a>
      <a href="<?= url('examples') ?>" class="hero-card">
        <div class="hero-card-icon">💡</div>
        <h3>Code Examples</h3>
        <p>Real-world PHP patterns, copy-ready</p>
      </a>
      <a href="<?= url('cheatsheet') ?>" class="hero-card">
        <div class="hero-card-icon">📋</div>
        <h3>Cheat Sheet</h3>
        <p>Quick reference for syntax &amp; functions</p>
      </a>
      <a href="<?= url('theory', 'db') ?>" class="hero-card">
        <div class="hero-card-icon">🗄️</div>
        <h3>MySQL &amp; PDO</h3>
        <p>Prepared statements, transactions, CRUD</p>
      </a>
    </div>
  </div>
</div>
<?php
}

function render_theory(string $topic, array $topics): void {
    if (!isset($topics[$topic])) $topic = 'intro';
    $t = $topics[$topic];
    $content = get_topic_content($topic);
    $keys = array_keys($topics);
    $idx  = array_search($topic, $keys, true);
    $prev = $idx > 0 ? $keys[$idx - 1] : null;
    $next = $idx < count($keys) - 1 ? $keys[$idx + 1] : null;
    $num  = $idx + 1;
?>
<div class="section theory-section">
  <!-- Mobile topic picker -->
  <div class="mobile-topic-select">
    <select onchange="location.href=this.value">
      <?php foreach ($topics as $key => $tp): ?>
      <option value="<?= h(url('theory', $key)) ?>" <?= $key === $topic ? 'selected' : '' ?>>
        <?= h($tp['title']) ?>
      </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="theory-layout">
    <!-- Desktop TOC -->
    <aside class="theory-toc">
      <div class="toc-title">Topics</div>
      <?php foreach ($topics as $key => $tp): $n = array_search($key, array_keys($topics)) + 1; ?>
      <a href="<?= h(url('theory', $key)) ?>" class="toc-item<?= active_topic($key, $topic) ?>">
        <span class="toc-num"><?= str_pad((string)$n, 2, '0', STR_PAD_LEFT) ?></span>
        <?= h($tp['title']) ?>
      </a>
      <?php endforeach; ?>
    </aside>

    <div class="theory-content-wrap">
      <div class="topic-header">
        <div class="topic-tag"><?= h($t['tag']) ?></div>
        <h1 class="topic-title"><?= h($t['title']) ?></h1>
        <div class="topic-num">Topic <?= $num ?> of <?= count($topics) ?></div>
      </div>

      <div class="theory-body">
        <?= $content ?>
      </div>

      <div class="topic-nav">
        <?php if ($prev): ?>
        <a href="<?= h(url('theory', $prev)) ?>" class="btn btn-secondary">← <?= h($topics[$prev]['title']) ?></a>
        <?php else: ?>
        <span></span>
        <?php endif; ?>
        <?php if ($next): ?>
        <a href="<?= h(url('theory', $next)) ?>" class="btn btn-primary"><?= h($topics[$next]['title']) ?> →</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php
}

function render_examples(): void {
    $examples = get_examples();
?>
<div class="section">
  <div class="section-header">
    <h2>💡 Code Examples</h2>
    <p>Real-world PHP — copy or study each pattern</p>
  </div>
  <div class="examples-grid">
    <?php foreach ($examples as $i => $ex): ?>
    <div class="example-card">
      <div class="example-card-header">
        <div class="example-card-title"><?= h($ex['title']) ?></div>
        <span class="example-tag <?= level_class($ex['level']) ?>"><?= h($ex['level']) ?></span>
      </div>
      <div class="example-desc"><?= h($ex['desc']) ?></div>
      <pre class="example-preview"><code><?= h(implode("\n", array_slice(explode("\n", $ex['code']), 0, 9))) ?></code></pre>
      <div class="example-footer">
        <button class="btn btn-secondary btn-sm" onclick="toggleExample(this)">View full</button>
        <button class="btn btn-primary btn-sm" onclick="copyExample(this, <?= $i ?>)">Copy</button>
      </div>
      <pre class="example-full hidden"><code><?= h($ex['code']) ?></code></pre>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<script>
const examplesData = <?= json_encode(array_map(fn($e) => $e['code'], get_examples())) ?>;
function toggleExample(btn) {
  const full = btn.closest('.example-card').querySelector('.example-full');
  full.classList.toggle('hidden');
  btn.textContent = full.classList.contains('hidden') ? 'View full' : 'Hide';
}
function copyExample(btn, i) {
  navigator.clipboard.writeText(examplesData[i]).then(() => {
    btn.textContent = 'Copied!';
    setTimeout(() => btn.textContent = 'Copy', 1500);
  });
}
</script>
<?php
}

function render_quiz(): void {
    $cats = get_quiz_categories();
    $all  = get_quiz_questions();
    $cur  = $_GET['cat'] ?? 'basics';
    if (!isset($all[$cur])) $cur = 'basics';
    $questions = $all[$cur];
?>
<div class="section">
  <div class="section-header">
    <h2>🎯 PHP Quizzes</h2>
    <p>Test your knowledge — instant feedback with explanations</p>
  </div>

  <div class="quiz-cat-tabs">
    <?php foreach ($cats as $key => $label): ?>
    <a href="<?= h(url('quiz') . '&cat=' . $key) ?>"
       class="quiz-cat-btn<?= $key === $cur ? ' active' : '' ?>"><?= h($label) ?></a>
    <?php endforeach; ?>
  </div>

  <div class="quiz-wrap" id="quiz-wrap">
    <div class="quiz-progress-bar-wrap">
      <div class="quiz-progress-bar"><div id="qpb" style="width:0%"></div></div>
      <div class="quiz-counter"><span id="qcur">1</span>/<span id="qtot"><?= count($questions) ?></span></div>
      <div class="quiz-score-display">Score: <span id="qscore">0</span>/<span id="qtaken">0</span></div>
    </div>
    <div id="quiz-area"></div>
  </div>
</div>
<script>
const QUESTIONS = <?= json_encode($questions) ?>;
const TOTAL = QUESTIONS.length;
let cur = 0, score = 0, taken = 0, answered = false;

function renderQ() {
  if (cur >= TOTAL) { showResult(); return; }
  const q = QUESTIONS[cur];
  document.getElementById('qcur').textContent = cur + 1;
  document.getElementById('qpb').style.width = (cur / TOTAL * 100) + '%';

  let html = `<div class="quiz-card">
    <div class="quiz-q-num">Question ${cur + 1}</div>
    <div class="quiz-question">${q.q}</div>
    <div class="quiz-options">
      ${q.opts.map((o, i) => `
        <div class="quiz-opt" data-idx="${i}" onclick="answerQ(${i})">
          <span class="quiz-opt-letter">${'ABCD'[i]}</span>${o}
        </div>`).join('')}
    </div>
    <div class="quiz-feedback" id="qfb"></div>
  </div>`;
  document.getElementById('quiz-area').innerHTML = html;
  answered = false;
}

function answerQ(idx) {
  if (answered) return;
  answered = true;
  taken++;
  const q = QUESTIONS[cur];
  const correct = idx === q.a;
  if (correct) score++;
  document.getElementById('qscore').textContent = score;
  document.getElementById('qtaken').textContent = taken;

  document.querySelectorAll('.quiz-opt').forEach((el, i) => {
    el.classList.add('disabled');
    if (i === q.a) el.classList.add(correct ? 'correct' : 'reveal');
  });
  if (!correct) document.querySelector(`.quiz-opt[data-idx="${idx}"]`).classList.add('wrong');

  const fb = document.getElementById('qfb');
  fb.className = 'quiz-feedback show ' + (correct ? 'correct' : 'wrong');
  fb.innerHTML = `<strong>${correct ? '✓ Correct!' : '✗ Wrong.'}</strong> ${q.exp}`;

  setTimeout(() => { cur++; renderQ(); }, correct ? 1500 : 2500);
}

function showResult() {
  const pct = Math.round(score / TOTAL * 100);
  const em = pct >= 80 ? '🏆' : pct >= 60 ? '✌️' : '📚';
  document.getElementById('quiz-area').innerHTML = `
    <div class="quiz-result">
      <div class="result-emoji">${em}</div>
      <div class="result-score">${pct}%</div>
      <div class="result-label">Quiz Complete</div>
      <div class="result-stats">
        <div class="rs-item"><div class="rs-val green">${score}</div><div class="rs-lbl">Correct</div></div>
        <div class="rs-item"><div class="rs-val red">${TOTAL - score}</div><div class="rs-lbl">Wrong</div></div>
        <div class="rs-item"><div class="rs-val">${TOTAL}</div><div class="rs-lbl">Total</div></div>
      </div>
      <button class="btn btn-primary" onclick="cur=0;score=0;taken=0;renderQ()">Retry</button>
    </div>`;
}

renderQ();
</script>
<?php
}

function render_cheatsheet(): void {
    $sheets = get_cheatsheets();
?>
<div class="section">
  <div class="section-header">
    <h2>📋 PHP Cheat Sheet</h2>
    <p>Quick reference for syntax, functions &amp; patterns</p>
  </div>
  <div class="cheatsheet-grid">
    <?php foreach ($sheets as $cs): ?>
    <div class="cs-card">
      <div class="cs-header">
        <?= h($cs['title']) ?>
        <button class="copy-btn" onclick="copyCode(this)">copy</button>
      </div>
      <pre><code><?= h($cs['code']) ?></code></pre>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?php
}

function render_playground(): void {
    $snippets = [
        'hello'  => '<?php' . "\n" . '$name = "World";' . "\n" . 'echo "Hello, $name!\n";',
        'vars'   => '<?php' . "\n" . '$str = "PHP";' . "\n" . '$num = 42;' . "\n" . '$arr = [1, 2, 3];' . "\n" . 'var_dump($str, $num, $arr);',
        'array'  => '<?php' . "\n" . '$skills = [\'Node.js\', \'PHP\', \'Redis\'];' . "\n" . '$upper = array_map(\'strtoupper\', $skills);' . "\n" . 'print_r($upper);',
        'loop'   => '<?php' . "\n" . 'for ($i = 1; $i <= 10; $i++) {' . "\n    " . 'echo match(true) {' . "\n        " . '$i % 3 === 0 && $i % 5 === 0 => "FizzBuzz",' . "\n        " . '$i % 3 === 0 => "Fizz",' . "\n        " . '$i % 5 === 0 => "Buzz",' . "\n        " . 'default => (string)$i,' . "\n    " . '} . "\n";' . "\n" . '}',
        'func'   => '<?php' . "\n" . 'function factorial(int $n): int {' . "\n    " . 'return $n <= 1 ? 1 : $n * factorial($n - 1);' . "\n" . '}' . "\n" . 'for ($i = 1; $i <= 7; $i++) {' . "\n    " . 'echo "$i! = " . factorial($i) . "\n";' . "\n" . '}',
        'class'  => '<?php' . "\n" . 'class Counter {' . "\n    " . 'private int $count = 0;' . "\n    " . 'public function increment(int $by = 1): void { $this->count += $by; }' . "\n    " . 'public function get(): int { return $this->count; }' . "\n" . '}' . "\n\n" . '$c = new Counter();' . "\n" . '$c->increment();' . "\n" . '$c->increment(4);' . "\n" . 'echo $c->get();',
    ];
?>
<div class="section playground-section">
  <div class="section-header">
    <h2>🧪 PHP Playground</h2>
    <p>Write PHP, explain line-by-line or review for issues</p>
  </div>
  <div class="playground-layout">
    <div class="pane editor-pane">
      <div class="pane-header">
        <div class="pane-title"><span class="dot"></span> editor.php</div>
        <div class="pane-actions">
          <select onchange="loadSnippet(this.value);this.value=''">
            <option value="">Load snippet…</option>
            <?php foreach ($snippets as $key => $code): ?>
            <option value="<?= h($key) ?>"><?= h(ucfirst($key)) ?></option>
            <?php endforeach; ?>
          </select>
          <button class="btn btn-secondary btn-sm" onclick="clearEditor()">Clear</button>
        </div>
      </div>
      <textarea id="editor" spellcheck="false"><?= h('<?php
$name = "PHP Developer";
$version = 8.2;

$skills = ["Variables", "Arrays", "OOP", "PDO"];
foreach ($skills as $i => $skill) {
    echo ($i + 1) . ". $skill\n";
}') ?></textarea>
      <div class="pane-toolbar">
        <button class="btn btn-purple" onclick="explainCode()">🔍 Explain Code</button>
        <button class="btn btn-green"  onclick="reviewCode()">✓ Review / Tips</button>
      </div>
    </div>
    <div class="pane result-pane">
      <div class="pane-header">
        <div class="pane-title"><span class="dot explain"></span> Analysis</div>
      </div>
      <div id="explain-box">
        <div class="explain-text">Press <strong>🔍 Explain Code</strong> for a line-by-line breakdown, or <strong>✓ Review / Tips</strong> for a code quality analysis.</div>
      </div>
    </div>
  </div>
</div>
<script>
const SNIPPETS = <?= json_encode($snippets) ?>;
function loadSnippet(k) { if(k) document.getElementById('editor').value = SNIPPETS[k]; }
function clearEditor() { document.getElementById('editor').value = ''; }

function explainCode() {
  const code = document.getElementById('editor').value;
  const box = document.getElementById('explain-box');
  const lines = code.replace(/<\?php/gi,'').replace(/\?>/g,'').split('\n').filter(l => l.trim() && !l.trim().startsWith('//'));
  const map = {
    '/^\\$\\w+\\s*=\\s*["\']/'     : 'Assigns a <strong>string</strong> value to a variable',
    '/^\\$\\w+\\s*=\\s*\\d/'        : 'Assigns a <strong>numeric</strong> value (int or float)',
    '/^\\$\\w+\\s*=\\s*\\[/'        : 'Creates an <strong>array</strong> (indexed or associative)',
    '/^\\$\\w+\\s*=.*new\\s/'        : 'Instantiates a <strong>class object</strong> with <code>new</code>',
    '/^echo\\s/'                    : 'Outputs value(s) to the page with <code>echo</code>',
    '/^print_r/'                    : 'Prints human-readable array/object with <code>print_r()</code>',
    '/^var_dump/'                   : 'Dumps type + value info with <code>var_dump()</code>',
    '/^if\\s*\\(/'                  : '<strong>Conditional</strong>: runs block only if condition is true',
    '/^}?\\s*elseif/'               : '<strong>elseif</strong>: checks another condition if previous was false',
    '/^}?\\s*else/'                 : '<strong>else</strong>: fallback when all conditions are false',
    '/^match\\s*\\(/'               : '<strong>match</strong> (PHP 8): strict multi-branch, returns a value',
    '/^for\\s*\\(/'                 : '<strong>for loop</strong>: classic counter-based iteration',
    '/^foreach\\s*\\(/'             : '<strong>foreach</strong>: iterates over every array element',
    '/^while\\s*\\(/'               : '<strong>while loop</strong>: repeats as long as condition is true',
    '/^function\\s+\\w+/'           : 'Defines a <strong>named function</strong>',
    '/^\\$\\w+\\s*=\\s*function/'   : 'Creates an <strong>anonymous function</strong> (closure)',
    '/^\\$\\w+\\s*=\\s*fn\\s*\\(/'  : 'Creates an <strong>arrow function</strong> (auto-captures outer vars)',
    '/^return\\s/'                  : '<code>return</code>: exits function and sends back a value',
    '/^class\\s/'                   : 'Declares a <strong>class</strong> (blueprint for objects)',
    '/\\$this->/'                   : 'Accesses instance property/method via <code>$this</code>',
    '/^enum\\s/'                    : 'Defines an <strong>enum</strong> (PHP 8.1 — fixed set of values)',
    '/array_map/'                   : '<code>array_map()</code>: transforms each element with a callback',
    '/array_filter/'                : '<code>array_filter()</code>: keeps elements that pass a test',
    '/array_reduce/'                : '<code>array_reduce()</code>: reduces array to single value',
    '/preg_match/'                  : '<code>preg_match()</code>: test string against a regex pattern',
    '/htmlspecialchars/'            : '<code>htmlspecialchars()</code>: encodes HTML — <strong>prevents XSS</strong>',
    '/password_hash/'               : '<code>password_hash()</code>: secure bcrypt password hashing',
    '/->prepare/'                   : '<code>prepare()</code>: creates <strong>prepared statement</strong> — prevents SQL injection',
    '/->execute/'                   : '<code>execute()</code>: runs prepared statement with bound params',
    '/->fetch/'                     : '<code>fetch()</code>: retrieves one row from query result',
  };
  const concepts = [];
  if (/class\s+\w+/.test(code)) concepts.push('OOP');
  if (/foreach|array_map|array_filter/.test(code)) concepts.push('Array Iteration');
  if (/fn\s*\(|function\s*\(/.test(code)) concepts.push('Closures');
  if (/preg_/.test(code)) concepts.push('Regex');
  if (/new PDO|->prepare/.test(code)) concepts.push('PDO');
  if (/password_hash|htmlspecialchars/.test(code)) concepts.push('Security');
  if (/try\s*\{|catch\s*\(/.test(code)) concepts.push('Exception Handling');

  let html = '<div class="explain-text"><strong>📋 Code Breakdown</strong><br><br>';
  lines.forEach(line => {
    const t = line.trim();
    if (!t || t === '{' || t === '}' || t === '?>') return;
    let desc = null;
    for (const [pat, exp] of Object.entries(map)) {
      try {
        const m = pat.slice(1, pat.lastIndexOf('/'));
        const f = pat.slice(pat.lastIndexOf('/') + 1);
        if (new RegExp(m, f||'').test(t)) { desc = exp; break; }
      } catch {}
    }
    const short = t.length > 58 ? t.slice(0, 55) + '…' : t;
    html += `<div class="eb-line ${desc ? 'known' : ''}">`;
    html += `<code>${escHtml(short)}</code>`;
    if (desc) html += `<br><span class="eb-desc">↳ ${desc}</span>`;
    html += '</div>';
  });
  if (concepts.length) {
    html += `<br><strong>🏷️ Concepts:</strong><br>` +
      concepts.map(c => `<span class="concept-tag">${c}</span>`).join(' ');
  }
  html += '</div>';
  box.innerHTML = html;
}

function reviewCode() {
  const code = document.getElementById('editor').value;
  const box = document.getElementById('explain-box');
  const issues = [], tips = [];

  if (/\$_GET|\$_POST/.test(code) && !/htmlspecialchars|filter_input/.test(code))
    issues.push('⚠️ User input without <code>htmlspecialchars()</code> — potential XSS');
  if (/mysql_query|mysql_connect/.test(code))
    issues.push('🚫 Deprecated <code>mysql_*</code> functions — use PDO or MySQLi');
  if (/\$_GET|\$_POST/.test(code) && /SELECT|INSERT|UPDATE/i.test(code) && !/->(prepare|execute)/.test(code))
    issues.push('🚫 Possible SQL injection — use PDO prepared statements');
  if (/md5\s*\(.*password|sha1\s*\(.*password/i.test(code))
    issues.push('🚫 Never use MD5/SHA1 for passwords — use <code>password_hash()</code>');
  if (/echo\s+\$_GET|echo\s+\$_POST/.test(code))
    issues.push('⚠️ Echoing raw user input — wrap with <code>htmlspecialchars()</code>');

  const typed = /:\s*(int|string|bool|float|array|void|mixed)/.test(code);
  if (/function\s+\w+/.test(code) && !typed)
    tips.push('💡 Add return type declarations e.g. <code>: string</code>, <code>: int</code>');
  if (/switch\s*\(/.test(code))
    tips.push('💡 Consider replacing <code>switch</code> with PHP 8 <code>match</code> — stricter & cleaner');
  if (/array_map.*function\s*\(/.test(code))
    tips.push('💡 Use arrow functions: <code>fn($x) => $x * 2</code> instead of <code>function($x) { return... }</code>');
  if (!/declare\s*\(\s*strict_types/.test(code))
    tips.push('💡 Add <code>declare(strict_types=1);</code> at top for strict type checking');

  const quality = Math.max(3, 10 - issues.length * 2);
  const qc = quality >= 8 ? 'green' : quality >= 5 ? 'yellow' : 'red';
  const lines = code.split('\n').filter(l => l.trim()).length;

  let html = `<div class="explain-text">
    <strong>🔍 Code Review</strong><br><br>
    <div class="review-stats">
      <div class="rs-item"><div class="rs-val ${qc}">${quality}/10</div><div class="rs-lbl">Quality</div></div>
      <div class="rs-item"><div class="rs-val">${lines}</div><div class="rs-lbl">Lines</div></div>
    </div><br>`;
  if (issues.length) {
    html += `<strong style="color:var(--red)">❌ Issues (${issues.length})</strong><br>`;
    issues.forEach(i => html += `<div class="review-issue">${i}</div>`);
    html += '<br>';
  } else {
    html += '<div style="color:var(--green);font-size:12px;margin-bottom:10px">✅ No security issues found</div>';
  }
  if (tips.length) {
    html += `<strong style="color:var(--yellow)">💡 Tips</strong><br>`;
    tips.forEach(t => html += `<div class="review-tip">${t}</div>`);
  }
  html += '</div>';
  box.innerHTML = html;
}

function escHtml(s) {
  return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
}
</script>
<?php
}
