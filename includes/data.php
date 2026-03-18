<?php
declare(strict_types=1);

function get_topics(): array {
    return [
        'intro'     => ['tag' => 'Getting Started',   'title' => 'Introduction to PHP',        'icon' => '📖'],
        'variables' => ['tag' => 'Core Concepts',      'title' => 'Variables & Data Types',     'icon' => '📦'],
        'operators' => ['tag' => 'Core Concepts',      'title' => 'Operators',                  'icon' => '⚙️'],
        'control'   => ['tag' => 'Core Concepts',      'title' => 'Control Flow',               'icon' => '🔀'],
        'loops'     => ['tag' => 'Core Concepts',      'title' => 'Loops',                      'icon' => '🔁'],
        'functions' => ['tag' => 'Core Concepts',      'title' => 'Functions',                  'icon' => '🔧'],
        'arrays'    => ['tag' => 'Data Structures',    'title' => 'Arrays',                     'icon' => '📚'],
        'strings'   => ['tag' => 'Data Structures',    'title' => 'Strings & Regex',            'icon' => '✏️'],
        'forms'     => ['tag' => 'Web Features',       'title' => 'Forms & Superglobals',       'icon' => '📝'],
        'files'     => ['tag' => 'Web Features',       'title' => 'File I/O',                   'icon' => '🗂️'],
        'oop'       => ['tag' => 'Advanced',           'title' => 'Object-Oriented PHP',        'icon' => '🏗️'],
        'errors'    => ['tag' => 'Advanced',           'title' => 'Error & Exception Handling', 'icon' => '🛡️'],
        'db'        => ['tag' => 'Advanced',           'title' => 'MySQL & PDO',                'icon' => '🗄️'],
    ];
}

function get_topic_content(string $topic): string {
    $contents = [

'intro' => <<<'PHP'
<div class="info-box note"><div class="ib-label">What is PHP?</div>PHP stands for <strong>PHP: Hypertext Preprocessor</strong>. It's a server-side scripting language powering ~77% of all websites — including WordPress, Facebook (originally), and Wikipedia.</div>

<p class="theory-text">PHP is <strong>embedded directly in HTML</strong>, runs on a web server (Apache/Nginx/Caddy), and outputs HTML, JSON, or XML. It connects to databases, handles sessions, files, and much more.</p>

<h3 class="sub-heading">Basic PHP File</h3>
<div class="code-block">
<div class="code-header"><span class="code-lang">PHP</span><span class="code-file">index.php</span><button class="copy-btn" onclick="copyCode(this)">copy</button></div>
<pre><code><span class="kw">&lt;?php</span>
  <span class="fn">echo</span> <span class="st">"Hello, World!"</span><span class="op">;</span>
<span class="kw">?&gt;</span>

<span class="cm">&lt;!-- Mix PHP with HTML --&gt;</span>
<span class="op">&lt;</span>h1<span class="op">&gt;</span><span class="kw">&lt;?php</span> <span class="fn">echo</span> <span class="st">"Dynamic Title"</span><span class="op">;</span> <span class="kw">?&gt;</span><span class="op">&lt;/</span>h1<span class="op">&gt;</span>

<span class="cm">// Shorthand echo (great for templates)</span>
<span class="op">&lt;?=</span> <span class="st">"Quick echo"</span> <span class="op">?&gt;</span>

<span class="cm">// Pure PHP file — closing ?&gt; is optional (prevents whitespace bugs)</span></code></pre>
</div>

<h3 class="sub-heading">How PHP Works</h3>
<p class="theory-text">① Browser requests <code>page.php</code> → ② Server runs PHP engine → ③ PHP outputs HTML → ④ Browser receives pure HTML. The PHP source is <strong>never visible</strong> to the user.</p>

<h3 class="sub-heading">PHP Versions</h3>
<table class="data-table"><thead><tr><th>Version</th><th>Key Feature</th><th>Status</th></tr></thead><tbody>
<tr><td>PHP 7.x</td><td>2× speed, scalar type declarations</td><td class="type">EOL</td></tr>
<tr><td>PHP 8.0</td><td>JIT, Union Types, Match expression</td><td class="type">EOL</td></tr>
<tr><td>PHP 8.1</td><td>Enums, Fibers, readonly properties</td><td><code>Security fixes</code></td></tr>
<tr><td><strong>PHP 8.2</strong></td><td>readonly classes, DNF types</td><td><code>Active</code></td></tr>
<tr><td><strong>PHP 8.3</strong></td><td>Typed class constants, json_validate()</td><td><code>Current</code></td></tr>
</tbody></table>

<div class="info-box tip"><div class="ib-label">💡 Tip</div>Always omit the closing <code>?&gt;</code> in pure PHP files — it prevents accidental whitespace being sent before headers, which breaks <code>header()</code> calls and sessions.</div>
PHP,

'variables' => <<<'PHP'
<p class="theory-text">PHP is <strong>dynamically typed</strong> by default — variables hold any type and can change. PHP 8 added strict typing, union types, and readonly for production-quality code.</p>

<div class="code-block">
<div class="code-header"><span class="code-lang">PHP</span><span class="code-file">variables.php</span><button class="copy-btn" onclick="copyCode(this)">copy</button></div>
<pre><code><span class="kw">&lt;?php</span>
<span class="cm">// Variables always start with $</span>
<span class="va">$name</span>    <span class="op">=</span> <span class="st">"Nishu"</span><span class="op">;</span>        <span class="cm">// string</span>
<span class="va">$age</span>     <span class="op">=</span> <span class="nm">21</span><span class="op">;</span>              <span class="cm">// integer</span>
<span class="va">$gpa</span>     <span class="op">=</span> <span class="nm">9.1</span><span class="op">;</span>             <span class="cm">// float</span>
<span class="va">$active</span>  <span class="op">=</span> <span class="kw">true</span><span class="op">;</span>            <span class="cm">// boolean</span>
<span class="va">$nothing</span> <span class="op">=</span> <span class="kw">null</span><span class="op">;</span>            <span class="cm">// NULL</span>

<span class="cm">// Type inspection</span>
<span class="fn">var_dump</span>(<span class="va">$age</span>)<span class="op">;</span>     <span class="cm">// int(21)</span>
<span class="fn">gettype</span>(<span class="va">$name</span>)<span class="op">;</span>   <span class="cm">// "string"</span>

<span class="cm">// Type casting</span>
<span class="va">$num</span> <span class="op">=</span> (<span class="kw">int</span>)<span class="st">"42abc"</span><span class="op">;</span>   <span class="cm">// 42</span>
<span class="va">$str</span> <span class="op">=</span> (<span class="kw">string</span>)<span class="nm">3.14</span><span class="op">;</span>  <span class="cm">// "3.14"</span>

<span class="cm">// Constants (no $ prefix)</span>
<span class="fn">define</span>(<span class="st">'MAX_SIZE'</span><span class="op">,</span> <span class="nm">100</span>)<span class="op">;</span>
<span class="kw">const</span> <span class="cl">APP_NAME</span> <span class="op">=</span> <span class="st">'PHPForge'</span><span class="op">;</span>

<span class="cm">// PHP 8 — Typed declarations</span>
<span class="kw">function</span> <span class="fn">greet</span>(<span class="kw">string</span> <span class="va">$name</span><span class="op">,</span> <span class="kw">int</span> <span class="va">$age</span>)<span class="op">:</span> <span class="kw">string</span> <span class="op">{</span>
    <span class="kw">return</span> <span class="st">"$name is $age years old"</span><span class="op">;</span>
<span class="op">}</span>

<span class="cm">// Nullable type (?type means string OR null)</span>
<span class="kw">function</span> <span class="fn">findUser</span>(<span class="kw">int</span> <span class="va">$id</span>)<span class="op">:</span> <span class="op">?</span><span class="kw">string</span> <span class="op">{</span>
    <span class="kw">return</span> <span class="va">$id</span> <span class="op">===</span> <span class="nm">1</span> <span class="op">?</span> <span class="st">"Nishu"</span> <span class="op">:</span> <span class="kw">null</span><span class="op">;</span>
<span class="op">}</span>

<span class="cm">// PHP 8.1 readonly property (set once in constructor)</span>
<span class="kw">class</span> <span class="cl">User</span> <span class="op">{</span>
    <span class="kw">public readonly</span> <span class="kw">string</span> <span class="va">$name</span><span class="op">;</span>
    <span class="kw">public function</span> <span class="fn">__construct</span>(<span class="kw">string</span> <span class="va">$name</span>) <span class="op">{</span>
        <span class="va">$this</span><span class="op">-></span><span class="va">name</span> <span class="op">=</span> <span class="va">$name</span><span class="op">;</span>
    <span class="op">}</span>
<span class="op">}</span></code></pre>
</div>

<h3 class="sub-heading">PHP Data Types</h3>
<table class="data-table"><thead><tr><th>Type</th><th>Example</th><th>Notes</th></tr></thead><tbody>
<tr><td><code>string</code></td><td><code>"hello"</code>, <code>'world'</code></td><td>Double quotes parse variables; single don't</td></tr>
<tr><td><code>int</code></td><td><code>42</code>, <code>-7</code>, <code>0xFF</code></td><td>Platform-dependent size (usually 64-bit)</td></tr>
<tr><td><code>float</code></td><td><code>3.14</code>, <code>1.2e3</code></td><td>IEEE 754 double precision</td></tr>
<tr><td><code>bool</code></td><td><code>true</code>, <code>false</code></td><td>Case-insensitive</td></tr>
<tr><td><code>array</code></td><td><code>[1, 2, 3]</code></td><td>Can be indexed or associative</td></tr>
<tr><td><code>null</code></td><td><code>null</code></td><td>Represents no value</td></tr>
</tbody></table>

<div class="info-box warn"><div class="ib-label">⚠️ Loose vs Strict</div>Add <code>declare(strict_types=1);</code> at the very top of every file to enforce strict type checking — prevents silent coercion bugs like <code>"5" + 3</code> silently becoming <code>8</code>.</div>
PHP,

'operators' => <<<'PHP'
<div class="code-block">
<div class="code-header"><span class="code-lang">PHP</span><button class="copy-btn" onclick="copyCode(this)">copy</button></div>
<pre><code><span class="kw">&lt;?php</span>
<span class="cm">// Arithmetic</span>
<span class="va">$a</span> <span class="op">=</span> <span class="nm">10</span><span class="op">;</span>  <span class="va">$b</span> <span class="op">=</span> <span class="nm">3</span><span class="op">;</span>
<span class="fn">echo</span> <span class="va">$a</span> <span class="op">**</span> <span class="va">$b</span><span class="op">;</span>  <span class="cm">// 1000  (power)</span>
<span class="fn">echo</span> <span class="va">$a</span> <span class="op">%</span>  <span class="va">$b</span><span class="op">;</span>  <span class="cm">// 1     (modulo)</span>
<span class="fn">echo</span> <span class="nm">10</span> <span class="op">/</span> <span class="nm">3</span><span class="op">;</span>   <span class="cm">// 3.333…</span>

<span class="cm">// Comparison — ALWAYS prefer ===</span>
<span class="va">$x</span> <span class="op">==</span>  <span class="va">$y</span><span class="op">;</span>   <span class="cm">// equal (loose — coerces types)</span>
<span class="va">$x</span> <span class="op">===</span> <span class="va">$y</span><span class="op">;</span>   <span class="cm">// identical (value + type)</span>
<span class="va">$x</span> <span class="op">&lt;=&gt;</span> <span class="va">$y</span><span class="op">;</span>   <span class="cm">// spaceship: returns -1, 0, or 1</span>

<span class="cm">// Logical</span>
<span class="va">$a</span> <span class="op">&amp;&amp;</span> <span class="va">$b</span><span class="op">;</span>    <span class="cm">// AND (short-circuit)</span>
<span class="va">$a</span> <span class="op">||</span> <span class="va">$b</span><span class="op">;</span>    <span class="cm">// OR  (short-circuit)</span>
<span class="op">!</span><span class="va">$a</span><span class="op">;</span>        <span class="cm">// NOT</span>

<span class="cm">// String concatenation</span>
<span class="va">$full</span> <span class="op">=</span> <span class="st">"Hello"</span> <span class="op">.</span> <span class="st">" World"</span><span class="op">;</span>
<span class="va">$full</span> <span class="op">.=</span> <span class="st">"!"</span><span class="op">;</span>  <span class="cm">// append</span>

<span class="cm">// Null coalescing (PHP 7+)</span>
<span class="va">$user</span> <span class="op">=</span> <span class="va">$_GET</span>[<span class="st">'user'</span>] <span class="op">??</span> <span class="st">'guest'</span><span class="op">;</span>

<span class="cm">// Null coalescing assignment (PHP 7.4+)</span>
<span class="va">$config</span>[<span class="st">'debug'</span>] <span class="op">??=</span> <span class="kw">false</span><span class="op">;</span>

<span class="cm">// Ternary shorthand (Elvis)</span>
<span class="va">$label</span> <span class="op">=</span> <span class="va">$name</span> <span class="op">?:</span> <span class="st">'Anonymous'</span><span class="op">;</span>

<span class="cm">// Spaceship — perfect for sorting</span>
<span class="fn">usort</span>(<span class="va">$arr</span><span class="op">,</span> <span class="kw">fn</span>(<span class="va">$a</span><span class="op">,</span> <span class="va">$b</span>) <span class="op">=></span> <span class="va">$a</span> <span class="op">&lt;=&gt;</span> <span class="va">$b</span>)<span class="op">;</span></code></pre>
</div>
<div class="info-box warn"><div class="ib-label">⚠️ Pitfall</div><code>0 == "foo"</code> returned <strong>true</strong> in PHP 7 (coercion). PHP 8 fixed this — now <code>false</code>. Always use <code>===</code> to be safe in all versions.</div>
PHP,

'control' => <<<'PHP'
<div class="code-block">
<div class="code-header"><span class="code-lang">PHP</span><button class="copy-btn" onclick="copyCode(this)">copy</button></div>
<pre><code><span class="kw">&lt;?php</span>
<span class="cm">// if / elseif / else</span>
<span class="va">$score</span> <span class="op">=</span> <span class="nm">85</span><span class="op">;</span>
<span class="kw">if</span> (<span class="va">$score</span> <span class="op">>=</span> <span class="nm">90</span>) <span class="op">{</span>
    <span class="fn">echo</span> <span class="st">"A grade"</span><span class="op">;</span>
<span class="op">}</span> <span class="kw">elseif</span> (<span class="va">$score</span> <span class="op">>=</span> <span class="nm">80</span>) <span class="op">{</span>
    <span class="fn">echo</span> <span class="st">"B grade"</span><span class="op">;</span>
<span class="op">}</span> <span class="kw">else</span> <span class="op">{</span>
    <span class="fn">echo</span> <span class="st">"Below B"</span><span class="op">;</span>
<span class="op">}</span>

<span class="cm">// match (PHP 8) — strict, no fall-through, returns value</span>
<span class="va">$result</span> <span class="op">=</span> <span class="kw">match</span>(<span class="kw">true</span>) <span class="op">{</span>
    <span class="va">$score</span> <span class="op">>=</span> <span class="nm">90</span> <span class="op">=></span> <span class="st">'A'</span><span class="op">,</span>
    <span class="va">$score</span> <span class="op">>=</span> <span class="nm">80</span> <span class="op">=></span> <span class="st">'B'</span><span class="op">,</span>
    <span class="va">$score</span> <span class="op">>=</span> <span class="nm">70</span> <span class="op">=></span> <span class="st">'C'</span><span class="op">,</span>
    <span class="kw">default</span>         <span class="op">=></span> <span class="st">'F'</span><span class="op">,</span>
<span class="op">};</span>

<span class="cm">// Nullsafe operator (PHP 8) — safe chaining</span>
<span class="va">$city</span> <span class="op">=</span> <span class="va">$user</span><span class="op">?-></span><span class="fn">getAddress</span>()<span class="op">?-></span>city<span class="op">;</span>

<span class="cm">// Alternative syntax for templates</span>
<span class="kw">if</span> (<span class="va">$loggedIn</span>)<span class="op">:</span>
<span class="op">?&gt;</span>
    <span class="op">&lt;</span>p<span class="op">&gt;</span>Welcome back!<span class="op">&lt;/</span>p<span class="op">&gt;</span>
<span class="op">&lt;?php</span> <span class="kw">endif</span><span class="op">;</span></code></pre>
</div>
<div class="info-box tip"><div class="ib-label">💡 match vs switch</div><code>match</code> uses <strong>strict (===) comparison</strong>, returns a value, no <code>break</code> needed, and throws <code>UnhandledMatchError</code> if no arm matches. Always prefer <code>match</code> in PHP 8+.</div>
PHP,

'loops' => <<<'PHP'
<div class="code-block">
<div class="code-header"><span class="code-lang">PHP</span><button class="copy-btn" onclick="copyCode(this)">copy</button></div>
<pre><code><span class="kw">&lt;?php</span>
<span class="cm">// for — classic counter loop</span>
<span class="kw">for</span> (<span class="va">$i</span> <span class="op">=</span> <span class="nm">0</span><span class="op">;</span> <span class="va">$i</span> <span class="op">&lt;</span> <span class="nm">5</span><span class="op">;</span> <span class="va">$i</span><span class="op">++</span>) <span class="op">{</span>
    <span class="fn">echo</span> <span class="va">$i</span><span class="op">;</span>
<span class="op">}</span>

<span class="cm">// foreach — iterate arrays (most common)</span>
<span class="va">$skills</span> <span class="op">=</span> [<span class="st">'Node.js'</span><span class="op">,</span> <span class="st">'PHP'</span><span class="op">,</span> <span class="st">'Redis'</span>]<span class="op">;</span>
<span class="kw">foreach</span> (<span class="va">$skills</span> <span class="kw">as</span> <span class="va">$i</span> <span class="op">=></span> <span class="va">$skill</span>) <span class="op">{</span>
    <span class="fn">echo</span> <span class="st">"$i: $skill\n"</span><span class="op">;</span>
<span class="op">}</span>

<span class="cm">// Associative array foreach</span>
<span class="va">$user</span> <span class="op">=</span> [<span class="st">'name'</span> <span class="op">=></span> <span class="st">'Nishu'</span><span class="op">,</span> <span class="st">'role'</span> <span class="op">=></span> <span class="st">'dev'</span>]<span class="op">;</span>
<span class="kw">foreach</span> (<span class="va">$user</span> <span class="kw">as</span> <span class="va">$key</span> <span class="op">=></span> <span class="va">$val</span>) <span class="op">{</span>
    <span class="fn">echo</span> <span class="st">"$key → $val\n"</span><span class="op">;</span>
<span class="op">}</span>

<span class="cm">// while</span>
<span class="va">$n</span> <span class="op">=</span> <span class="nm">10</span><span class="op">;</span>
<span class="kw">while</span> (<span class="va">$n</span> <span class="op">></span> <span class="nm">0</span>) <span class="op">{</span>
    <span class="fn">echo</span> <span class="va">$n</span><span class="op">;</span>
    <span class="va">$n</span> <span class="op">-=</span> <span class="nm">2</span><span class="op">;</span>
<span class="op">}</span>

<span class="cm">// Generator — O(1) memory for large ranges</span>
<span class="kw">function</span> <span class="fn">bigRange</span>(<span class="va">$start</span><span class="op">,</span> <span class="va">$end</span>) <span class="op">{</span>
    <span class="kw">for</span> (<span class="va">$i</span> <span class="op">=</span> <span class="va">$start</span><span class="op">;</span> <span class="va">$i</span> <span class="op">&lt;=</span> <span class="va">$end</span><span class="op">;</span> <span class="va">$i</span><span class="op">++</span>) <span class="op">{</span>
        <span class="kw">yield</span> <span class="va">$i</span><span class="op">;</span>
    <span class="op">}</span>
<span class="op">}</span>
<span class="kw">foreach</span> (<span class="fn">bigRange</span>(<span class="nm">1</span><span class="op">,</span> <span class="nm">1000000</span>) <span class="kw">as</span> <span class="va">$num</span>) <span class="op">{</span>
    <span class="cm">// Uses O(1) memory vs range(1, 1000000)</span>
<span class="op">}</span></code></pre>
</div>
PHP,

'functions' => <<<'PHP'
<div class="code-block">
<div class="code-header"><span class="code-lang">PHP</span><button class="copy-btn" onclick="copyCode(this)">copy</button></div>
<pre><code><span class="kw">&lt;?php</span>
<span class="cm">// Named function with type hints + return type</span>
<span class="kw">function</span> <span class="fn">add</span>(<span class="kw">int</span> <span class="va">$a</span><span class="op">,</span> <span class="kw">int</span> <span class="va">$b</span>)<span class="op">:</span> <span class="kw">int</span> <span class="op">{</span>
    <span class="kw">return</span> <span class="va">$a</span> <span class="op">+</span> <span class="va">$b</span><span class="op">;</span>
<span class="op">}</span>

<span class="cm">// Default parameters</span>
<span class="kw">function</span> <span class="fn">greet</span>(<span class="kw">string</span> <span class="va">$name</span><span class="op">,</span> <span class="kw">string</span> <span class="va">$prefix</span> <span class="op">=</span> <span class="st">"Hello"</span>)<span class="op">:</span> <span class="kw">string</span> <span class="op">{</span>
    <span class="kw">return</span> <span class="st">"$prefix, $name!"</span><span class="op">;</span>
<span class="op">}</span>

<span class="cm">// Variadic functions</span>
<span class="kw">function</span> <span class="fn">sum</span>(<span class="kw">int</span> <span class="op">...</span><span class="va">$nums</span>)<span class="op">:</span> <span class="kw">int</span> <span class="op">{</span>
    <span class="kw">return</span> <span class="fn">array_sum</span>(<span class="va">$nums</span>)<span class="op">;</span>
<span class="op">}</span>
<span class="fn">echo</span> <span class="fn">sum</span>(<span class="nm">1</span><span class="op">,</span> <span class="nm">2</span><span class="op">,</span> <span class="nm">3</span><span class="op">,</span> <span class="nm">4</span>)<span class="op">;</span>  <span class="cm">// 10</span>

<span class="cm">// Named arguments (PHP 8) — order-independent</span>
<span class="fn">greet</span>(<span class="va">prefix:</span> <span class="st">"Hey"</span><span class="op">,</span> <span class="va">name:</span> <span class="st">"Nishu"</span>)<span class="op">;</span>

<span class="cm">// Anonymous function (closure)</span>
<span class="va">$double</span> <span class="op">=</span> <span class="kw">function</span>(<span class="kw">int</span> <span class="va">$n</span>)<span class="op">:</span> <span class="kw">int</span> <span class="op">{</span>
    <span class="kw">return</span> <span class="va">$n</span> <span class="op">*</span> <span class="nm">2</span><span class="op">;</span>
<span class="op">};</span>

<span class="cm">// Arrow function (PHP 7.4) — auto-captures outer scope</span>
<span class="va">$multiplier</span> <span class="op">=</span> <span class="nm">3</span><span class="op">;</span>
<span class="va">$triple</span> <span class="op">=</span> <span class="kw">fn</span>(<span class="va">$n</span>) <span class="op">=></span> <span class="va">$n</span> <span class="op">*</span> <span class="va">$multiplier</span><span class="op">;</span>

<span class="cm">// Higher-order functions</span>
<span class="va">$nums</span>    <span class="op">=</span> [<span class="nm">1</span><span class="op">,</span> <span class="nm">2</span><span class="op">,</span> <span class="nm">3</span><span class="op">,</span> <span class="nm">4</span><span class="op">,</span> <span class="nm">5</span>]<span class="op">;</span>
<span class="va">$evens</span>   <span class="op">=</span> <span class="fn">array_filter</span>(<span class="va">$nums</span><span class="op">,</span> <span class="kw">fn</span>(<span class="va">$n</span>) <span class="op">=></span> <span class="va">$n</span> <span class="op">%</span> <span class="nm">2</span> <span class="op">===</span> <span class="nm">0</span>)<span class="op">;</span>
<span class="va">$doubled</span> <span class="op">=</span> <span class="fn">array_map</span>(<span class="kw">fn</span>(<span class="va">$n</span>) <span class="op">=></span> <span class="va">$n</span> <span class="op">*</span> <span class="nm">2</span><span class="op">,</span> <span class="va">$nums</span>)<span class="op">;</span>
<span class="va">$total</span>   <span class="op">=</span> <span class="fn">array_reduce</span>(<span class="va">$nums</span><span class="op">,</span> <span class="kw">fn</span>(<span class="va">$c</span><span class="op">,</span> <span class="va">$n</span>) <span class="op">=></span> <span class="va">$c</span> <span class="op">+</span> <span class="va">$n</span><span class="op">,</span> <span class="nm">0</span>)<span class="op">;</span>

<span class="cm">// First-class callables (PHP 8.1)</span>
<span class="va">$fn</span> <span class="op">=</span> <span class="fn">strlen</span>(<span class="op">...</span>)<span class="op">;</span>   <span class="cm">// Closure from built-in</span>
<span class="fn">echo</span> <span class="va">$fn</span>(<span class="st">"hello"</span>)<span class="op">;</span>   <span class="cm">// 5</span></code></pre>
</div>
PHP,

'arrays' => <<<'PHP'
<div class="code-block">
<div class="code-header"><span class="code-lang">PHP</span><button class="copy-btn" onclick="copyCode(this)">copy</button></div>
<pre><code><span class="kw">&lt;?php</span>
<span class="cm">// Indexed array</span>
<span class="va">$fruits</span> <span class="op">=</span> [<span class="st">'apple'</span><span class="op">,</span> <span class="st">'mango'</span><span class="op">,</span> <span class="st">'grape'</span>]<span class="op">;</span>

<span class="cm">// Associative array</span>
<span class="va">$user</span> <span class="op">=</span> [<span class="st">'name'</span> <span class="op">=></span> <span class="st">'Nishu'</span><span class="op">,</span> <span class="st">'stack'</span> <span class="op">=></span> <span class="st">'Node.js'</span>]<span class="op">;</span>

<span class="cm">// Multidimensional</span>
<span class="va">$matrix</span> <span class="op">=</span> [[<span class="nm">1</span><span class="op">,</span><span class="nm">2</span>]<span class="op">,</span> [<span class="nm">3</span><span class="op">,</span><span class="nm">4</span>]<span class="op">,</span> [<span class="nm">5</span><span class="op">,</span><span class="nm">6</span>]]<span class="op">;</span>
<span class="fn">echo</span> <span class="va">$matrix</span>[<span class="nm">1</span>][<span class="nm">0</span>]<span class="op">;</span>  <span class="cm">// 3</span>

<span class="cm">// Core manipulation</span>
<span class="va">$fruits</span>[] <span class="op">=</span> <span class="st">'kiwi'</span><span class="op">;</span>                    <span class="cm">// append</span>
<span class="fn">array_push</span>(<span class="va">$fruits</span><span class="op">,</span> <span class="st">'banana'</span>)<span class="op">;</span>
<span class="fn">array_pop</span>(<span class="va">$fruits</span>)<span class="op">;</span>                    <span class="cm">// remove last</span>
<span class="fn">array_shift</span>(<span class="va">$fruits</span>)<span class="op">;</span>                  <span class="cm">// remove first</span>
<span class="fn">array_unshift</span>(<span class="va">$fruits</span><span class="op">,</span> <span class="st">'cherry'</span>)<span class="op">;</span>     <span class="cm">// prepend</span>

<span class="cm">// Search & check</span>
<span class="fn">in_array</span>(<span class="st">'mango'</span><span class="op">,</span> <span class="va">$fruits</span>)<span class="op">;</span>
<span class="fn">array_key_exists</span>(<span class="st">'name'</span><span class="op">,</span> <span class="va">$user</span>)<span class="op">;</span>
<span class="fn">array_search</span>(<span class="st">'grape'</span><span class="op">,</span> <span class="va">$fruits</span>)<span class="op">;</span>

<span class="cm">// Functional</span>
<span class="va">$adults</span>  <span class="op">=</span> <span class="fn">array_filter</span>(<span class="va">$users</span><span class="op">,</span> <span class="kw">fn</span>(<span class="va">$u</span>) <span class="op">=></span> <span class="va">$u</span>[<span class="st">'age'</span>] <span class="op">>=</span> <span class="nm">18</span>)<span class="op">;</span>
<span class="va">$names</span>   <span class="op">=</span> <span class="fn">array_map</span>(<span class="kw">fn</span>(<span class="va">$u</span>) <span class="op">=></span> <span class="va">$u</span>[<span class="st">'name'</span>]<span class="op">,</span> <span class="va">$users</span>)<span class="op">;</span>
<span class="va">$total</span>   <span class="op">=</span> <span class="fn">array_reduce</span>(<span class="va">$nums</span><span class="op">,</span> <span class="kw">fn</span>(<span class="va">$c</span><span class="op">,</span><span class="va">$n</span>) <span class="op">=></span> <span class="va">$c</span><span class="op">+</span><span class="va">$n</span><span class="op">,</span> <span class="nm">0</span>)<span class="op">;</span>
<span class="va">$col</span>     <span class="op">=</span> <span class="fn">array_column</span>(<span class="va">$users</span><span class="op">,</span> <span class="st">'name'</span>)<span class="op">;</span>

<span class="cm">// Sort</span>
<span class="fn">usort</span>(<span class="va">$users</span><span class="op">,</span> <span class="kw">fn</span>(<span class="va">$a</span><span class="op">,</span><span class="va">$b</span>) <span class="op">=></span> <span class="va">$a</span>[<span class="st">'age'</span>] <span class="op">&lt;=&gt;</span> <span class="va">$b</span>[<span class="st">'age'</span>])<span class="op">;</span>

<span class="cm">// Spread operator</span>
<span class="va">$merged</span> <span class="op">=</span> [<span class="nm">0</span><span class="op">,</span> <span class="op">...</span><span class="va">$arr</span><span class="op">,</span> <span class="nm">99</span>]<span class="op">;</span></code></pre>
</div>
PHP,

'strings' => <<<'PHP'
<div class="code-block">
<div class="code-header"><span class="code-lang">PHP</span><button class="copy-btn" onclick="copyCode(this)">copy</button></div>
<pre><code><span class="kw">&lt;?php</span>
<span class="va">$s</span> <span class="op">=</span> <span class="st">"  Hello, World!  "</span><span class="op">;</span>

<span class="fn">strlen</span>(<span class="va">$s</span>)<span class="op">;</span>                        <span class="cm">// length</span>
<span class="fn">str_contains</span>(<span class="va">$s</span><span class="op">,</span> <span class="st">'World'</span>)<span class="op">;</span>         <span class="cm">// PHP 8+</span>
<span class="fn">str_starts_with</span>(<span class="va">$s</span><span class="op">,</span> <span class="st">'Hello'</span>)<span class="op">;</span>
<span class="fn">str_ends_with</span>(<span class="va">$s</span><span class="op">,</span> <span class="st">'!'</span>)<span class="op">;</span>
<span class="fn">trim</span>(<span class="va">$s</span>)<span class="op">;</span>                           <span class="cm">// strip whitespace</span>
<span class="fn">strtolower</span>(<span class="va">$s</span>)<span class="op">;</span>
<span class="fn">str_replace</span>(<span class="st">'World'</span><span class="op">,</span> <span class="st">'PHP'</span><span class="op">,</span> <span class="va">$s</span>)<span class="op">;</span>
<span class="fn">substr</span>(<span class="va">$s</span><span class="op">,</span> <span class="nm">7</span><span class="op">,</span> <span class="nm">5</span>)<span class="op">;</span>                   <span class="cm">// "World"</span>
<span class="fn">explode</span>(<span class="st">','</span><span class="op">,</span> <span class="st">"a,b,c"</span>)<span class="op">;</span>              <span class="cm">// → array</span>
<span class="fn">implode</span>(<span class="st">'-'</span><span class="op">,</span> [<span class="st">'a'</span><span class="op">,</span><span class="st">'b'</span><span class="op">,</span><span class="st">'c'</span>])<span class="op">;</span>       <span class="cm">// "a-b-c"</span>
<span class="fn">sprintf</span>(<span class="st">"%.2f"</span><span class="op">,</span> <span class="nm">3.14159</span>)<span class="op">;</span>          <span class="cm">// "3.14"</span>
<span class="fn">number_format</span>(<span class="nm">1234567</span><span class="op">,</span> <span class="nm">2</span>)<span class="op">;</span>         <span class="cm">// "1,234,567.00"</span>

<span class="cm">// Heredoc (parses variables)</span>
<span class="va">$text</span> <span class="op">=</span> <span class="op">&lt;&lt;&lt;</span>EOT
    Name: <span class="va">$name</span>
    Multiline string here.
EOT<span class="op">;</span>

<span class="cm">// Regex (PCRE)</span>
<span class="fn">preg_match</span>(<span class="st">'/^\d{10}$/'</span><span class="op">,</span> <span class="va">$phone</span>)<span class="op">;</span>
<span class="fn">preg_match_all</span>(<span class="st">'/\b\w+\b/'</span><span class="op">,</span> <span class="va">$text</span><span class="op">,</span> <span class="va">$matches</span>)<span class="op">;</span>
<span class="fn">preg_replace</span>(<span class="st">'/\s+/'</span><span class="op">,</span> <span class="st">' '</span><span class="op">,</span> <span class="va">$text</span>)<span class="op">;</span></code></pre>
</div>
PHP,

'forms' => <<<'PHP'
<div class="code-block">
<div class="code-header"><span class="code-lang">PHP</span><button class="copy-btn" onclick="copyCode(this)">copy</button></div>
<pre><code><span class="kw">&lt;?php</span>
<span class="cm">// Superglobals</span>
<span class="va">$_GET</span><span class="op">;</span>      <span class="cm">// URL query params</span>
<span class="va">$_POST</span><span class="op">;</span>     <span class="cm">// Form POST data</span>
<span class="va">$_SERVER</span><span class="op">;</span>   <span class="cm">// Server/env info</span>
<span class="va">$_SESSION</span><span class="op">;</span>  <span class="cm">// Session data</span>
<span class="va">$_COOKIE</span><span class="op">;</span>   <span class="cm">// Cookie data</span>
<span class="va">$_FILES</span><span class="op">;</span>    <span class="cm">// Uploaded files</span>

<span class="cm">// Safe form handling</span>
<span class="kw">if</span> (<span class="va">$_SERVER</span>[<span class="st">'REQUEST_METHOD'</span>] <span class="op">===</span> <span class="st">'POST'</span>) <span class="op">{</span>
    <span class="va">$name</span>  <span class="op">=</span> <span class="fn">htmlspecialchars</span>(<span class="fn">trim</span>(<span class="va">$_POST</span>[<span class="st">'name'</span>] <span class="op">??</span> <span class="st">''</span>))<span class="op">;</span>
    <span class="va">$email</span> <span class="op">=</span> <span class="fn">filter_input</span>(<span class="cl">INPUT_POST</span><span class="op">,</span> <span class="st">'email'</span><span class="op">,</span> <span class="cl">FILTER_VALIDATE_EMAIL</span>)<span class="op">;</span>
    <span class="va">$age</span>   <span class="op">=</span> <span class="fn">filter_input</span>(<span class="cl">INPUT_POST</span><span class="op">,</span> <span class="st">'age'</span><span class="op">,</span> <span class="cl">FILTER_VALIDATE_INT</span>)<span class="op">;</span>

    <span class="kw">if</span> (<span class="va">$email</span> <span class="op">===</span> <span class="kw">false</span>) <span class="op">{</span>
        <span class="fn">echo</span> <span class="st">"Invalid email!"</span><span class="op">;</span>
    <span class="op">}</span>
<span class="op">}</span>

<span class="cm">// Sessions</span>
<span class="fn">session_start</span>()<span class="op">;</span>
<span class="va">$_SESSION</span>[<span class="st">'user_id'</span>] <span class="op">=</span> <span class="nm">42</span><span class="op">;</span>
<span class="fn">session_destroy</span>()<span class="op">;</span>

<span class="cm">// Cookies</span>
<span class="fn">setcookie</span>(<span class="st">'theme'</span><span class="op">,</span> <span class="st">'dark'</span><span class="op">,</span> <span class="fn">time</span>() <span class="op">+</span> <span class="nm">86400</span> <span class="op">*</span> <span class="nm">30</span>)<span class="op">;</span></code></pre>
</div>
<div class="info-box warn"><div class="ib-label">⚠️ Security</div>NEVER echo raw <code>$_GET</code> or <code>$_POST</code> — always sanitize with <code>htmlspecialchars()</code> first. Use <code>filter_input()</code> to validate types.</div>
PHP,

'files' => <<<'PHP'
<div class="code-block">
<div class="code-header"><span class="code-lang">PHP</span><button class="copy-btn" onclick="copyCode(this)">copy</button></div>
<pre><code><span class="kw">&lt;?php</span>
<span class="cm">// Read entire file</span>
<span class="va">$content</span> <span class="op">=</span> <span class="fn">file_get_contents</span>(<span class="st">'data.txt'</span>)<span class="op">;</span>

<span class="cm">// Write / overwrite</span>
<span class="fn">file_put_contents</span>(<span class="st">'log.txt'</span><span class="op">,</span> <span class="st">"Entry\n"</span>)<span class="op">;</span>

<span class="cm">// Append</span>
<span class="fn">file_put_contents</span>(<span class="st">'log.txt'</span><span class="op">,</span> <span class="st">"New line\n"</span><span class="op">,</span> <span class="cl">FILE_APPEND</span>)<span class="op">;</span>

<span class="cm">// Read lines into array</span>
<span class="va">$lines</span> <span class="op">=</span> <span class="fn">file</span>(<span class="st">'data.txt'</span><span class="op">,</span> <span class="cl">FILE_IGNORE_NEW_LINES</span>)<span class="op">;</span>

<span class="cm">// File info</span>
<span class="fn">file_exists</span>(<span class="st">'file.txt'</span>)<span class="op">;</span>
<span class="fn">is_file</span>(<span class="st">'file.txt'</span>)<span class="op">;</span>
<span class="fn">filesize</span>(<span class="st">'image.jpg'</span>)<span class="op">;</span>
<span class="fn">pathinfo</span>(<span class="st">'/path/to/file.txt'</span>)<span class="op">;</span>  <span class="cm">// dirname, basename, ext</span>

<span class="cm">// Directory operations</span>
<span class="fn">mkdir</span>(<span class="st">'uploads'</span><span class="op">,</span> <span class="nm">0755</span><span class="op">,</span> <span class="kw">true</span>)<span class="op">;</span>  <span class="cm">// recursive</span>
<span class="fn">scandir</span>(<span class="st">'.'</span>)<span class="op">;</span>
<span class="fn">glob</span>(<span class="st">'*.php'</span>)<span class="op">;</span>
<span class="fn">rename</span>(<span class="st">'old.txt'</span><span class="op">,</span> <span class="st">'new.txt'</span>)<span class="op">;</span>
<span class="fn">unlink</span>(<span class="st">'temp.txt'</span>)<span class="op">;</span>           <span class="cm">// delete</span>
<span class="fn">copy</span>(<span class="st">'src.txt'</span><span class="op">,</span> <span class="st">'dst.txt'</span>)<span class="op">;</span></code></pre>
</div>
PHP,

'oop' => <<<'PHP'
<div class="code-block">
<div class="code-header"><span class="code-lang">PHP</span><button class="copy-btn" onclick="copyCode(this)">copy</button></div>
<pre><code><span class="kw">&lt;?php</span>
<span class="cm">// Constructor promotion (PHP 8) — declares AND assigns in one shot</span>
<span class="kw">class</span> <span class="cl">User</span> <span class="op">{</span>
    <span class="kw">public function</span> <span class="fn">__construct</span>(
        <span class="kw">private readonly</span> <span class="kw">int</span>    <span class="va">$id</span><span class="op">,</span>
        <span class="kw">private</span>          <span class="kw">string</span> <span class="va">$name</span><span class="op">,</span>
        <span class="kw">private</span>          <span class="kw">string</span> <span class="va">$role</span> <span class="op">=</span> <span class="st">'user'</span>
    ) <span class="op">{}</span>

    <span class="kw">public function</span> <span class="fn">getName</span>()<span class="op">:</span> <span class="kw">string</span> <span class="op">{</span>
        <span class="kw">return</span> <span class="va">$this</span><span class="op">-></span><span class="va">name</span><span class="op">;</span>
    <span class="op">}</span>
    <span class="kw">public function</span> <span class="fn">isAdmin</span>()<span class="op">:</span> <span class="kw">bool</span> <span class="op">{</span>
        <span class="kw">return</span> <span class="va">$this</span><span class="op">-></span><span class="va">role</span> <span class="op">===</span> <span class="st">'admin'</span><span class="op">;</span>
    <span class="op">}</span>
<span class="op">}</span>

<span class="cm">// Interface</span>
<span class="kw">interface</span> <span class="cl">Authenticatable</span> <span class="op">{</span>
    <span class="kw">public function</span> <span class="fn">login</span>(<span class="kw">string</span> <span class="va">$pass</span>)<span class="op">:</span> <span class="kw">bool</span><span class="op">;</span>
<span class="op">}</span>

<span class="cm">// Trait (reusable mixin)</span>
<span class="kw">trait</span> <span class="cl">HasTimestamps</span> <span class="op">{</span>
    <span class="kw">public function</span> <span class="fn">createdAt</span>()<span class="op">:</span> <span class="kw">string</span> <span class="op">{</span>
        <span class="kw">return</span> <span class="fn">date</span>(<span class="st">'Y-m-d H:i:s'</span>)<span class="op">;</span>
    <span class="op">}</span>
<span class="op">}</span>

<span class="cm">// Enum (PHP 8.1)</span>
<span class="kw">enum</span> <span class="cl">Status</span><span class="op">:</span> <span class="kw">string</span> <span class="op">{</span>
    <span class="kw">case</span> <span class="cl">Active</span>   <span class="op">=</span> <span class="st">'active'</span><span class="op">;</span>
    <span class="kw">case</span> <span class="cl">Inactive</span> <span class="op">=</span> <span class="st">'inactive'</span><span class="op">;</span>
<span class="op">}</span>
<span class="fn">echo</span> <span class="cl">Status</span><span class="op">::</span><span class="cl">Active</span><span class="op">-></span>value<span class="op">;</span>  <span class="cm">// 'active'</span></code></pre>
</div>
PHP,

'errors' => <<<'PHP'
<div class="code-block">
<div class="code-header"><span class="code-lang">PHP</span><button class="copy-btn" onclick="copyCode(this)">copy</button></div>
<pre><code><span class="kw">&lt;?php</span>
<span class="cm">// try / catch / finally</span>
<span class="kw">try</span> <span class="op">{</span>
    <span class="va">$result</span> <span class="op">=</span> <span class="fn">riskyOperation</span>()<span class="op">;</span>
<span class="op">}</span> <span class="kw">catch</span> (<span class="cl">InvalidArgumentException</span> <span class="va">$e</span>) <span class="op">{</span>
    <span class="fn">echo</span> <span class="st">"Invalid: "</span> <span class="op">.</span> <span class="va">$e</span><span class="op">-></span><span class="fn">getMessage</span>()<span class="op">;</span>
<span class="op">}</span> <span class="kw">catch</span> (<span class="cl">Throwable</span> <span class="va">$t</span>) <span class="op">{</span>
    <span class="fn">error_log</span>(<span class="va">$t</span><span class="op">-></span><span class="fn">getMessage</span>())<span class="op">;</span>
<span class="op">}</span> <span class="kw">finally</span> <span class="op">{</span>
    <span class="cm">// Always runs (cleanup, close DB, etc.)</span>
<span class="op">}</span>

<span class="cm">// Custom exception</span>
<span class="kw">class</span> <span class="cl">ValidationException</span> <span class="kw">extends</span> <span class="cl">RuntimeException</span> <span class="op">{</span>
    <span class="kw">public function</span> <span class="fn">__construct</span>(
        <span class="kw">private readonly</span> <span class="kw">array</span> <span class="va">$errors</span><span class="op">,</span>
        <span class="kw">string</span> <span class="va">$message</span> <span class="op">=</span> <span class="st">'Validation failed'</span>
    ) <span class="op">{</span>
        <span class="kw">parent</span><span class="op">::</span><span class="fn">__construct</span>(<span class="va">$message</span>)<span class="op">;</span>
    <span class="op">}</span>
    <span class="kw">public function</span> <span class="fn">getErrors</span>()<span class="op">:</span> <span class="kw">array</span> <span class="op">{</span>
        <span class="kw">return</span> <span class="va">$this</span><span class="op">-></span><span class="va">errors</span><span class="op">;</span>
    <span class="op">}</span>
<span class="op">}</span>

<span class="cm">// Global handler</span>
<span class="fn">set_exception_handler</span>(<span class="kw">function</span>(<span class="cl">Throwable</span> <span class="va">$e</span>) <span class="op">{</span>
    <span class="fn">http_response_code</span>(<span class="nm">500</span>)<span class="op">;</span>
    <span class="fn">echo</span> <span class="fn">json_encode</span>([<span class="st">'error'</span> <span class="op">=></span> <span class="va">$e</span><span class="op">-></span><span class="fn">getMessage</span>()])<span class="op">;</span>
<span class="op">})</span><span class="op">;</span></code></pre>
</div>
PHP,

'db' => <<<'PHP'
<div class="code-block">
<div class="code-header"><span class="code-lang">PHP</span><button class="copy-btn" onclick="copyCode(this)">copy</button></div>
<pre><code><span class="kw">&lt;?php</span>
<span class="cm">// PDO connection</span>
<span class="va">$dsn</span> <span class="op">=</span> <span class="st">"mysql:host=localhost;dbname=myapp;charset=utf8mb4"</span><span class="op">;</span>
<span class="va">$pdo</span> <span class="op">=</span> <span class="kw">new</span> <span class="cl">PDO</span>(<span class="va">$dsn</span><span class="op">,</span> <span class="st">'root'</span><span class="op">,</span> <span class="st">'password'</span><span class="op">,</span> [
    <span class="cl">PDO</span><span class="op">::</span><span class="cl">ATTR_ERRMODE</span>            <span class="op">=></span> <span class="cl">PDO</span><span class="op">::</span><span class="cl">ERRMODE_EXCEPTION</span><span class="op">,</span>
    <span class="cl">PDO</span><span class="op">::</span><span class="cl">ATTR_DEFAULT_FETCH_MODE</span> <span class="op">=></span> <span class="cl">PDO</span><span class="op">::</span><span class="cl">FETCH_ASSOC</span><span class="op">,</span>
    <span class="cl">PDO</span><span class="op">::</span><span class="cl">ATTR_EMULATE_PREPARES</span>   <span class="op">=></span> <span class="kw">false</span><span class="op">,</span>
])<span class="op">;</span>

<span class="cm">// SELECT — always use prepared statements</span>
<span class="va">$stmt</span> <span class="op">=</span> <span class="va">$pdo</span><span class="op">-></span><span class="fn">prepare</span>(<span class="st">"SELECT * FROM users WHERE email = :email"</span>)<span class="op">;</span>
<span class="va">$stmt</span><span class="op">-></span><span class="fn">execute</span>([<span class="st">'email'</span> <span class="op">=></span> <span class="va">$email</span>])<span class="op">;</span>
<span class="va">$user</span>  <span class="op">=</span> <span class="va">$stmt</span><span class="op">-></span><span class="fn">fetch</span>()<span class="op">;</span>
<span class="va">$users</span> <span class="op">=</span> <span class="va">$stmt</span><span class="op">-></span><span class="fn">fetchAll</span>()<span class="op">;</span>

<span class="cm">// INSERT</span>
<span class="va">$stmt</span> <span class="op">=</span> <span class="va">$pdo</span><span class="op">-></span><span class="fn">prepare</span>(<span class="st">"INSERT INTO users (name, email) VALUES (:name, :email)"</span>)<span class="op">;</span>
<span class="va">$stmt</span><span class="op">-></span><span class="fn">execute</span>([<span class="st">'name'</span> <span class="op">=></span> <span class="va">$name</span><span class="op">,</span> <span class="st">'email'</span> <span class="op">=></span> <span class="va">$email</span>])<span class="op">;</span>
<span class="va">$id</span> <span class="op">=</span> <span class="va">$pdo</span><span class="op">-></span><span class="fn">lastInsertId</span>()<span class="op">;</span>

<span class="cm">// Transaction</span>
<span class="va">$pdo</span><span class="op">-></span><span class="fn">beginTransaction</span>()<span class="op">;</span>
<span class="kw">try</span> <span class="op">{</span>
    <span class="va">$pdo</span><span class="op">-></span><span class="fn">prepare</span>(<span class="st">"UPDATE accounts SET balance=balance-? WHERE id=?"</span>)
        <span class="op">-></span><span class="fn">execute</span>([<span class="nm">100</span><span class="op">,</span> <span class="va">$from</span>])<span class="op">;</span>
    <span class="va">$pdo</span><span class="op">-></span><span class="fn">commit</span>()<span class="op">;</span>
<span class="op">}</span> <span class="kw">catch</span> (<span class="cl">Exception</span> <span class="va">$e</span>) <span class="op">{</span>
    <span class="va">$pdo</span><span class="op">-></span><span class="fn">rollBack</span>()<span class="op">;</span>
<span class="op">}</span></code></pre>
</div>
<div class="info-box warn"><div class="ib-label">⚠️ NEVER do this</div><code>$pdo->query("SELECT * FROM users WHERE id=" . $_GET['id'])</code> — direct SQL injection vulnerability. Always use <code>prepare() + execute()</code> with bound params.</div>
PHP,

    ];

    return $contents[$topic] ?? '<p class="theory-text">Topic not found.</p>';
}

function get_examples(): array {
    return [
        ['title' => 'Hello World',           'level' => 'Basics',        'desc' => 'Variables, echo, string interpolation',
         'code' => '<?php
$name = "World";
echo "Hello, $name!\n";
echo "PHP " . PHP_VERSION . " running on " . PHP_OS . "\n";
$pi = M_PI;
printf("Pi is approximately %.4f\n", $pi);'],

        ['title' => 'FizzBuzz',              'level' => 'Basics',        'desc' => 'Classic loop with conditionals',
         'code' => '<?php
for ($i = 1; $i <= 20; $i++) {
    echo match(true) {
        $i % 15 === 0 => "FizzBuzz",
        $i % 3  === 0 => "Fizz",
        $i % 5  === 0 => "Buzz",
        default        => (string)$i,
    } . "\n";
}'],

        ['title' => 'Array Operations',       'level' => 'Basics',        'desc' => 'filter, map, reduce, sort',
         'code' => '<?php
$users = [
    ["name" => "Alice", "age" => 28],
    ["name" => "Bob",   "age" => 16],
    ["name" => "Carol", "age" => 34],
];

$adults = array_filter($users, fn($u) => $u["age"] >= 18);
$names  = array_column(array_values($adults), "name");
usort($adults, fn($a, $b) => $a["age"] <=> $b["age"]);

echo "Adults: " . implode(", ", $names) . "\n";
foreach ($adults as $u) {
    echo "  {$u[\'name\']} — {$u[\'age\']}\n";
}'],

        ['title' => 'OOP Bank Account',       'level' => 'Intermediate',  'desc' => 'Class, readonly, encapsulation',
         'code' => '<?php
class BankAccount {
    private float $balance;
    private array $log = [];

    public function __construct(
        public readonly string $owner,
        float $initial = 0.0
    ) {
        $this->balance = $initial;
    }

    public function deposit(float $amt): void {
        $this->balance += $amt;
        $this->log[] = "+{$amt}";
    }

    public function withdraw(float $amt): bool {
        if ($amt > $this->balance) return false;
        $this->balance -= $amt;
        $this->log[] = "-{$amt}";
        return true;
    }

    public function summary(): string {
        return "{$this->owner}: ₹{$this->balance} | " . implode(", ", $this->log);
    }
}

$acc = new BankAccount("Nishu", 1000.0);
$acc->deposit(500);
$acc->withdraw(200);
echo $acc->summary();'],

        ['title' => 'Regex Email Finder',     'level' => 'Intermediate',  'desc' => 'preg_match_all, validation',
         'code' => '<?php
$text = "Contact info@example.com or support@phpforge.dev for help.";

preg_match_all(
    \'/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/\',
    $text,
    $matches
);

echo "Emails found:\n";
foreach ($matches[0] as $email) {
    echo "  ✓ $email\n";
}

$phones = ["9876543210", "123", "+91-98765"];
foreach ($phones as $p) {
    $ok = preg_match(\'/^\d{10}$/\', $p) ? "valid" : "invalid";
    echo "$p → $ok\n";
}'],

        ['title' => 'JSON API Response',      'level' => 'Intermediate',  'desc' => 'REST response pattern',
         'code' => '<?php
header("Content-Type: application/json");

function apiResponse(array $data, int $code = 200, string $msg = "OK"): void {
    http_response_code($code);
    echo json_encode([
        "status"  => $code,
        "message" => $msg,
        "data"    => $data,
        "ts"      => time(),
    ], JSON_PRETTY_PRINT);
    exit;
}

$users = [
    ["id" => 1, "name" => "Nishu", "role" => "admin"],
    ["id" => 2, "name" => "Alice", "role" => "user"],
];

apiResponse($users);'],

        ['title' => 'Password Hashing',       'level' => 'Advanced',      'desc' => 'Secure bcrypt with verify',
         'code' => '<?php
$password = "MySecret@123";

// Hash with bcrypt cost 12
$hash = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);
echo "Hash: $hash\n\n";

// Verify
$attempts = [$password, "WrongPass", "MySecret@123"];
foreach ($attempts as $attempt) {
    $ok = password_verify($attempt, $hash) ? "✓ VALID" : "✗ WRONG";
    echo "\"$attempt\" → $ok\n";
}

// Check if rehash needed
if (password_needs_rehash($hash, PASSWORD_BCRYPT, ["cost" => 14])) {
    echo "\nRehash recommended for higher security";
}'],

        ['title' => 'PDO Repository Pattern', 'level' => 'Advanced',      'desc' => 'Prepared statements, CRUD',
         'code' => '<?php
class UserRepository {
    public function __construct(private PDO $pdo) {}

    public function findById(int $id): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function create(string $name, string $email): int {
        $stmt = $this->pdo->prepare(
            "INSERT INTO users (name, email, created_at) VALUES (?, ?, NOW())"
        );
        $stmt->execute([$name, $email]);
        return (int)$this->pdo->lastInsertId();
    }

    public function findAll(int $limit = 20): array {
        $stmt = $this->pdo->prepare(
            "SELECT id, name, email FROM users ORDER BY created_at DESC LIMIT ?"
        );
        $stmt->execute([$limit]);
        return $stmt->fetchAll();
    }
}

// $repo = new UserRepository($pdo);
// $user = $repo->findById(1);'],
    ];
}

function get_quiz_categories(): array {
    return [
        'basics'   => 'Basics',
        'types'    => 'Types & Operators',
        'arrays'   => 'Arrays',
        'oop'      => 'OOP & PHP 8',
        'security' => 'Security',
    ];
}

function get_quiz_questions(): array {
    return [
        'basics' => [
            ['q' => 'What symbol starts every PHP variable?',
             'opts' => ['#', '$', '@', '&'], 'a' => 1,
             'exp' => 'PHP variables always start with <code>$</code>, e.g. <code>$name = "PHP";</code>'],
            ['q' => 'Which tag correctly opens a PHP block?',
             'opts' => ['<%php', '<?php', '&lt;php', '#!php'], 'a' => 1,
             'exp' => '<code>&lt;?php</code> opens PHP. Use <code>&lt;?=</code> as shorthand for echo.'],
            ['q' => 'What does <code>echo</code> do?',
             'opts' => ['Declares a variable', 'Outputs text to browser', 'Creates a loop', 'Imports a file'], 'a' => 1,
             'exp' => '<code>echo</code> outputs one or more strings. Slightly faster than <code>print</code>.'],
            ['q' => 'How do you define a constant in PHP?',
             'opts' => ['$CONST = 1', 'const NAME = 1', 'var NAME = 1', 'let NAME = 1'], 'a' => 1,
             'exp' => 'Use <code>const NAME = 1;</code> at class or file scope, or <code>define("NAME", 1);</code>'],
            ['q' => 'What does <code>var_dump(true)</code> output?',
             'opts' => ['true', '1', 'bool(true)', 'boolean(true)'], 'a' => 2,
             'exp' => '<code>var_dump()</code> shows type + value: <code>bool(true)</code>'],
        ],
        'types' => [
            ['q' => 'What is the result of <code>"5" + 3</code> in PHP?',
             'opts' => ['Error', '"53"', '8', '"8"'], 'a' => 2,
             'exp' => 'PHP coerces <code>"5"</code> to integer <code>5</code>, so result is <code>8</code>.'],
            ['q' => 'Which comparison operator is STRICT in PHP?',
             'opts' => ['==', '!=', '===', '<>'], 'a' => 2,
             'exp' => '<code>===</code> checks value AND type. <code>0 == "foo"</code> is false in PHP 8 (fixed), but always use <code>===</code>.'],
            ['q' => 'What does the <code>??</code> operator do?',
             'opts' => ['Divides by 2', 'Returns left if set & not null, else right', 'Negates boolean', 'Power'], 'a' => 1,
             'exp' => 'Null coalescing: <code>$a ?? $b</code> returns <code>$a</code> if it exists and is not null.'],
            ['q' => 'PHP 8 spaceship <code>&lt;=&gt;</code> returns:',
             'opts' => ['true/false', '-1, 0, or 1', 'min of two', 'string comparison'], 'a' => 1,
             'exp' => '<code>$a &lt;=&gt; $b</code>: -1 if a&lt;b, 0 if equal, 1 if a&gt;b. Ideal for <code>usort</code>.'],
            ['q' => 'What does <code>gettype([1,2,3])</code> return?',
             'opts' => ['"array"', '"list"', '"object"', '"collection"'], 'a' => 0,
             'exp' => '<code>gettype()</code> returns <code>"array"</code> for all PHP arrays.'],
        ],
        'arrays' => [
            ['q' => 'Which function removes the LAST element of an array?',
             'opts' => ['array_shift()', 'array_pop()', 'array_splice()', 'array_remove()'], 'a' => 1,
             'exp' => '<code>array_pop()</code> removes & returns the last element. <code>array_shift()</code> removes the first.'],
            ['q' => 'What does <code>array_map(fn($n) => $n*2, [1,2,3])</code> return?',
             'opts' => ['6', '[2,4,6]', '[1,2,3,2,4,6]', 'Error'], 'a' => 1,
             'exp' => '<code>array_map()</code> applies callback to every element, returns new array: <code>[2,4,6]</code>.'],
            ['q' => 'Best way to check if key "name" exists in <code>$arr</code>?',
             'opts' => ['isset($arr["name"])', 'in_array("name", $arr)', 'array_key_exists("name", $arr)', 'Both A and C'], 'a' => 3,
             'exp' => 'Both work, but <code>isset()</code> returns false for null values while <code>array_key_exists()</code> returns true.'],
            ['q' => 'What does the spread operator <code>...$arr</code> do?',
             'opts' => ['Creates a copy', 'Unpacks array into arguments/array', 'Sorts it', 'Reverses it'], 'a' => 1,
             'exp' => 'Spread unpacks: <code>[0, ...$arr, 99]</code> or <code>func(...$args)</code>'],
        ],
        'oop' => [
            ['q' => 'What does <code>readonly</code> mean on a property (PHP 8.1)?',
             'opts' => ['Admin-only access', 'Set once in constructor, then immutable', 'Cannot be accessed outside class', 'Always public'], 'a' => 1,
             'exp' => '<code>readonly</code> properties can only be initialised once. Any subsequent write throws an error.'],
            ['q' => 'What is a PHP <code>trait</code>?',
             'opts' => ['Same as interface', 'Reusable code mixed into classes', 'Abstract base class', 'Static-only class'], 'a' => 1,
             'exp' => 'Traits add reusable methods to classes via <code>use TraitName</code>, solving single-inheritance limits.'],
            ['q' => '<code>match</code> vs <code>switch</code>: which uses strict comparison?',
             'opts' => ['switch', 'match', 'Both', 'Neither'], 'a' => 1,
             'exp' => '<code>match</code> uses <code>===</code>. <code>switch</code> uses loose <code>==</code>. Also: <code>match</code> returns a value, no fall-through.'],
            ['q' => 'PHP 8.1 backed Enum: what does <code>Status::Active->value</code> return?',
             'opts' => ['true', 'The backing scalar', 'The name "Active"', 'An array'], 'a' => 1,
             'exp' => 'Backed enums have <code>->value</code> returning the scalar: <code>case Active = "active"</code> → <code>"active"</code>.'],
        ],
        'security' => [
            ['q' => 'Best way to prevent SQL injection in PHP?',
             'opts' => ['str_replace() on input', 'PDO prepared statements', 'mysql_real_escape_string()', 'Validate input length'], 'a' => 1,
             'exp' => 'Always use <code>PDO::prepare()</code> + <code>execute()</code>. Separates SQL from data — injection impossible.'],
            ['q' => 'Which function prevents XSS when outputting to HTML?',
             'opts' => ['strip_tags()', 'htmlspecialchars()', 'sanitize()', 'htmlclean()'], 'a' => 1,
             'exp' => '<code>htmlspecialchars()</code> converts <code>&lt;</code>, <code>&gt;</code>, <code>&amp;</code>, <code>"</code> to safe HTML entities.'],
            ['q' => 'How should passwords be stored in PHP?',
             'opts' => ['md5($pass)', 'sha256($pass)', 'password_hash($pass, PASSWORD_BCRYPT)', 'base64_encode($pass)'], 'a' => 2,
             'exp' => 'Use <code>password_hash()</code> with bcrypt. MD5/SHA1 are far too fast — vulnerable to brute force.'],
            ['q' => 'What does <code>filter_input(INPUT_POST, "age", FILTER_VALIDATE_INT)</code> return for non-integer input?',
             'opts' => ['0', 'null', 'false', 'An exception'], 'a' => 2,
             'exp' => '<code>filter_input()</code> returns <code>false</code> if validation fails, <code>null</code> if variable is absent.'],
        ],
    ];
}

function get_cheatsheets(): array {
    return [
        ['title' => '📌 PHP Tags & Output', 'code' =>
'<?php echo "text"; ?>
<?= "shorthand echo" ?>
print "hello";
printf("%.2f", 3.14);
var_dump($x);    // type + value
print_r($arr);   // readable array
$x = sprintf("%.2f", 1.5); // return string'],

        ['title' => '📦 String Functions', 'code' =>
'strlen($s)              // length
strtolower / strtoupper
str_contains($s, $q)    // PHP 8
str_starts_with / str_ends_with
str_replace($f, $r, $s)
substr($s, $start, $len)
strpos($s, $needle)
trim / ltrim / rtrim
explode(",", $s) → array
implode(",", $arr) → string
sprintf("%.2f", 3.14)
number_format(1234.5, 2)'],

        ['title' => '📚 Array Functions', 'code' =>
'count($a)
array_push($a, $v) / $a[] = $v
array_pop / array_shift / array_unshift
array_merge($a, $b)
array_slice($a, $s, $l)
array_map($fn, $a)
array_filter($a, $fn)
array_reduce($a, $fn, $init)
array_search($val, $a)
in_array($val, $a, true)
array_unique / array_flip
array_column($arr, "name")
sort / rsort / usort / uksort'],

        ['title' => '🔢 Math', 'code' =>
'abs / round / ceil / floor
max / min / rand($min, $max)
pow(2, 8)   // 256
sqrt(144)   // 12
fmod(10, 3) // 1.0
intdiv(7, 2) // 3
number_format(1234.5, 2)
M_PI   M_E   PHP_INT_MAX'],

        ['title' => '📅 Date & Time', 'code' =>
'date("Y-m-d")         // "2024-03-15"
date("H:i:s")         // "14:30:00"
time()                // Unix timestamp
strtotime("next monday")
new DateTime("now")
$dt->format("Y-m-d H:i")
$dt->modify("+1 week")
date_diff($d1, $d2)->days'],

        ['title' => '🌐 HTTP & Headers', 'code' =>
'header("Location: /page.php");
header("Content-Type: application/json");
http_response_code(404);
setcookie("name","val",time()+3600);
$_SERVER["REQUEST_METHOD"]
$_SERVER["REQUEST_URI"]
$_SERVER["HTTP_HOST"]
$_SERVER["REMOTE_ADDR"]'],

        ['title' => '🛡️ Security', 'code' =>
'htmlspecialchars($s, ENT_QUOTES, "UTF-8")
strip_tags($html)
filter_input(INPUT_POST, "k", FILTER_VALIDATE_EMAIL)
password_hash($p, PASSWORD_BCRYPT)
password_verify($p, $hash)
bin2hex(random_bytes(32)) // CSRF token
hash("sha256", $data)'],

        ['title' => '🗄️ PDO Quick Ref', 'code' =>
'$pdo = new PDO($dsn, $u, $p, $opts);
$stmt = $pdo->prepare("SELECT...");
$stmt->execute([$val]);
$row  = $stmt->fetch();
$rows = $stmt->fetchAll();
$pdo->lastInsertId();
$stmt->rowCount();
$pdo->beginTransaction();
$pdo->commit();
$pdo->rollBack();'],

        ['title' => '🏗️ OOP Patterns', 'code' =>
'// Constructor promotion (PHP 8)
class User {
  public function __construct(
    private readonly int $id,
    private string $name
  ) {}
}

// Enum (PHP 8.1)
enum Status: string {
  case Active   = "active";
  case Inactive = "inactive";
}'],

        ['title' => '⚡ PHP 8 Features', 'code' =>
'// Named arguments
array_slice(arr: $a, offset: 2);

// Nullsafe operator
$city = $user?->address?->city;

// Match expression
$r = match($n) {
  1, 2 => "low",
  3    => "mid",
  default => "high",
};

// Union types
function f(int|string $v): void {}'],

        ['title' => '📂 File Quick Ref', 'code' =>
'file_get_contents($path)
file_put_contents($p, $data)
file_put_contents($p, $d, FILE_APPEND)
file($p, FILE_IGNORE_NEW_LINES)
file_exists($p)
filesize($p) / filemtime($p)
pathinfo($p)  // dir/base/ext
mkdir($p, 0755, true)
scandir($dir)
glob("*.php")
unlink($file)'],
    ];
}
