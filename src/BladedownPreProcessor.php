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
    protected array $stacks;

    protected function __construct(string $markdown)
    {
        $this->markdown = $markdown;
        $this->blocks = [];
        $this->stacks = [];
    }

    public static function process(string $markdown): static
    {
        $processor = new static($markdown);

        $processor->processEchoBlocks();
        $processor->processComponentBlocks();
        $processor->processStackBlocks();

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

    // Replace multiline Blade @components and <x-components> with placeholders
    protected function processComponentBlocks(): void
    {
        $lines = explode("\n", $this->markdown);

        // Since we process the lines one by one, we need to keep track of the processed lines
        $processedLines = [];

        $inComponent = false;
        // Used to buffer the lines inside a component
        $componentLineBuffer = [];

        foreach ($lines as $line) {
            if (str_starts_with($line, '@component') || str_starts_with($line, '<x-')) {
                // Detect unclosed components
                if ($inComponent) {
                    throw new \Exception('Component parse error: Unexpected opening tag. Did you forget to close a component tag?');
                }

                // Start processing a new component
                $inComponent = true;
                $componentLineBuffer[] = $line;

                // If component is self-closing, we can close it right away
                if (str_ends_with($line, '/>')) {
                    // TODO: Refactor to be less evil
                    goto closeComponent;
                }
            } elseif ($inComponent) {
                // Continue processing the current component
                $componentLineBuffer[] = $line;

                if (str_starts_with($line, '@endcomponent') || str_starts_with($line, '</x-')) {
                    closeComponent:

                    // Close the current component
                    $inComponent = false;
                    $componentSource = implode("\n", $componentLineBuffer);
                    $placeholder = $this->makePlaceholder('Component', $componentSource);
                    $this->blocks[$placeholder] = $componentSource;
                    $processedLines[] = $placeholder;
                    $componentLineBuffer = [];
                }
            } else {
                // No component is being processed

                if (str_starts_with($line, '@include')) {
                    // Directly replace the single-line component with a placeholder
                    $placeholder = $this->makePlaceholder('Component', $line);
                    $this->blocks[$placeholder] = $line;
                    $processedLines[] = $placeholder;
                } else {
                    $processedLines[] = $line;
                }
            }
        }

        // Detect unclosed components
        if ($inComponent) {
            throw new \Exception('Component parse error: Unclosed @component directive. Close it with @endcomponent, or use @include instead.');
        }

        $this->markdown = implode("\n", $processedLines);
    }

    // Process @push and @stack directives (currently only @push to keep it simple)
    protected function processStackBlocks(): void
    {
        $stacks = [];
        $lines = explode("\n", $this->markdown);
        $processedLines = [];

        foreach ($lines as $line) {
            if (str_starts_with($line, '@push')) {
                $stackName = trim(str_replace(['@push', '(', ')', "'"], '', $line));
                $stacks[$stackName] = [];
                // Add the @push line to the stack, so we can include it in the placeholder
                //$stacks[$stackName][] = $line;
            } elseif (str_starts_with($line, '@endpush')) {
                // Close the current stack
                $stackName = array_key_last($stacks);
                // Add the @endpush line to the stack, so we can include it in the placeholder
                //$stacks[$stackName][] = $line;

                //$processedLines[] = $this->makePlaceholder('Stack', implode("\n", $stacks[$stackName]));
            } elseif (count($stacks) > 0) {
                // We are inside a stack
                $stackName = array_key_last($stacks);
                $stacks[$stackName][] = $line;
            } else {
                $processedLines[] = $line;
            }
        }

        // Stacks and pushes can't be rendered directly, add them to a special buffer
        foreach ($stacks as $stackName => $stackLines) {
           // $this->stacks[$this->makePlaceholder('Stack', implode("\n", $stackLines))] = implode("\n", $stackLines);
            $this->stacks[] = [
                'name' => $stackName,
                'type' => 'push', // todo support more
                'content' => implode("\n", $stackLines),
            ];
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

    public function getStacks(): array
    {
        return $this->stacks;
    }
}
