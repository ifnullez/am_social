<?php
namespace Core\Controllers\Base\Filters;

use Core\Traits\Singleton;
use Core\Controllers\Base\Views;

class DashboardFilters
{
    use Singleton;
    private function __construct()
    {
        add_filter("ams_dashboard_header", [$this, "amsDashboardHeader"]);
    }

    public function amsDashboardHeader(): void
    {
        if(!empty(Views::getInstance()->templates)){
            require_once(Views::getInstance()->templates . "/dashboard/header.php");
        }
    }
}
