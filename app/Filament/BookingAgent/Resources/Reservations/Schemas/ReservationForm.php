<?php

namespace App\Filament\BookingAgent\Resources\Reservations\Schemas;

use App\Models\Location;
use App\Models\Reservation;
use App\Models\Vehicle;
use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Forms\Form;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Auth;

class ReservationForm
{

 public static function vehicleChose(Get $get, Set $set): void
{

    $vehicleId = request('vehicle_id');
    $locationId = request('pickup_location_id');
        if (!$vehicleId) return;

        $vehicle = Vehicle::findOrFail($vehicleId);
        $disabledDates=$vehicle->disabledDates();

        if ($vehicle) {
            $set('vehicle_id', $vehicle->id);
            if($vehicle->status=='available'){
             $set('pickup_location_id', $locationId);
            }else{
            $set('pickup_location_id', $vehicle->returned_at_id);
            }

        }
}

    public static function updateTotalPrice(Get $get, Set $set): void
{
    $pickup = $get('pickup_date');
    $return = $get('return_date');
    $vehicleId = $get('vehicle_id');

    if (!$pickup || !$return || !$vehicleId) {
        $set('total_price', 0);
        return;
    }



    $startDate = Carbon::parse($pickup);
    $endDate = Carbon::parse($return);

    $days = $startDate->diffInDays($endDate);
    $days = $days < 1 ? 1 : $days;


    $vehicle = Vehicle::find($vehicleId);
    $pricePerDay = $vehicle?->price ?? 0;
    $location=$vehicle->current_location_id;
    $set('pickup_location_id', $location);
    $set('total_price', number_format($days * $pricePerDay, 2, '.', ''));
}
    public static function configure(Schema $schema): Schema
    {

        return $schema
            ->components([
                Select::make('customer_id')
                    ->relationship('customer', 'full_name')
                    ->searchable()
                    ->required(),
                    Select::make('processed_by')
                    ->label('Processed By')
                    ->default(Auth::user()->id)
                    ->disabled(fn () => !(Auth::user()->role=='admin'))
                    ->relationship('processedBy', 'full_name')
                    ->required(),
                Select::make('vehicle_id')
                    ->relationship('vehicle', 'vin')
                    ->searchable()
                    ->live()
                    ->required()
                    ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ->afterStateHydrated(fn (Get $get, Set $set) => self::vehicleChose($get, $set)),
                Select::make('pickup_location_id')
                    ->relationship('pickupLocation', 'name')
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ->afterStateHydrated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ->afterStateHydrated(fn (Get $get, Set $set) => self::vehicleChose($get, $set))
                    ->required(),
                Select::make('dropoff_location_id')
                    ->relationship('dropoffLocation', 'name')
                    ->required(),
                DateTimePicker::make('reserved_at')
                    ->default(now())
                    ->readOnly()
                    ->required(),
                DateTimePicker::make('pickup_date')
                ->live()
                ->native(false)
                ->minDate(now())
                ->disabledDates(function (Get $get) {
                    $vehicleId = $get('vehicle_id');
                    if (!$vehicleId) return [];

                    $vehicle = Vehicle::findOrFail($vehicleId);
                    return $vehicle ? $vehicle->disabledDates() : [];
                })
                ->required()
                ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set)),
                DateTimePicker::make('return_date')
                ->live()
                ->native(false)
                ->disabledDates(function (Get $get) {
                    $vehicleId = $get('vehicle_id');
                    if (!$vehicleId) return [];

                    $vehicle = Vehicle::findOrFail($vehicleId);
                    return $vehicle ? $vehicle->disabledDates() : [];
                })
                ->required()
                ->disabled(fn (Get $get): bool => empty($get('pickup_date')))
                ->minDate(fn (Get $get) => $get('pickup_date')? Carbon::parse($get('pickup_date'))->addDay(): null)
                ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set)),
                Select::make('status')
                ->searchable()
                    ->options([ 'pending' => 'Pending','cancelled' => 'Cancelled'])
                    ->default('pending')
                    ->required(),
                    Select::make('payment_method')
                    ->options(['cash' => 'Cash', 'card' => 'Card'])
                    ->required(),
                TextInput::make('total_price')
                    ->required()
                    ->step(0.01)
                    ->numeric(),
            ]);
    }

}
