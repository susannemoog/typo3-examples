<?php
defined('TYPO3_MODE') || die();

$GLOBALS['TYPO3_CONF_VARS']['SYS']['routing']['enhancers']['ByPass'] = \Psychomieze\T3Symfony\Routing\ByPassEnhancer::class;