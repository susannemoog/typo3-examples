 <?php

$context = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(TYPO3\CMS\Core\Context::class);

// old
$languageId = $GLOBALS['TSFE']->sys_language_uid->id;
$fallbackChain = $GLOBALS['TSFE']->sys_language_mode->fallbackChain;

// new
$newLanguageId = $context->getPropertyFromAspect('language', 'id');
$newFallbackChain = $context->getPropertyFromAspect('language', 'fallbackChain');

// @see \TYPO3\CMS\Core\Context\LanguageAspect
