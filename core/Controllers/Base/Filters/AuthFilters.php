<?php
namespace Core\Controllers\Base\Filters;

use Core\Traits\Singleton;

class AuthFilters
{
    use Singleton;

    private function __construct()
    {
        add_filter("onLogoutRedirectURL", [$this, "onLogoutRedirectURL"]);
        add_filter("onLoginRedirectURL", [$this, "onLoginRedirectURL"]);
    }
    public static function onLogoutRedirectURL()
    {
        return home_url() . "/login";
    }

    public static function onLoginRedirectURL()
    {
        return home_url() . "/dashboard";
    }
}
