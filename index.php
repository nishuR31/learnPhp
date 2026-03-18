<?php
declare(strict_types=1);

// Simple front controller
$page = $_GET['page'] ?? 'home';
$allowed = ['home', 'theory', 'examples', 'quiz', 'cheatsheet', 'playground'];
if (!in_array($page, $allowed, true)) $page = 'home';

$topic = $_GET['topic'] ?? 'intro';

require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/layout.php';

render_page($page, $topic);
