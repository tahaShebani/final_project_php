<?php

namespace App\Filament\Resources\Vehicles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VehicleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('car_model')
                        ->relationship('carModel', 'model_name')
                        ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->model_name} ({$record->year})")
                        ->searchable(['model_name', 'year'])
                        ->preload()
                        ->required(),
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
            'out_of_service' => 'Out Of Service',

        ])
                    ->required(),
                Select::make('current_location_id')
                    ->relationship('currentLocation', 'name')
                    ->required(),
            ]);
    }
}
