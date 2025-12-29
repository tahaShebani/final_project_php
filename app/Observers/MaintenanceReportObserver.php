<?php

namespace App\Observers;

use App\Models\MaintenanceReport;

class MaintenanceReportObserver
{
    /**
     * Handle the MaintenanceReport "created" event.
     */
    public function created(MaintenanceReport $maintenanceReport): void
    {
        //
    }

    /**
     * Handle the MaintenanceReport "updated" event.
     */
    public function updated(MaintenanceReport $maintenanceReport): void
    {
        $vehicle = $maintenanceReport->vehicle;
        if($maintenanceReport->exited_at){
             if ($vehicle) {

            $vehicle->update([
                'status'  => 'available',
            ]);
        }
        }
    }

    /**
     * Handle the MaintenanceReport "deleted" event.
     */
    public function deleted(MaintenanceReport $maintenanceReport): void
    {
        //
    }

    /**
     * Handle the MaintenanceReport "restored" event.
     */
    public function restored(MaintenanceReport $maintenanceReport): void
    {
        //
    }

    /**
     * Handle the MaintenanceReport "force deleted" event.
     */
    public function forceDeleted(MaintenanceReport $maintenanceReport): void
    {
        //
    }
}
