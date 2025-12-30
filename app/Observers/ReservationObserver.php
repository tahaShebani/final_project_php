<?php

namespace App\Observers;

use App\Models\Payment;
use App\Models\Reservation;

class ReservationObserver
{
    /**
     * Handle the Reservation "created" event.
     */
    public function created(Reservation $reservation): void
    {
        if($reservation->processed_by){
        Payment::create([
        'amount'=> $reservation->total_price,
        'payment_source'=>'online',
        'payment_method'=>'card',
        'processed_by'=>null,
        'transaction_id'=>null,
        'reservations_id'=>$reservation->id,
        'paied_at'=>$reservation->reserved_at,
        ]);
        }

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
