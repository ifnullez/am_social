<?php
namespace Core;

use Core\Controllers\Base\{Actions, Filters, Router, Views};


final class Init {
    public Actions $actions;
    public Filters $filters;
    public Router $router;
    public Views $views;

    public function __construct()
    {
        $this->actions = new Actions();
        $this->filters = new Filters();
        $this->router = new Router();
        $this->views = new Views();
    }
}