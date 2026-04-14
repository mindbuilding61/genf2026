<?php

/**
 * Extension Manager/Repository config file for ext "genf2026".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Genf',
    'description' => '',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-13.4.99',
            'fluid_styled_content' => '13.4.0-13.4.99',
            'rte_ckeditor' => '13.4.0-13.4.99',
            'container' => '3.2.0-3.99.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Mindbuilding\\Genf\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Thomas',
    'author_email' => 'mindbuilding@mailbox.org',
    'author_company' => 'mindbuilding',
    'version' => '1.1.0',
];
