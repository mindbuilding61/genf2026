<?php

declare(strict_types=1);

namespace Mindbuilding\Genf\Utility;

final class LogoPathUtility
{
    /**
     * Normalizes logo paths from site settings for use in Fluid/TypoScript.
     *
     * Accepts:
     * - fileadmin/logo/logo.png
     * - /fileadmin/logo/logo.png
     * - 1:/fileadmin/logo/logo.png (FAL combined identifier)
     * - EXT:genf2026/Resources/Public/Images/logo.png
     */
    public static function normalize(string $path): string
    {
        $path = trim($path);
        if ($path === '') {
            return '';
        }

        if (str_starts_with($path, 'EXT:')) {
            return $path;
        }

        if (preg_match('#^https?://#i', $path) === 1) {
            return $path;
        }

        if (preg_match('#^\d+:/#', $path) === 1) {
            $path = (string)preg_replace('#^\d+:#', '', $path);
        }

        if (!str_starts_with($path, '/')) {
            $path = '/' . ltrim($path, '/');
        }

        return $path;
    }
}
