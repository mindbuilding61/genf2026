<?php

declare(strict_types=1);

namespace Mindbuilding\Genf\ViewHelpers;

use Mindbuilding\Genf\Utility\LogoPathUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

final class NormalizeLogoPathViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('path', 'string', 'Logo path from site settings', false, '');
    }

    public function render(): string
    {
        $path = $this->arguments['path'] !== ''
            ? (string)$this->arguments['path']
            : (string)$this->renderChildrenClosure();

        return LogoPathUtility::normalize($path);
    }
}
