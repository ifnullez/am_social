<?php
namespace Core\Controllers\Base\Filters;

use Core\Controllers\Base\Filters\{DashboardFilters, AuthFilters};
use Core\Traits\Singleton;

final class MainFilters
{
    use Singleton;

    public DashboardFilters $dashboardFilters;
    public AuthFilters $authFilters;

    private function __construct()
    {
        $this->dashboardFilters = DashboardFilters::getInstance();
        $this->authFilters = AuthFilters::getInstance();
    }

}
