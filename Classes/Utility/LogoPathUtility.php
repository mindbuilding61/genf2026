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

    /**
     * Normalizes logo width for CSS (e.g. "200" -> "200px").
     */
    public static function normalizeWidth(string $width, string $default = '200px'): string
    {
        $width = trim($width);
        if ($width === '') {
            return $default;
        }

        if (preg_match('#^\d+$#', $width) === 1) {
            return $width . 'px';
        }

        return $width;
    }

    /**
     * Returns pixel value for HTML width attribute on f:image.
     */
    public static function normalizeWidthPixels(string $width, int $default = 200): int
    {
        $width = trim($width);
        if (preg_match('#^(\d+)#', $width, $matches) === 1) {
            return max(1, (int)$matches[1]);
        }

        return $default;
    }
}
