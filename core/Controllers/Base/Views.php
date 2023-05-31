<?php
namespace Core\Controllers\Base;

use Core\Controllers\Base\{Page};

// TODO: Proceed writing template loader
final class Views
{
    public string $templates;
    public Page $page;
    
    public function __construct()
    {
        // load page to rewrite wp_query | Pages are virtual
        $this->templates = $this->setTemplatesPath();
        // filters and actions
        add_filter( "template_include", [ $this, "render"] );
    }
    
    public function setTemplatesPath(): string
    {
        if(file_exists(AMS_ACTIVE_THEME_DIR . "/ams")){
            return AMS_ACTIVE_THEME_DIR . "/ams";
        }
        return AMS_PLUGIN_DIR . "/Views/public";
    }
    
    public function render(string $template): string
    {
        global $wp_query;
        // TODO: FIX COMPONENT LOADING | SOME THEMES NOT WORKING PROPERLY
        if($wp_query->query['is_ams_page']){
            // init virtual page
            $page = new Page();
            // get page template
            $pageFile = $this->templates . "/{$wp_query->query["current_page"]}/content.php";
            if(file_exists($pageFile)){
                // set page template
                $template = $pageFile;
            }
        }
        return $template;
    }
}

/**
public function loadRouterPage( $template ): string
{
    $currentPage = self::currentVirtualPage();

    if ( $currentPage ) {
        if(file_exists("{$this->templatesPath}/public/{$currentPage}.php")){
                // fill query for virtual page
                if(!empty(self::$endpoints[$currentPage]["need_login"]) && self::$endpoints[$currentPage]["need_login"] && !is_user_logged_in() || $currentPage == "login"){
                    $this->createPage("Login", "{$this->templatesPath}/public/login.php", true);
                } else {
                    $this->createPage($currentPage, "{$this->templatesPath}/public/{$currentPage}.php", true);
                }
                // assign needed file as page template
                $template = "{$this->templatesPath}/public/{$currentPage}.php";
        } else {
            throw new \Exception("Template for page {$currentPage} not found!");
        }
    }
    return $template;
}
**/