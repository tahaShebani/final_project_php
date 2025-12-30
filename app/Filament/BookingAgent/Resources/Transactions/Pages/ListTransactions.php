<?php

namespace App\Filament\BookingAgent\Resources\Transactions\Pages;

use App\Filament\BookingAgent\Resources\Transactions\TransactionResource;
use App\Filament\BookingAgent\Resources\Transactions\Widgets\TransactionOverview;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTransactions extends ListRecords
{
    protected static string $resource = TransactionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    
    protected function getHeaderWidgets(): array
    {
        return [
            TransactionOverview::class,
        ];
    }
}
