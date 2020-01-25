<?php
declare(strict_types = 1);

namespace Susanne\Carl\FormEngine;


use TYPO3\CMS\Backend\Form\AbstractNode;

class GenerateDataControl extends AbstractNode
{
    public function render()
    {
        return [
            'iconIdentifier' => 'generate-data',
            'title' => 'Generate Data',
            'linkAttributes' => [
                'class' => 'generateData '
            ],
            'requireJsModules' => ['TYPO3/CMS/Carl/GenerateData'],
        ];
    }
}
