<?php
/**
 * Definitions for middlewares provided by EXT:redirects
 */
return [
    // location depending on what TYPO3 / Symfony we need - in this case: render TYPO3 content in symfony
    'frontend' => [
        'psychomieze/t3symfony/symfony-middleware' => [
            'target' => \Psychomieze\T3Symfony\Http\Middleware::class,
            'after' => [
                'typo3/cms-frontend/page-resolver',
            ],
            'before' => [
                'typo3/cms-frontend/shortcut-and-mountpoint-redirec'
            ]
        ],
    ],
];