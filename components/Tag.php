<?php namespace Octcms\Seo\Components;

use Cms\Classes\ComponentBase;
use Event;

class Tag extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'octcms.seo::lang.component.tag.name',
            'description' => 'octcms.seo::lang.component.tag.description'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

}
