<?php /** @noinspection ALL */

$context = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(TYPO3\CMS\Core\Context::class);

// new in TYPO3 v10.0

// old
$GLOBALS['TSFE']->fePreview;

// new
GeneralUtility::makeInstance(Context::class)->getPropertyFromAspect('frontend.preview', 'isPreview');

// @see \TYPO3\CMS\Frontend\Aspect\PreviewAspect
