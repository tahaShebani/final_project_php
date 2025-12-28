<?php

namespace App\Filament\BookingAgent\Resources\Reservations\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ReservationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('customer_id')
                    ->relationship('customer', 'id')
                    ->required(),
                Select::make('vehicle_id')
                    ->relationship('vehicle', 'id')
                    ->required(),
                Select::make('pickup_location_id')
                    ->relationship('pickupLocation', 'name')
                    ->required(),
                Select::make('dropoff_location_id')
                    ->relationship('dropoffLocation', 'name')
                    ->required(),
                DateTimePicker::make('reserved_at')
                    ->required(),
                DateTimePicker::make('expires_at'),
                DateTimePicker::make('pickup_date')
                    ->required(),
                DateTimePicker::make('return_date')
                    ->required(),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'confirmed' => 'Confirmed', 'cancelled' => 'Cancelled'])
                    ->required(),
                TextInput::make('total_price')
                    ->required()
                    ->numeric(),
            ]);
    }
}
