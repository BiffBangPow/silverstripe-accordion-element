<?php

namespace BiffBangPow\Element\Model;

use BiffBangPow\Element\AccordionElement;
use BiffBangPow\Extension\CallToActionExtension;
use BiffBangPow\Extension\SortableExtension;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\DataObject;
use TractorCow\Fluent\Extension\FluentExtension;

class AccordionItem extends DataObject
{
    private static $table_name = 'AccordionItem';
    private static $db = [
        'Title' => 'Varchar',
        'Content' => 'HTMLText'
    ];
    private static $has_one = [
        'Element' => AccordionElement::class
    ];
    private static $owns = [
        'Image'
    ];
    private static $extensions = [
        SortableExtension::class,
        CallToActionExtension::class
    ];
    private static $summary_fields = [
        'Content.Summary' => 'Content',
        'Image.CMSThumbnail' => 'Image'
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName(['ElementID']);
        $fields->addFieldsToTab('Root.Main', [
            HTMLEditorField::create('Content')
        ]);
        return $fields;
    }
}
