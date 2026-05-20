<?php

declare(strict_types=1);

namespace Mindbuilding\Genf\User;

use Mindbuilding\Genf\Rendering\SiteCssVariablesRenderer;

final class SiteCssVariablesUserFunc
{
    /**
     * @param array<string, mixed> $conf
     */
    public function render(string $content, array $conf): string
    {
        return (new SiteCssVariablesRenderer())->render();
    }
}
