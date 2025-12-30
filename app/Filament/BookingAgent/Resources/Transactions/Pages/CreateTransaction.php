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
        // 1. Get ALL data from the form (including non-database fields)
        $data = $this->form->getRawState();

        // 2. The $this->record is your newly saved Reservation
        $transaction = $this->record;

        $transaction->vehicle->status='rented';

        // 3. Create the Payment manually

    }
}
