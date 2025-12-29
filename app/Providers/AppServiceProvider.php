<?php

namespace App\Providers;

use App\Models\InspectionReport;
use App\Models\MaintenanceReport;
use App\Observers\InspectionReportObserver;
use App\Observers\MaintenanceReportObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        InspectionReport::observe(InspectionReportObserver::class);
        MaintenanceReport::observe(MaintenanceReportObserver::class);
    }
}
