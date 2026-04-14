<?php

declare(strict_types=1);

defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(static function (): void {
    $extensionKey = 'genf2026';
    $configs = [
        'Configuration/TsConfig/Page/Mod/WebLayout/BackendLayouts/default.tsconfig' => 'Backend Layout: Default',
        'Configuration/TsConfig/Page/Mod/WebLayout/BackendLayouts/kasten.tsconfig' => 'Backend Layout: Kasten',
        'Configuration/TsConfig/Page/Mod/WebLayout/BackendLayouts/FooterBackendLayout.tsconfig' => 'Backend Layout: Footer',
        'Configuration/TsConfig/Page/old_page.tsconfig' => 'Genf: Element-Anpassungen (TCEFORM)',
    ];

    foreach ($configs as $path => $title) {
        ExtensionManagementUtility::registerPageTSConfigFile($extensionKey, $path, $title);
    }
})();
