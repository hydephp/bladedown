<?php

namespace Hyde\Bladedown;

use Hyde\Foundation\HydeKernel;
use Illuminate\Support\ServiceProvider;

class BladedownServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->make(HydeKernel::class)->registerExtension(BladedownExtension::class);
    }
}
