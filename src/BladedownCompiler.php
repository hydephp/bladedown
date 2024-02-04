<?php

declare(strict_types=1);

namespace Hyde\Bladedown;

use Illuminate\Support\HtmlString;

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
        $this->html = $this->page->markdown->toHtml($this->page::class)->toHtml();

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
