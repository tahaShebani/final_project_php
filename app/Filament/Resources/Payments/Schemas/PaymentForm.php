<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Select::make('payment_source')
                    ->options(['online' => 'Online', 'in-person' => 'In person'])
                    ->required(),
                Select::make('payment_method')
                    ->options(['cash' => 'Cash', 'card' => 'Card'])
                    ->required(),
                TextInput::make('processed_by')
                    ->required()
                    ->numeric(),
                Select::make('transaction_id')
                    ->relationship('transaction', 'id')
                    ->default(null),
                DateTimePicker::make('paied_at')
                    ->required(),
                TextInput::make('resevation_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('reservations_id')
                    ->numeric()
                    ->default(null),
            ]);
    }
}
