<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1487112285] = [
    'nodeName' => 'AdditionalInfoPageTitle',
    'priority' => '70',
    'class' => \Psychomieze\Carl\FormEngine\AdditionalPageTitle::class
];