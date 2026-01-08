<?php

namespace App\Filament\BookingAgent\Resources\Reservations\Pages;

use App\Filament\BookingAgent\Resources\Reservations\ReservationResource;
use App\Models\Payment;
use Filament\Resources\Pages\CreateRecord;

class CreateReservation extends CreateRecord
{
    protected static string $resource = ReservationResource::class;
protected function afterCreate(): void
    {
        // 1. Get ALL data from the form (including non-database fields)
        $data = $this->form->getRawState();

        // 2. The $this->record is your newly saved Reservation
        $reservation = $this->record;

        // 3. Create the Payment manually
        $payemnt = Payment::create([
            'reservations_id'  => $reservation->id,
            'amount'           => $reservation->total_price,
            'payment_method'   => $data['payment_method'], // Taken directly from the form
            'payment_source'   => $data['payment_source'] ?? 'in-person',
            'processed_by'     => $data['processed_by'],
            'transaction_id'   => $data['transaction_id'] ?? null,
            'paied_at'         => now(),
        ]);

        if(true){
            $payemnt->update([
            'status'=>'paid'
        ]);
        }


    }
}
