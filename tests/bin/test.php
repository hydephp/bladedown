#!/usr/bin/env php
<?php

function testFileContainsExpectedStrings(string $file, array $strings): void
{
    $file = file_get_contents($file);

    foreach ($strings as $string) {
        if (str_contains($file, $string)) {
            echo "✔ '$string' found in index.html\n";
        } else {
            echo "❌ '$string' not found in index.html\n";
            exit(1);
        }
    }
}

testFileContainsExpectedStrings(('hyde/_site/index.html'), [
    'Bladedown Test Page',
    'Hello, World!',

    'Example component was called with no message',
    'Example component was called with custom message',
    'Example component with slot content',
    '<strong>Custom title slot</strong>',
    '<div class="custom">Custom body slot with title</div>',
    '<blockquote class="my-0" style="border-color: rebeccapurple">',
    'Component with custom <abbr title="HyperText Markup Language">HTML</abbr> slot content',

    'Example include was called with no message',
    'Example include was called with custom message',
    'Example include with slot content',
    '<strong>Custom included title slot</strong>',
    '<div class="custom">Custom included body slot with title</div>',
    '<blockquote class="my-0" style="border-color: cornflowerblue">',
    'Include with custom <abbr title="HyperText Markup Language">HTML</abbr> slot content',
]);
