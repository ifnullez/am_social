<?php

namespace Core;

use Core\Traits\Singleton;
use Core\Controllers\Base\{Router, Views, Auth};
use Core\Controllers\Base\Actions\MainActions;
use Core\Controllers\Base\Filters\MainFilters;
use Core\Controllers\Filters\UserAvatars;

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
    }

    public function amsLoadPublicScripts(): void
    {
        wp_enqueue_script("ams-main", AMS_PLUGIN_URL . "assets/dist/scripts/main.min.js", [], AMS_PLUGIN_VERSION, true);
        wp_enqueue_style("ams-main", AMS_PLUGIN_URL . "assets/dist/styles/main.min.css", [], AMS_PLUGIN_VERSION, "all");
    }
}
