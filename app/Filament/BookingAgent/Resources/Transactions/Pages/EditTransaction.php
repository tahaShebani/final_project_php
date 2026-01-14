<?php

namespace App\Filament\BookingAgent\Resources\Transactions\Pages;

use App\Filament\BookingAgent\Resources\Transactions\TransactionResource;
use App\Models\Payment;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTransaction extends EditRecord
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
    protected function afterSave(): void
    {
        $data = $this->form->getRawState();
        $transaction = $this->record;

        if($transaction->status=='closed'){
            if($transaction->vehicle->hasReservations()){
                 $transaction->vehicle->status='reserved';
            }else{
                 $transaction->vehicle->status='available';
            }

        }

        if($data['payment_method']){
            if($data['payment_source']=='in-person'){
            Payment::create([
            'reservations_id'  => $transaction->reservation_id,
            'amount'           => $transaction->total_amount,
            'payment_method'   => $data['payment_method'], // Taken directly from the form
            'payment_source'   => $data['payment_source'],
            'processed_by'     => $transaction->processed_by,
            'paied_at'         => now(),
            'status'           =>'paid'
        ]);
            }else{
            Payment::create([
            'reservations_id'  => $transaction->reservation_id,
            'amount'           => $transaction->total_amount,
            'payment_method'   => $data['payment_method'], // Taken directly from the form
            'payment_source'   => $data['payment_source'],
            'processed_by'     => $transaction->processed_by,
            'paied_at'         => now(),
             'status'           =>'unpaid'
        ]);
            }

        }


    }
}
