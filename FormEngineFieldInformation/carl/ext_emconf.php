<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Form Engine Examples',
    'description' => 'This extension is used to show case form engine features',
    'category' => 'fe',
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'author' => 'Susanne Moog',
    'author_email' => 'susanne.moog@typo3.com',
    'version' => '10.4.x-dev',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-10.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
