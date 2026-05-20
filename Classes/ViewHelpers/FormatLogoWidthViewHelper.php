<?php

declare(strict_types=1);

namespace Mindbuilding\Genf\ViewHelpers;

use Mindbuilding\Genf\Utility\LogoPathUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

final class FormatLogoWidthViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('width', 'string', 'Logo width from site settings', false, '');
        $this->registerArgument('pixelsOnly', 'bool', 'Return integer pixels for HTML width attribute', false, false);
    }

    public function render(): string
    {
        $width = $this->arguments['width'] !== ''
            ? (string)$this->arguments['width']
            : (string)$this->renderChildrenClosure();

        if ((bool)$this->arguments['pixelsOnly']) {
            return (string)LogoPathUtility::normalizeWidthPixels($width);
        }

        return LogoPathUtility::normalizeWidth($width);
    }
}
