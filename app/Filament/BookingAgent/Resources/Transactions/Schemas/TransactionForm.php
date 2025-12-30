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

    if($reservationId){
        $reservation = Reservation::find($reservationId);

        $set('total_amount', $reservation->total_price);
        $set('vehicle_id', $reservation->vehicle_id);
        $set('customer_id', $reservation->customer_id);

        $set('pickup_location_id', $reservation->pickup_location_id);
        $set('return_location_id', $reservation->dropoff_location_id);

    }else{
       $pickup = $get('actual_pickup_at');
    $return = $get('actual_return_at');
    $vehicleId = $get('vehicle_id');

    if (!$pickup || !$return || !$vehicleId) {
        $set('total_amount', 0);
        return;
    }

    $startDate = Carbon::parse($pickup);
    $endDate = Carbon::parse($return);

    $days = $startDate->diffInDays($endDate);
    $days = $days < 1 ? 1 : $days;


    $vehicle = Vehicle::find($vehicleId);
    $pricePerDay = $vehicle?->price ?? 0;

    $set('total_amount', number_format($days * $pricePerDay, 2, '.', ''));
    }






}
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('reservation_id')
                    ->relationship('reservation', 'id')
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
                    ->dehydrated()
                    ->required(),
                Select::make('vehicle_id')
                    ->relationship('vehicle', 'vin')
                    ->afterStateHydrated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ->live()
                    ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ->required(),
                Select::make('customer_id')
                    ->relationship('customer', 'full_name')
                    ->afterStateHydrated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ->live()
                    ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ->required(),
                    Select::make('payment_method')
                    ->options(['cash' => 'Cash', 'card' => 'Card']),
                TextInput::make('total_amount')
                ->afterStateHydrated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ->required()
                    ->numeric()
                    ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set)),
                DateTimePicker::make('actual_pickup_at')
                ->afterStateHydrated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                ->live()
                ->default(now())
                    ->required(),
                DateTimePicker::make('actual_return_at'),
                Select::make('pickup_location_id')
                ->live()
                    ->relationship('pickupLocation', 'name')
                    ->afterStateHydrated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ->required(),
                Select::make('return_location_id')
                    ->relationship('returnLocation', 'name')
                    ->afterStateHydrated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ->live()
                    ->required(),
                Select::make('status')
                    ->options(['open' => 'Open', 'closed' => 'Closed'])
                    ->required(),
            ]);
    }
}
