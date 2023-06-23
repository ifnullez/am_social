<?php
namespace Core;

use Core\Controllers\Base\{Router, Views};
use Core\Controllers\Base\Actions\MainActions;
use Core\Controllers\Base\Filters\MainFilters;

final class Init {
    public MainActions $actions;
    public MainFilters $filters;
    public Router $router;
    public Views $views;

    public function __construct()
    {
        $this->actions = MainActions::getInstance();
        $this->filters = MainFilters::getInstance();
        $this->router = Router::getInstance();
        $this->views = Views::getInstance();
    }
}
