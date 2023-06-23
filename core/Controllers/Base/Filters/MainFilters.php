<?php
namespace Core\Controllers\Base\Filters;

use Core\Controllers\Base\Filters\DashboardFilters;
use Core\Traits\Singleton;

final class MainFilters
{
    use Singleton;

    public DashboardFilters $dashboardFilters;

    private function __construct()
    {
        add_filter("onLogoutRedirectURL", [$this, "onLogoutRedirectURL"]);
        $this->dashboardFilters = DashboardFilters::getInstance();
    }

    public static function onLogoutRedirectURL()
    {
        return home_url() . "/login";
    }
}
