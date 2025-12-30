<?php

namespace App\Observers;

use App\Models\InspectionReport;

class InspectionReportObserver
{
    /**
     * Handle the InspectionReport "created" event.
     */
    public function created(InspectionReport $inspectionReport): void
    {
        $vehicle = $inspectionReport->vehicle;
        $reservation = $inspectionReport->reservation;

        if ($vehicle) {

            $status='available';
            if($inspectionReport->status=='out_of_service'){
                $status='out_of_service';
            }else if($inspectionReport->status=='needs_maintenance'){
                       $status= 'maintenance';
            }
            $vehicle->update([
                'mileage' => $inspectionReport->mileage,

                'status'  => $status,
            ]);
        }
            if ($reservation) {


            if($inspectionReport->status=='out_of_service' || $inspectionReport->status=='needs_maintenance'){
                $reservation->update([


                'status'  => 'rereserve',
            ]);
            }else{
            $reservation->update([


                'status'  => 'confirmed',
            ]);
             $vehicle->update([


                'status'  => 'reserved',
            ]);
            }

        }
        $transaction=$reservation->transaction;
        if ($transaction && $transaction->status=='need_inspaction') {
                $transaction->update([
                'status'  => 'closed',
            ]);
        }
    }

    /**
     * Handle the InspectionReport "updated" event.
     */
    public function updated(InspectionReport $inspectionReport): void
    {
               $vehicle = $inspectionReport->vehicle;

        if ($vehicle) {
            // 2. Update the vehicle's mileage and status
            // Assuming your report has 'mileage' and 'status' fields
            $status='available';
            if($inspectionReport->status=='out_of_service'){
                $status='out_of_service';
            }else if($inspectionReport->status=='needs_maintenance'){
                       $status= 'maintenance';
            }
            $vehicle->update([
                'mileage' => $inspectionReport->mileage,

                'status'  => $status,
            ]);
        }
    }

    /**
     * Handle the InspectionReport "deleted" event.
     */
    public function deleted(InspectionReport $inspectionReport): void
    {
        //
    }

    /**
     * Handle the InspectionReport "restored" event.
     */
    public function restored(InspectionReport $inspectionReport): void
    {
        //
    }

    /**
     * Handle the InspectionReport "force deleted" event.
     */
    public function forceDeleted(InspectionReport $inspectionReport): void
    {
        //
    }
}
