<?php

namespace App\Filament\BookingAgent\Resources\Transactions\Pages;

use App\Filament\BookingAgent\Resources\Transactions\TransactionResource;
use App\Models\Payment;
use App\Models\Vehicle;
use Filament\Resources\Pages\CreateRecord;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    protected function afterCreate(): void
    {

        $data = $this->form->getRawState();


        $transaction = $this->record;

       if ($transaction && $transaction->vehicle) {
            $transaction->vehicle->update([
            'status' => 'rented',
        ]);
}

    }
}
