<?php

namespace Hyde\Bladedown;

use Hyde\Foundation\Concerns\HydeExtension;

class BladedownExtension extends HydeExtension
{
    /** @return array<class-string<\Hyde\Pages\Concerns\HydePage>> */
    public static function getPageClasses(): array
    {
        return [
            // Hyde\Bladedown\Pages\MyPage::class,
        ];
    }
}
