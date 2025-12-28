<?php

namespace App\Filament\BookingAgent\Resources\Reservations\Pages;

use App\Filament\BookingAgent\Resources\Reservations\ReservationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateReservation extends CreateRecord
{
    protected static string $resource = ReservationResource::class;
}
