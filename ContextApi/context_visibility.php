<?php
$context = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(TYPO3\CMS\Core\Context::class);

// old
$showHiddenPages = $GLOBALS['TSFE']->showHiddenPages;
$showHiddenRecords = $GLOBALS['TSFE']->showHiddenRecords;

// new
// whether hidden pages should be displayed, as boolean
$showHiddenPages = $context->getPropertyFromAspect('visibility', 'includeHiddenPages');

// whether hidden content should be displayed, as boolean
$showHiddenRecords = $context->getPropertyFromAspect('visibility', 'includeHiddenContent');

// whether deleted records should be displayed, as boolean
$showDeletedRecords = $context->getPropertyFromAspect('visibility', 'includeDeletedRecords');

// @see \TYPO3\CMS\Core\Context\VisibilityAspect
