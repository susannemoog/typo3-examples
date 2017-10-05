<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(
    function () {
        if (TYPO3_MODE === 'BE' && !(TYPO3_REQUESTTYPE & TYPO3_REQUESTTYPE_INSTALL)) {
            \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class)
                ->connect(
                    \TYPO3\CMS\Backend\Backend\ToolbarItems\SystemInformationToolbarItem::class,
                    'getSystemInformation',
                    T3G\Site\Backend\ToolbarItem\SystemInformationToolbarItemExtension::class,
                    'addEnvironmentInformation'
                );
        }
    }
);