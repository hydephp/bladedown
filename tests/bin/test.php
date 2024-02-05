#!/usr/bin/env php
<?php

$assertions = [
    "file_exists_and_is_not_empty('hyde/_site/index.html')",
    "file_contains('hyde/_site/index.html', 'Bladedown Test Page')",
    "file_contains('hyde/_site/index.html', 'Hello, World!')",
    "file_contains('hyde/_site/index.html', 'Example component was called with no message')",
    "file_contains('hyde/_site/index.html', 'Example component was called with custom message')",
    "file_contains('hyde/_site/index.html', 'Example component with slot content')",
];

// Add assertions to argv
$argv = array_merge([__FILE__], $assertions);

require __DIR__.'/assert.php';
