<?php
namespace BiffBangPow\Element;
use BiffBangPow\Element\Control\AccordionElementController;
use BiffBangPow\Element\Model\AccordionElementItem;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
class AccordionElement extends BaseElement
{
    private static $table_name = 'AccordionElement';
    private static $inline_editable = false;
    private static $db = [
        'Content' => 'HTMLText',
        'IsFAQ' => 'Boolean'
    ];
    private static $has_many = [
        'Items' => AccordionElementItem::class
    ];
    private static $cascade_duplicates = [
        'Items'
    ];
    private static $controller_class = AccordionElementController::class;
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
        $faqField = CheckboxField::create('IsFAQ', 'Mark up as FAQ for search engines')
            ->setDescription(
                'Adds structured data (Schema.org FAQPage) to help search engines and AI ' .
                'crawlers understand this as a list of frequently asked questions. ' .
                'Only enable this if: the items genuinely are questions and answers ' .
                'written by us (not user-submitted comments or general collapsible content like ' .
                'product specs or terms). Only use ONE FAQ accordion per page. ' .
                'Enabling this on multiple accordions on the same page will produce invalid markup.'
            );
        $fields->addFieldsToTab('Root.Main', [
            HTMLEditorField::create('Content')->setRows(8),
            $faqField,
            $featuresGrid
        ]);
        return $fields;
    }
    public function getSimpleClassName()
    {
        return 'bbp-accordion-element';
    }
    /**
     * Build the JSON-LD FAQPage schema for this accordion.
     * Returns null if not flagged as FAQ or if there are no items.
     */
    public function getFAQSchema()
    {
        if (!$this->IsFAQ) {
            return null;
        }
        $items = $this->Items();
        if (!$items->exists()) {
            return null;
        }
        $data = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => []
        ];
        foreach ($items as $item) {
            $data['mainEntity'][] = [
                '@type' => 'Question',
                'name' => (string) $item->Title,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => (string) $item->Content
                ]
            ];
        }
        return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    }
}