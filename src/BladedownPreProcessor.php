<?php

declare(strict_types=1);

namespace Hyde\Bladedown;

/**
 * Handles preprocessing logic for the Bladedown compiler.
 *
 * @see \Hyde\Bladedown\BladedownCompiler
 */
class BladedownPreProcessor
{
    public static function process(string $markdown): array
    {
        [$markdown, $blocks] = static::processEchoBlocks($markdown);

        return [$markdown, $blocks];
    }

    // Replace Echo syntax {{ $variable }} with placeholders
    protected static function processEchoBlocks(string $markdown): array
    {
        if (preg_match_all('/\{\{.*?\}\}/s', $markdown, $matches)) {
            foreach ($matches[0] as $match) {
                $placeholder = static::makePlaceholder('Echo', $match);
                $blocks[$placeholder] = $match;
                $markdown = str_replace($match, $placeholder, $markdown);
            }
        }

        return [$markdown, $blocks ?? []];
    }

    protected static function makePlaceholder(string $component, string $content): string
    {
        return sprintf('<!-- HydeBladedown[%s]%s -->', $component, sha1("$component-$content"));
    }
}
