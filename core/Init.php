<?php

namespace Core;

use Core\Traits\Singleton;
use Core\Controllers\Base\{Router, Views, Auth};
use Core\Controllers\Base\Actions\MainActions;
use Core\Controllers\Base\Filters\MainFilters;
use Core\Controllers\Filters\UserAvatars;

// TODO: FIX VIEWS RENDERING | FOR NOW PLUGIN DROP THE WP PAGES AND POSTS RENDERING

final class Init
{
    use Singleton;

    public MainActions $actions;
    public MainFilters $filters;
    public Router $router;
    public Views $views;
    public Auth $auth;
    public UserAvatars $userAvatars;

    private function __construct()
    {
        // init plugin parts
        $this->actions = MainActions::getInstance();
        $this->filters = MainFilters::getInstance();
        $this->router = Router::getInstance();
        $this->views = Views::getInstance();
        $this->auth = Auth::getInstance();
        $this->userAvatars = userAvatars::getInstance();
        // scripts
        add_action("wp_enqueue_scripts", [$this, "amsLoadPublicScripts"]);
        add_action("admin_enqueue_scripts", [$this, "amsLoadAdminScripts"]);
    }

    public function amsLoadPublicScripts(): void
    {
        wp_enqueue_script("ams-main", AMS_PLUGIN_URL . "assets/dist/scripts/main.min.js", [], AMS_PLUGIN_VERSION, true);
        wp_enqueue_style("ams-main", AMS_PLUGIN_URL . "assets/dist/styles/main.min.css", [], AMS_PLUGIN_VERSION, "all");
        wp_localize_script("ams-main", "ams", [
            "url" => admin_url("admin-ajax.php"),
            "nonce" => wp_create_nonce("ams-social-admin-nonce"),
            "is_user_logged_in" => is_user_logged_in()
        ]);
    }

    public function amsLoadAdminScripts(): void
    {
        wp_enqueue_script("ams-admin-main", AMS_PLUGIN_URL . "assets/dist/scripts/admin.min.js", null, AMS_PLUGIN_VERSION);
        wp_enqueue_style("ams-admin-main", AMS_PLUGIN_URL . "assets/dist/styles/admin.min.css", [], AMS_PLUGIN_VERSION, "all");
        wp_localize_script("ams-admin-main", "ams", [
            "url" => admin_url("admin-ajax.php"),
            "nonce" => wp_create_nonce("ams-social-admin-nonce"),
            "is_user_logged_in" => is_user_logged_in()
        ]);
    }
}
