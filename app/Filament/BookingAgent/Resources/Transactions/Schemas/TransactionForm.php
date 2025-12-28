<?php

namespace App\Filament\BookingAgent\Resources\Transactions\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('reservation_id')
                    ->relationship('reservation', 'id')
                    ->required(),
                Select::make('vehicle_id')
                    ->relationship('vehicle', 'id')
                    ->required(),
                Select::make('customer_id')
                    ->relationship('customer', 'id')
                    ->required(),
                TextInput::make('total_amount')
                    ->required()
                    ->numeric(),
                DateTimePicker::make('actual_pickup_at')
                    ->required(),
                DateTimePicker::make('actual_return_at'),
                Select::make('pickup_location_id')
                    ->relationship('pickupLocation', 'name')
                    ->required(),
                Select::make('return_location_id')
                    ->relationship('returnLocation', 'name')
                    ->required(),
                Select::make('status')
                    ->options(['open' => 'Open', 'closed' => 'Closed'])
                    ->required(),
            ]);
    }
}
