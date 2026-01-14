<?php

namespace App\Filament\BookingAgent\Resources\Transactions\Schemas;

use App\Models\Reservation;
use App\Models\Vehicle;
use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class TransactionForm
{
public static function updateTotalPrice(Get $get, Set $set): void
{

   $reservationId = $get('reservation_id');
   if(!(Auth::user()->role=='admin'))
    $set('processed_by', Auth::user()->id);
    if($reservationId){
        $reservation = Reservation::find($reservationId);

        $set('vehicle_id', $reservation->vehicle_id);
        $set('customer_id', $reservation->customer_id);

        $set('pickup_location_id', $reservation->pickup_location_id);
        $set('return_location_id', $reservation->dropoff_location_id);

    }

}
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('reservation_id')
                    ->relationship('reservation', 'id')
                    ->searchable()
                    ->required()
                    ->live()
                    ->default(fn () => request()->query('reservations_id'))
                    ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ->afterStateHydrated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ,
                    Select::make('processed_by')
                    ->label('Processed By')
                    ->relationship('processedBy', 'full_name')
                    ->default(Auth::user()->id??null)
                    ->disabled(fn () => !(Auth::user()->role=='admin'))
                    ->afterStateHydrated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ->dehydrated()
                    ->required(),
                Select::make('vehicle_id')
                    ->relationship('vehicle', 'vin')
                    ->searchable()
                    ->afterStateHydrated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ->live()
                    ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ->required(),
                Select::make('customer_id')
                    ->relationship('customer', 'full_name')
                    ->disabled()
                    ->dehydrated()
                    ->afterStateHydrated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ->live()
                    ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ->required(),
                    Select::make('payment_method')
                    ->options(['cash' => 'Cash', 'card' => 'Card']),
                    Select::make('payment_source')
                    ->options(['online' => 'Online', 'in-person' => 'In-Person']),
                TextInput::make('total_amount')
                ->label('Extra Fees')
                ->default(0)
                    ->required()
                    ->numeric()
                    ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set)),
                DateTimePicker::make('actual_pickup_at')
                ->live()
                ->disabled(fn (string $context): bool => $context === 'edit')
                ->dehydrated()
                ->default(now())
                    ->required(),
                DateTimePicker::make('actual_return_at')
                ->disabled(fn (string $context): bool => $context === 'create')
                ->dehydrated()
                ,
                Select::make('pickup_location_id')
                ->live()
                    ->relationship('pickupLocation', 'name')
                    ->disabled(fn (string $context): bool => $context === 'edit')
                    ->dehydrated()
                    ->afterStateHydrated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ->required(),
                Select::make('return_location_id')
                    ->relationship('returnLocation', 'name')
                    ->afterStateHydrated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ->live()
                    ->required(),
                Select::make('status')
                    ->options(['open' => 'Open', 'need_inspaction' => 'Need Inspaction'])
                    ->required(),
            ]);
    }
}
