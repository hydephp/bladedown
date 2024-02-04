<?php

namespace Vendor\PackageName;

use Hyde\Foundation\Concerns\HydeExtension;
use Hyde\Foundation\Kernel\FileCollection;
use Hyde\Foundation\Kernel\PageCollection;
use Hyde\Foundation\Kernel\RouteCollection;

class PackageNameExtension extends HydeExtension
{
    /** @return array<class-string<\Hyde\Pages\Concerns\HydePage>> */
    public static function getPageClasses(): array
    {
        return [
            // Vendor\PackageName\Pages\MyPage::class,
        ];
    }

    /** {@inheritDoc} */
    public function discoverFiles(FileCollection $collection): void
    {
        // Interact with the file discovery process directly.
    }

    /** {@inheritDoc} */
    public function discoverPages(PageCollection $collection): void
    {
        // Interact with the page discovery process directly.
    }

    /** {@inheritDoc} */
    public function discoverRoutes(RouteCollection $collection): void
    {
        // Interact with the route discovery process directly.
    }
}
