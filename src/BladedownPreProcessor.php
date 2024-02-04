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

        $processor->processEchoBlocks();

        return $processor;
    }

    // Replace Echo syntax {{ $variable }} with placeholders
    protected function processEchoBlocks(): void
    {
        if (preg_match_all('/\{\{.*?\}\}/s', $this->markdown, $matches)) {
            foreach ($matches[0] as $match) {
                $placeholder = $this->makePlaceholder('Echo', $match);
                $this->blocks[$placeholder] = $match;
                $this->markdown = str_replace($match, $placeholder, $this->markdown);
            }
        }
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
