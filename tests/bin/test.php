#!/usr/bin/env php
<?php

$strings = [
    'Bladedown Test Page',
    'Hello, World!',
    'Example component was called with no message',
    'Example component was called with custom message',
    'Example component with slot content',
    '<strong>Custom title slot</strong>',
    '<div class="custom">Custom body slot with title</div>',
    '<blockquote class="my-0" style="border-color: rebeccapurple">',
    'Component with custom <abbr title="HyperText Markup Language">HTML</abbr> slot content"',
];

$file = file_get_contents('hyde/_site/index.html');

foreach ($strings as $string) {
    if (str_contains($file, $string)) {
        echo "✔ '$string' found in index.html\n";
    } else {
        echo "❌ '$string' not found in index.html\n";
        exit(1);
    }
}
