<?php

declare(strict_types=1);

namespace Mindbuilding\Genf\User;

use Mindbuilding\Genf\Rendering\SiteCssVariablesRenderer;
use TYPO3\CMS\Core\Attribute\AsAllowedCallable;

final class SiteCssVariablesUserFunc
{
    /**
     * @param array<string, mixed> $conf
     */
    #[AsAllowedCallable]
    public function render(string $content, array $conf): string
    {
        return (new SiteCssVariablesRenderer())->render();
    }
}
