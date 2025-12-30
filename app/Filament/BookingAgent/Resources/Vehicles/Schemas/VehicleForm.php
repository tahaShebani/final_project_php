<?php

namespace App\Filament\BookingAgent\Resources\Vehicles\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VehicleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('car_model')
                    ->required()
                    ->numeric(),
                TextInput::make('vin')
                    ->required(),
                TextInput::make('license_plate')
                    ->required(),
                TextInput::make('color')
                    ->required(),
                TextInput::make('mileage')
                    ->required()
                    ->numeric(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Select::make('status')
                    ->options([
            'available' => 'Available',
            'reserved' => 'Reserved',
            'rented' => 'Rented',
            'maintenance' => 'Maintenance',
            'out_of_service' => 'Out of service',
        ])
                    ->required(),
                Select::make('current_location_id')
                    ->relationship('currentLocation', 'name')
                    ->required(),
            ]);
    }
}
