<?php
namespace Core\Controllers\Base;

use Core\Controllers\Base\Filters\AuthFilters;
use Core\Traits\Singleton;

final class Router
{
    use Singleton;

    public static array $endpoints = [
        "dashboard" => [
            "need_login" => true
        ],
        "login" => [
            "need_login" => false,
            "auth_page" => true
        ],
        "register" => [
            "need_login" => false,
            "auth_page" => true
        ],
        "forgot-password" => [
            "need_login" => false,
            "auth_page" => true
        ]
    ];

    private function __construct()
    {
        add_action("init", [$this, "registerRoutes"]);
        add_filter('request', [$this, "filterRequest"]);
        add_action('wp_logout', [$this, "onLogoutRedirect"]);
        add_action('login_redirect', [$this, "onLoginRedirect"]);
    }

    public static function add(string $endpointName, array $endpointProperties = []): void
    {
        self::$endpoints[$endpointName] = $endpointProperties;
    }

    public static function getQueryArray(string $query): array
    {
        $queryArray = [];
        if(!empty($query)){
            foreach(explode('&', str_replace(['?', '/'], ['', ''], $query)) as $part) {
                $param = explode('=', $part);
                $queryArray[$param[0]] = $param[1];
            }
        }
        return $queryArray;
    }

    public function filterRequest(array $vars): array
    {
        // main array of pages
        $vars["is_ams_page"] = false;
        if(in_array(array_key_first($vars), array_keys(self::$endpoints))){
            $vars["is_ams_page"] = true;
            $pages = explode('/', $vars[array_key_first($vars)]);
            // copy var to prevent removing parameters from main var
            $mid = $pages;
            // formatted query array
            $query = self::getQueryArray($_SERVER['QUERY_STRING']);

            if(!empty(array_key_first($vars)) && array_key_exists(array_key_first($vars), self::$endpoints)){
                // main page name | parent page for next current
                $vars["main_page"] = array_key_first($vars);
                // current page is the last page in params
                $vars["current_page"] = !empty(end($pages)) ? end($pages) : array_key_first($vars);

                // track middle pages
                // unset($mid[0]);
                // unset($mid[count($mid)]);

                if(!empty($mid)){
                    $vars["mid_pages"] = $mid;
                }

                // pass filtered query array if query exists
                if(!empty($query)){
                    $vars['query'] = $query;
                }
                if(!empty(self::$endpoints[array_key_first($vars)]["single_type"])){
                    $vars["single_type"] = self::$endpoints[array_key_first($vars)]["single_type"]; // single
                }
            }
        }
        return $vars;
    }

    public function registerRoutes(): void
    {
        if(!empty(self::$endpoints)){
            foreach(self::$endpoints as $routeKey => $routeValue){
                add_rewrite_endpoint( $routeKey, EP_ALL, true );
            }
            flush_rewrite_rules();
        }
    }

    public function onLogoutRedirect(): void
    {
        wp_redirect( AuthFilters::onLogoutRedirectURL(), 302 );
        exit;
    }
    public function onLoginRedirect(): void
    {
        wp_redirect( AuthFilters::onLoginRedirectURL(), 302 );
        exit;
    }
}
