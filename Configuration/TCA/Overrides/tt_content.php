<?php

declare(strict_types=1);

defined('TYPO3') or die();

use B13\Container\Tca\ContainerConfiguration;
use B13\Container\Tca\Registry;
use TYPO3\CMS\Core\Utility\GeneralUtility;

if (!class_exists(Registry::class)) {
    return;
}

GeneralUtility::makeInstance(Registry::class)->configureContainer(
    (new ContainerConfiguration(
        'b13-2cols-with-header-container',
        '2 Column Container With Header',
        'Two columns with a full-width header row.',
        [
            [
                ['name' => 'header', 'colPos' => 200, 'colspan' => 2, 'allowed' => ['CType' => 'header,textmedia']],
            ],
            [
                ['name' => 'left side', 'colPos' => 201],
                ['name' => 'right side', 'colPos' => 202],
            ],
        ]
    ))->setIcon('EXT:genf2026/Resources/Public/Icons/Extension.svg')
);
