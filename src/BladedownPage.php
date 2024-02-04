<?php

declare(strict_types=1);

namespace Hyde\Bladedown;

use Hyde\Pages\MarkdownPage;

class BladedownPage extends MarkdownPage
{
    public static string $template = 'hyde::layouts/page';
    public static string $fileExtension = '.blade.md';

    /** @experimental Implements RFC https://github.com/hydephp/develop/pull/1517 */
    public function getBladeView(): string
    {
        return $this->matter->get('extends') ?? parent::getBladeView();
    }
}
