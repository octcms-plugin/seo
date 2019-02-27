<?php namespace Octcms\Seo\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use Cms\Classes\Theme;
use Request;
use Octcms\Seo\models\Settings;
use URL;

class CmsPage extends ComponentBase
{
    public $page;
    public $seo_title;
    public $seo_description;
    public $seo_keywords;
    public $canonical_url;
    public $redirect_url;
    public $robot_index;
    public $robot_follow;
    public $hasBlog;
    public $hasCategory;
    public $hasTag;
    public $hasSearch;

    public $ogTitle;
    public $ogUrl;
    public $ogDescription;
    public $ogSiteName;
    public $ogFbAppId;
    public $ogLocale;
    public $ogImage;


    public function componentDetails()
    {
        return [
            'name'        => 'octcms.seo::lang.component.cms.name',
            'description' => 'octcms.seo::lang.component.cms.description'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $theme = Theme::getActiveTheme();
        $page = Page::load($theme,$this->page->baseFileName);
        $this->page["hasBlog"] = false;
        $this->page["hasCategory"] = false;
        $this->page["hasTag"] = false;

        if($page->hasComponent("blogPost"))
        {
            $this->hasBlog = $this->page["hasBlog"] = true;
        } elseif ($page->hasComponent("postsWithTag")){
            $this->hasTag = $this->page["hasTag"] = true;
        } elseif ($page->hasComponent("SeoCategory")){
            $this->hasCategory = $this->page["hasCategory"] = true;
        } elseif ($page->hasComponent("SeoSearch")){
            $this->hasSearch = $this->page["hasSearch"] = true;
        } else {
            $this->seo_title = $this->page["seo_title"] = empty($this->page->meta_title) ? $theme->title : $this->page->meta_title;
            $this->seo_description = $this->page["seo_description"] = empty($this->page->meta_description) ? $theme->description : $this->page->meta_description;
            $this->seo_keywords = $this->page["seo_keywords"] = empty($this->page->seo_keywords) ? $theme->keywords : $this->page->seo_keywords;
            $this->canonical_url = $this->page["canonical_url"] = $this->page->canonical_url;
            $this->redirect_url = $this->page["redirect_url"] = $this->page->redirect_url;
            $this->robot_follow = $this->page["robot_follow"] = $this->page->robot_follow;
            $this->robot_index = $this->page["robot_index"] = $this->page->robot_index;

            $settings = Settings::instance();

            if($settings->enable_og_tags)
            {
                $this->ogTitle = empty($this->page->meta_title) ? $this->page->title : $this->page->meta_title;
                $this->ogDescription = $this->page->meta_description;
                $this->ogUrl = empty($this->page->canonical_url) ? Request::url() : $this->page->canonical_url ;
                $this->ogSiteName = $settings->og_sitename;
                $this->ogFbAppId = $settings->og_fb_appid;
            }
        }
    }

}
