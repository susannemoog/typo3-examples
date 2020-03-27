<?php
declare(strict_types = 1);

namespace Susanne\Carl\FormEngine;


use TYPO3\CMS\Backend\Form\FormDataProviderInterface;

class ProcessInline implements FormDataProviderInterface
{
    /**
     * @param array $result
     * @return array
     */
    public function addData(array $result): array
    {
        // Debug $result['inlineParentUid'] here
        return $result;
    }
}
