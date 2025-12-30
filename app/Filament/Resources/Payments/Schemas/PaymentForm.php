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
                    ->options([ 'in-person' => 'In person'])
                    ->required(),
                Select::make('payment_method')
                    ->options(['cash' => 'Cash', 'card' => 'Card'])
                    ->required(),
                    Select::make('processed_by')
                    ->label('Processed By')
                    ->relationship('processedBy', 'full_name')
                    ->required(),
                DateTimePicker::make('paied_at')
                    ->required(),
                    Select::make('For')
                        ->options([
                            'transaction' => 'Transaction ',
                            'reservation' => 'Reservation',
                        ])
                    ->dehydrated(false)
                    ->required()
                    ->live(),
                Select::make('transaction_id')
                    ->relationship('transaction', 'id')
                    ->default(null)
                    ->visible(fn ($get) => $get('For') === 'transaction'),

                Select::make('reservations_id')
                    ->relationship('reservation', 'id')
                    ->default(null)
                    ->visible(fn ($get) => $get('For') === 'reservation'),
            ]);
    }
}
