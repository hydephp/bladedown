<?php

namespace Vendor\PackageName;

use Hyde\Foundation\HydeKernel;
use Illuminate\Support\ServiceProvider;

class PackageNameServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->make(HydeKernel::class)->registerExtension(PackageNameExtension::class);
    }

    public function boot(): void
    {
        //
    }
}
