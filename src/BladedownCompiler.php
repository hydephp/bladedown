<?php

declare(strict_types=1);

namespace Hyde\Bladedown;

use Illuminate\Support\HtmlString;
use Hyde\Markdown\Models\Markdown;

class BladedownCompiler
{
    protected BladedownPage $page;

    protected string $markdown;
    protected string $html;

    public function __construct(BladedownPage $page)
    {
        $this->page = $page;
    }

    public function compile(): string
    {
        $this->markdown = $this->page->markdown->body();
        $this->html = $this->compileMarkdown($this->markdown);

        return $this->compilePageView();
    }

    protected function getViewData(): array
    {
        return array_merge($this->page->matter->toArray(), [
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
