<?php

declare(strict_types=1);

namespace Mindbuilding\Genf\Utility;

final class CssValueUtility
{
    public static function clean(string $value): string
    {
        $value = trim($value, " \t\n\r\0\x0B'\"");
        $value = rtrim($value, ';');

        return self::collapseUnitSpacing($value);
    }

    /**
     * "1.5 rem" / "124 px" -> "1.5rem" / "124px"
     */
    public static function collapseUnitSpacing(string $value): string
    {
        return (string)preg_replace(
            '/^(\d+(?:\.\d+)?)\s+(rem|px|em|%|vh|vw|ch|ex)$/i',
            '$1$2',
            trim($value)
        );
    }

    public static function normalizeFontSize(string $value, string $default = '1rem'): string
    {
        return self::normalizeCssLength($value, $default, 'rem');
    }

    public static function normalizeLineHeight(string $value, string $default = '1.3'): string
    {
        $value = self::clean($value);
        if ($value === '') {
            return $default;
        }

        if (preg_match('#^\d+(\.\d+)?$#', $value) === 1) {
            return $value;
        }

        return self::collapseUnitSpacing($value);
    }

    public static function normalizePixelSize(string $value, string $default = '200px'): string
    {
        return self::normalizeCssLength($value, $default, 'px');
    }

    public static function normalizeCssLength(string $value, string $default, string $unit): string
    {
        $value = self::clean($value);
        if ($value === '') {
            return $default;
        }

        if (preg_match('#^\d+(\.\d+)?$#', $value) === 1) {
            return $value . $unit;
        }

        return $value;
    }

    public static function normalizeColor(string $value, string $default = ''): string
    {
        $value = self::clean($value);

        return $value !== '' ? $value : $default;
    }
}
