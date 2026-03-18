<?php
declare(strict_types=1);

function h(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function active_page(string $page, string $current): string {
    return $page === $current ? ' active' : '';
}

function active_topic(string $topic, string $current): string {
    return $topic === $current ? ' active' : '';
}

function url(string $page, string $topic = ''): string {
    $q = '/?page=' . urlencode($page);
    if ($topic) $q .= '&topic=' . urlencode($topic);
    return $q;
}

function level_class(string $level): string {
    return match($level) {
        'Intermediate' => 'inter',
        'Advanced'     => 'adv',
        default        => '',
    };
}
