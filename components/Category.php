<?php namespace Octcms\Seo\Components;

use Cms\Classes\ComponentBase;
use Event;

class Category extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'octcms.seo::lang.component.category.name',
            'description' => 'octcms.seo::lang.component.category.description'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

}
