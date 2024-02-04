<?php

declare(strict_types=1);

namespace Hyde\Bladedown;

use Hyde\Markdown\Models\Markdown;
use Illuminate\Support\HtmlString;

/**
 * Compiles a BladedownPage instance into the final HTML.
 *
 * The pipeline works as follows:
 * - tokenizing the Markdown to find Blade blocks,
 * - replacing Blade blocks with placeholders,
 * - rendering the Markdown to HTML,
 * - rendering the Blade into HTML,
 * - replacing the placeholders with the rendered Blade HTML.
 *
 * To aid implementation, {@see \Illuminate\View\Compilers\BladeCompiler} ({@link https://github.com/illuminate/view/blob/master/Compilers/BladeCompiler.php})
 * for the Laravel Blade compiler for a reference on the Blade syntax, and it's naming conventions.
 */
class BladedownCompiler
{
    protected BladedownPage $page;

    protected string $markdown;
    protected string $html;

    /** @var array<string, string> [placeholder => Blade source] */
    protected array $blocks = [];

    public function __construct(BladedownPage $page)
    {
        $this->page = $page;
    }

    public function compile(): string
    {
        $this->markdown = $this->page->markdown->body();
        $this->markdown = $this->preprocess($this->markdown);

        $this->blocks = $this->renderBlocks($this->blocks);

        $this->html = $this->compileMarkdown($this->markdown);
        $this->html = $this->postprocess($this->html);

        return $this->compilePageView();
    }

    /**
     * @todo We need to add checks to ensure we don't replace content inside code blocks.
     */
    protected function preprocess(string $markdown): string
    {
        return $markdown;
    }

    protected function postprocess(string $html): string
    {
        foreach ($this->blocks as $placeholder => $source) {
            $html = str_replace($placeholder, $source, $html);
        }

        return $html;
    }

    protected function renderBlocks(array $blocks): array
    {
        foreach ($blocks as $placeholder => $source) {
            $blocks[$placeholder] = Blade::render($source, $this->getBaseViewData());
        }

        return $blocks;
    }

    protected function getBaseViewData(): array
    {
        return $this->page->matter->toArray();
    }

    protected function getViewData(): array
    {
        return array_merge($this->getBaseViewData(), [
            'title' => $this->page->title,
            'content' => new HtmlString($this->html),
        ]);
    }

    protected function compilePageView(): string
    {
        return view($this->page->getBladeView(), $this->getViewData())->render();
    }

    protected function compileMarkdown(string $markdown): string
    {
        return Markdown::render($markdown, BladedownPage::class);
    }
}
