<?php
declare(strict_types=1);

namespace Susanne\Carl\FormEngine;


use TYPO3\CMS\Backend\Form\AbstractNode;

class AdditionalPageTitle extends AbstractNode
{

    /**
     * Handler for single nodes
     *
     * @return array As defined in initializeResultArray() of AbstractNode
     */
    public function render(): array
    {
        $result = $this->initializeResultArray();
        $result['html'] = 'The <strong>current</strong> title is: ' . $this->data['recordTitle'];
        return $result;
    }
}
