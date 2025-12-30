<?php

namespace App\Filament\BookingAgent\Resources\Reservations\Pages;

use App\Filament\BookingAgent\Resources\Reservations\ReservationResource;
use App\Filament\BookingAgent\Resources\Reservations\Widgets\ReservationOverview;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReservations extends ListRecords
{
    protected static string $resource = ReservationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
        protected function getHeaderWidgets(): array
    {
        return [
            ReservationOverview::class,
        ];
    }
}
