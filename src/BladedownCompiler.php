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
        //
    }
}
