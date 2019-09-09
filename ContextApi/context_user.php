<?php
$context = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(TYPO3\CMS\Core\Context::class);

// old - replaces various common properties of
$frontendUser = $GLOBALS['TSFE']->fe_user;
$backendUser = $GLOBALS['BE_USER'];

// new:

// uid of the currently logged in user, 0 if no user
$context->getPropertyFromAspect('backend.user', 'id');
$context->getPropertyFromAspect('frontend.user', 'id');

// the username of the currently authenticated user. Empty string if no user
$context->getPropertyFromAspect('backend.user', 'username');
$context->getPropertyFromAspect('frontend.user', 'username');

// whether a user is logged in, as boolean
$context->getPropertyFromAspect('backend.user','isLoggedIn');
$context->getPropertyFromAspect('frontend.user','isLoggedIn');

// whether the user is admin, as boolean . Only useful for backend users.
$context->getPropertyFromAspect('backend.user', 'isAdmin');

// the groups the user is a member of, as array
$context->getPropertyFromAspect('backend.user', 'groupIds');
$context->getPropertyFromAspect('frontend.user', 'groupIds');

// the names of all groups the user belongs to, as array
$context->getPropertyFromAspect('backend.user', 'groupNames');
$context->getPropertyFromAspect('frontend.user', 'groupNames');

// @see \TYPO3\CMS\Core\Context\UserAspect
