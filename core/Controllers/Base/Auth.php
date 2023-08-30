<?php

namespace Core\Controllers\Base;

use Core\Traits\Singleton;
use Core\Controllers\Base\Filters\AuthFilters;
use Core\Controllers\Base\Views;

class Auth
{
    use Singleton;

    private function __construct()
    {
        add_action("init", [$this, "login"]);
    }

    public function login(): void
    {
        if (isset($_POST['ams-login-submit']) && function_exists('wp_signon')) {
            $signon = wp_signon([
                "user_login"    => $_POST["user_name_email"],
                "user_password" => $_POST["user_pass"],
                "remember"      => !empty($_POST["remember_me"]) ? true : false
            ], is_ssl());

            if (is_wp_error($signon)) {
                add_action("login_messages", function () use ($signon) {
                    include Views::getInstance()->templates . "/errors.php";
                }, 1, 1);
            } else {
                wp_redirect(AuthFilters::onLoginRedirectURL(), 302);
                exit;
            }
        }
    }
}
