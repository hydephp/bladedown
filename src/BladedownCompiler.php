<?php

declare(strict_types=1);

namespace Hyde\Bladedown;

class BladedownCompiler
{
    protected BladedownPage $page;

    public function __construct(BladedownPage $page)
    {
        $this->page = $page;
    }

    public function compile(): string
    {
        return view($this->page->getBladeView(), $this->getViewData())->render();
    }

    protected function getViewData(): array
    {
        return array_merge($this->page->matter->toArray(), [
            'title' => $this->page->title,
            'content' => $this->page->markdown->toHtml(static::class),
        ]);
    }
}
