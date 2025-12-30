<?php

namespace App\Filament\BookingAgent\Resources\Vehicles\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class VehicleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('carModel.model_name')
                    ->numeric(),
                 TextEntry::make('carModel.year'),
                TextEntry::make('vin'),
                TextEntry::make('license_plate'),
                TextEntry::make('color'),
                TextEntry::make('mileage')
                    ->numeric(),
                TextEntry::make('price')
                    ->money(),
                TextEntry::make('status'),
                TextEntry::make('currentLocation.name')
                ->label('Current Location')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('deleted_at')
                    ->dateTime(),
            ]);
    }
}
