<?php

/**
 * Extension Manager/Repository config file for ext "site".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'site',
    'description' => '',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-9.5.99',
            'fluid_styled_content' => '8.7.0-9.5.99',
            'rte_ckeditor' => '8.7.0-9.5.99'
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Wyfil\\Site\\' => 'Classes'
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'No use for a name',
    'author_email' => 'blog@whatsyourfunctioninlife.de',
    'author_company' => 'Wyfil',
    'version' => '1.0.0',
];
