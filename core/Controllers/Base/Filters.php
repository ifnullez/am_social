<?php
namespace Core\Controllers\Base;

final class Filters
{
    public function __construct()
    {
        add_filter("onLogoutRedirectURL", [$this, "onLogoutRedirectURL"]);
    }
    public static function onLogoutRedirectURL(){
        return home_url() . "/login";
    }
}