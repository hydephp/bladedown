#!/usr/bin/env php
<?php

$strings = [
    'Bladedown Test Page',
    'Hello, World!',
    'Example component was called with no message',
    'Example component was called with custom message',
    'Example component with slot content',
    '<strong>Custom title slot</strong>',
    '<div class=\"custom\">Custom body slot with title</div>',
    '<blockquote class=\"my-0\" style=\"border-color: rebeccapurple\">',
    'Component with custom <abbr title=\"HyperText Markup Language\">HTML</abbr> slot content"',
];

$strings = implode(' ', array_map(function ($string) {
    return escapeshellarg($string);
}, $strings));

$assertions = [
    "file_exists_and_is_not_empty('hyde/_site/index.html')",
    "file_contains('hyde/_site/index.html', $strings)",
];

// Add assertions to argv
$argv = array_merge([__FILE__], $assertions);

require __DIR__.'/assert.php';
