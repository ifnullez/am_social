<?php

namespace Core\Controllers\Filters;

use Core\Traits\Singleton;

class UserAvatars
{
    use Singleton;

    private function __construct()
    {
        add_filter("get_avatar_url", [$this, "useLocalUserAvatarsUrl"], 10, 3);
    }

    public function useLocalUserAvatarsUrl($url, $id_or_email, $args)
    {
        var_dump($url, $id_or_email, $args);
    }
}
