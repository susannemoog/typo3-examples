<?php
$context = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(TYPO3\CMS\Core\Context::class);

// old:
$currentExecutionTime = $GLOBALS['EXEC_TIME'];
$currentSimulatedExecutionTime = $GLOBALS['SIM_EXEC_TIME'];

// new:
$currentExecutionTime = $context->getPropertyFromAspect('date', 'timestamp');
// simulated access time will be manipulated through custom context


// other time related context features

// for example: Europe/Berlin
$timezone = $context->getPropertyFromAspect('date', 'timezone');

// datetime as string in ISO 8601 format, e.g. 2004-02-12T15:19:21+00:00
$dateAsIso = $context->getPropertyFromAspect('date', 'iso');

// the complete DateTimeImmutable object of the current exec time
$date = $context->getPropertyFromAspect('date', 'full');

// @see \TYPO3\CMS\Core\Context\DateTimeAspect
