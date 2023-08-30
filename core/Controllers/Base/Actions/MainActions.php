<?php

namespace Core\Controllers\Base\Actions;

use Core\Traits\Singleton;
use Core\Controllers\Base\Actions\AuthActions;

class MainActions
{
    use Singleton;

    public AuthActions $AuthActions;

    private function __construct()
    {
        $this->AuthActions = AuthActions::getInstance();
    }
}
