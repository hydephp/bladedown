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
        $processor->processComponentBlocks();

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

    // Replace multiline Blade @components with placeholders
    protected function processComponentBlocks(): void
    {
        $lines = explode("\n", $this->markdown);

        $processedLines = [];

        $inComponent = false;
        $componentLineBuffer = [];

        foreach ($lines as $line) {
            if (str_starts_with($line, '@component')) {
                $inComponent = true;
                $componentLineBuffer[] = $line;
            } elseif ($inComponent) {
                $componentLineBuffer[] = $line;

                if (str_starts_with($line, '@endcomponent')) {
                    $inComponent = false;
                    $componentSource = implode("\n", $componentLineBuffer);
                    $placeholder = $this->makePlaceholder('Component', $componentSource);
                    $this->blocks[$placeholder] = $componentSource;
                    $processedLines[] = $placeholder;
                    $componentLineBuffer = [];
                }
            } else {
                $processedLines[] = $line;
            }
        }

        // Detect unclosed components
        if ($inComponent) {
            throw new \Exception('Unclosed @component directive. Close it with @endcomponent, or use @include instead.');
        }

        $this->markdown = implode("\n", $processedLines);
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
