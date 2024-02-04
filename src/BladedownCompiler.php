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
        $data = array_merge($this->page->matter->toArray(), [
            'title' => $this->page->title,
            'content' => $this->page->markdown->toHtml(static::class),
        ]);

        return view($this->page->getBladeView(), $data)->render();
    }
}
