<?php

namespace App\Filament\BookingAgent\Resources\Vehicles\Pages;

use App\Filament\BookingAgent\Resources\Vehicles\VehicleResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewVehicle extends ViewRecord
{
    protected static string $resource = VehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            
        ];
    }
}
