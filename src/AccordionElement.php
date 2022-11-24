<?php

namespace BiffBangPow\Element;

use BiffBangPow\Element\Control\AccordionElementController;
use BiffBangPow\Element\Model\AccordionItem;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

class AccordionElement extends BaseElement
{
    private static $table_name = 'AccordionElement';
    private static $inline_editable = false;
    private static $db = [
        'Content' => 'HTMLText'
    ];
    private static $has_many = [
        'Items' => AccordionItem::class
    ];    
    private static $cascade_duplicates = [
        'Items'
    ];

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Content accordion');
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName(['Features']);

        $featuresGrid = GridField::create('Items', 'Items', $this->Items(),
            GridFieldConfig_RecordEditor::create()->addComponent(new GridFieldOrderableRows()));

        $fields->addFieldsToTab('Root.Main', [
            HTMLEditorField::create('Content')->setRows(8),
            $featuresGrid
        ]);

        return $fields;
    }

    public function getSimpleClassName()
    {
        return 'bbp-accordion-element';
    }
}
