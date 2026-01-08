<?php

namespace App\Observers;

use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Vehicle;


class ReservationObserver
{
    /**
     * Handle the Reservation "created" event.
     */
    public function created(Reservation $reservation): void
    {
        $vehicle = Vehicle::where('id', $reservation->vehicle_id);
        $vehicle->update([
            'status'=>'reserved',
            'reserved_until'=> $reservation->return_date,
            'returned_at_id'=>$reservation->dropoff_location_id,
        ]);


    }

    /**
     * Handle the Reservation "updated" event.
     */
    public function updated(Reservation $reservation): void
    {
        //
    }

    /**
     * Handle the Reservation "deleted" event.
     */
    public function deleted(Reservation $reservation): void
    {
        //
    }

    /**
     * Handle the Reservation "restored" event.
     */
    public function restored(Reservation $reservation): void
    {
        //
    }

    /**
     * Handle the Reservation "force deleted" event.
     */
    public function forceDeleted(Reservation $reservation): void
    {
        //
    }
}
