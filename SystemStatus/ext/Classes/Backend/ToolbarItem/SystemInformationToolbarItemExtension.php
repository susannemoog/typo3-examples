<?php
declare(strict_types=1);

namespace T3G\Site\Backend\ToolbarItem;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Backend\Backend\ToolbarItems\SystemInformationToolbarItem as CoreSystemInformationToolbarItem;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Utility\CommandUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;


/**
 * Class SystemInformationToolbarItem.
 *
 * Add information about typo3.com environment to toolbar system information
 *
 * @package T3G\TemplateTypo3com\Backend\ToolbarItem
 */
class SystemInformationToolbarItemExtension
{
    /**
     * @var IconFactory
     */
    protected $iconFactory;

    /**
     * SystemInformationToolbarItem constructor.
     */
    public function __construct()
    {
        $this->iconFactory = $iconFactory = GeneralUtility::makeInstance(IconFactory::class);
    }

    /**
     * Called by the system information toolbar signal/slot dispatch.
     *
     * @param CoreSystemInformationToolbarItem $systemInformation
     */
    public function addEnvironmentInformation(CoreSystemInformationToolbarItem $systemInformation)
    {
        $systemInformation->addSystemInformation(...$this->getGitRevision());
    }

    /**
     * Gets the current GIT version
     */
    protected function getGitRevision()
    {
        chdir(PATH_site);
        $revision = trim(CommandUtility::exec('git describe'));
        chdir(PATH_typo3);
        return [
            htmlspecialchars('Site Version'),
            htmlspecialchars($revision),
            $this->iconFactory->getIcon('sysinfo-git', Icon::SIZE_SMALL)->render(),
        ];
    }

}