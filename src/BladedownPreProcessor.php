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
    protected string $markdown;
    protected array $blocks;

    protected function __construct(string $markdown)
    {
        $this->markdown = $markdown;
        $this->blocks = [];
    }

    public static function process(string $markdown): static
    {
        $processor = new static($markdown);

        $processor->markdown = $processor->processEchoBlocks($processor->markdown);

        return $processor;
    }

    // Replace Echo syntax {{ $variable }} with placeholders
    protected function processEchoBlocks(string $markdown): string
    {
        if (preg_match_all('/\{\{.*?\}\}/s', $markdown, $matches)) {
            foreach ($matches[0] as $match) {
                $placeholder = $this->makePlaceholder('Echo', $match);
                $this->blocks[$placeholder] = $match;
                $markdown = str_replace($match, $placeholder, $markdown);
            }
        }

        return $markdown;
    }

    protected function makePlaceholder(string $component, string $content): string
    {
        return sprintf('<!-- HydeBladedown[%s]%s -->', $component, sha1("$component-$content"));
    }

    public function getMarkdown(): string
    {
        return $this->markdown;
    }

    public function getBlocks(): array
    {
        return $this->blocks;
    }
}
