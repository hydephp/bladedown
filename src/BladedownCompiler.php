<?php

declare(strict_types=1);

namespace Hyde\Bladedown;

use Illuminate\Support\HtmlString;
use Hyde\Markdown\Models\Markdown;

class BladedownCompiler
{
    protected BladedownPage $page;

    protected string $html;

    public function __construct(BladedownPage $page)
    {
        $this->page = $page;
    }

    public function compile(): string
    {
        $this->html = Markdown::render($this->page->markdown->body(), BladedownPage::class);

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
}
