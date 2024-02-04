<?php

declare(strict_types=1);

namespace Hyde\Bladedown;

/**
 * Handles preprocessing logic for the Bladedown compiler.
 *
 * @see \Hyde\Bladedown\BladedownCompiler
 */
class BladedownPreProcessor
{
    public static function process(string $markdown): string
    {
        return $markdown;
    }
}
