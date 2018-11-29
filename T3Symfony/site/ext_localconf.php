<?php

defined('TYPO3_MODE') || die();

/***************
 * Add default RTE configuration
 */
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['site'] = 'EXT:site/Configuration/RTE/Default.yaml';

$container = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\Container\Container::class);
$container
    ->registerImplementation(
        \T3G\AgencyPack\Blog\Domain\Model\Author::class,
        \Examples\Site\Domain\Model\Author::class
    );
$container->registerImplementation(
    \T3G\AgencyPack\Blog\Domain\Model\Post::class,
    \Examples\Site\Domain\Model\Post::class
);
