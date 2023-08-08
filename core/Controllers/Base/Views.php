<?php

namespace Core\Controllers\Base;

use Core\Controllers\Base\{Page, Router};
use Core\Controllers\Base\Filters\AuthFilters;
use Core\Traits\Singleton;

// TODO: Proceed writing template loader
final class Views
{
    use Singleton;

    public string $templates;
    public Page $page;

    private function __construct()
    {
        // load page to rewrite wp_query | Pages are virtual
        $this->templates = $this->setTemplatesPath();
        // set virtual page template
        add_filter("template_include", [$this, "render"]);
    }
    // TODO: make this method adaptive to partly placed templates
    public function setTemplatesPath(): string
    {
        if (file_exists(AMS_ACTIVE_THEME_DIR . "/ams")) {
            return AMS_ACTIVE_THEME_DIR . "/ams";
        }
        return AMS_PLUGIN_DIR . "/Views/public";
    }

    public function render(string $template): string
    {
        global $wp_query;
        $currentRouterPage = !empty($wp_query->query['main_page']) ? Router::$endpoints[$wp_query->query['main_page']] : "";
        // TODO: FIX COMPONENT LOADING | SOME THEMES NOT WORKING PROPERLY
        if ($wp_query->query['is_ams_page']) {
            $needLogin = !empty($currentRouterPage['need_login']) ? $currentRouterPage['need_login'] : false;
            $isAuthPage = !empty($currentRouterPage['auth_page']) ? ['auth_page'] : false;

            // init virtual page
            $this->page = new Page();
            // if is auth page add sub-folder part to properly place template parts
            if ($isAuthPage) {
                $this->templates .= "/auth";
            }
            // get page template
            $pageFile = "{$this->templates}/{$wp_query->query["current_page"]}/content.php";
            // if page require login
            if ($needLogin && !is_user_logged_in()) {
                wp_redirect(AuthFilters::onLogoutRedirectURL(), 302);
                exit;
            } else if (file_exists($pageFile)) {
                // set page template
                $template = $pageFile;
            }
        }
        return $template;
    }
}
