<?php
$sections = [];
$stacks = [];

function section($name) {
    global $sections;
    if (isset($sections[$name])) {
        throw new Exception("Section '$name' already defined!");
    }
    ob_start();
    $sections[$name] = null; // Mark as started
}

function endsection() {
    global $sections;
    $content = ob_get_clean();
    $last_section = array_key_last($sections);
    $sections[$last_section] = $content;
}

function yields($name) {
    global $sections;
    echo $sections[$name] ?? '';
}

function render($name, $default = '') {
    global $sections;
    echo $sections[$name] ?? $default;
}

// 👇 Tambahan untuk push/stack
function push($name) {
    ob_start();
    global $stacks;
    if (!isset($stacks[$name])) {
        $stacks[$name] = [];
    }
}

function endpush($name) {
    global $stacks;
    $content = ob_get_clean();
    $stacks[$name][] = $content;
}

function stack($name) {
    global $stacks;
    if (!isset($stacks[$name])) return;
    foreach ($stacks[$name] as $content) {
        echo $content;
    }
}
