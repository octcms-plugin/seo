<?php namespace Octcms\Seo\Components;

use Cms\Classes\ComponentBase;
use Event;

class Search extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'octcms.seo::lang.component.search.name',
            'description' => 'octcms.seo::lang.component.search.description'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

}
