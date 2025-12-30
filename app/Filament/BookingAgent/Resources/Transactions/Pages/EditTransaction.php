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
            $transaction->vehicle->status='available';
        }
        if($data['payment_method']){
            $price=$transaction->total_amount-$transaction->resevation->total_price;
            Payment::create([
            'reservations_id'  => null,
            'amount'           => $price,
            'payment_method'   => $data['payment_method'], // Taken directly from the form
            'payment_source'   => 'in-person',
            'processed_by'     => $transaction->processed_by,
            'transaction_id'   => $transaction->id,
            'paied_at'         => now(),
        ]);
        }


    }
}
