<?php
$context = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(TYPO3\CMS\Core\Context::class);

// old
$currentWorkspaceId = $GLOBALS['BE_USER']->workspace;

// new
// UID of the currently accessed workspace as integer
$context->getPropertyFromAspect('workspace', 'id');

// whether the current workspace is live or a custom offline WS, as boolean
$context->getPropertyFromAspect('workspace', 'isLive');

// whether the current workspace is offline, as boolean
$context->getPropertyFromAspect('workspace', 'isOffline');

// @see \TYPO3\CMS\Core\Context\WorkspaceAspect
