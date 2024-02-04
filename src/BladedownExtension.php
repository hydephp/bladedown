<?php

namespace Hyde\Bladedown;

use Hyde\Foundation\Concerns\HydeExtension;
use Hyde\Foundation\Kernel\FileCollection;
use Hyde\Foundation\Kernel\PageCollection;
use Hyde\Foundation\Kernel\RouteCollection;

class BladedownExtension extends HydeExtension
{
    /** @return array<class-string<\Hyde\Pages\Concerns\HydePage>> */
    public static function getPageClasses(): array
    {
        return [
            // Hyde\Bladedown\Pages\MyPage::class,
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
