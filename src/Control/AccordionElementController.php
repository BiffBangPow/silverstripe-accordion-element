<?php

namespace BiffBangPow\Element\Control;

use DNADesign\Elemental\Controllers\ElementController;
use SilverStripe\View\ThemeResourceLoader;
use SilverStripe\View\Requirements;

class AccordionElementController extends ElementController
{
    protected function init()
    {
        parent::init();
        $themeCSS = ThemeResourceLoader::inst()->findThemedCSS('client/dist/css/elements/accordion');
        if ($themeCSS) {
            Requirements::css($themeCSS, '', ['defer' => true]);
        }
    }
}