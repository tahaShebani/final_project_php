<?php

namespace App\Providers;

use App\Models\InspectionReport;
use App\Models\MaintenanceReport;
use App\Models\Reservation;
use App\Models\Transaction;
use App\Observers\InspectionReportObserver;
use App\Observers\MaintenanceReportObserver;
use App\Observers\ReservationObserver;
use App\Observers\TransactionObserver;
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
         Transaction::observe(TransactionObserver::class);
          Reservation::observe(ReservationObserver::class);
    }
}
