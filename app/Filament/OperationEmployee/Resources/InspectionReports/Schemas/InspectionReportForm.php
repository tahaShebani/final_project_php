<?php

namespace App\Filament\OperationEmployee\Resources\InspectionReports\Schemas;

use App\Models\Reservation;
use App\Models\Vehicle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class InspectionReportForm
{
    public static function updateTotalPrice(Get $get, Set $set): void
{
    $reservationId = $get('reservation_id');
    $type = $get('type');

    if (!$reservationId) return;
         $set('type', $type);
        $reservation = Reservation::find($reservationId);

        if ($reservation) {
            $set('vehicle_id', $reservation->vehicle_id);
        }


    $reservation = Reservation::find($reservationId);

    $set('vehicle_id', $reservation->vehicle_id);
}
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('vehicle_id')
                    ->relationship('vehicle', 'vin')
                    ->disabled(fn () => !(Auth::user()->role=='admin'))
                    ->required()
                    ->dehydrated(true)
                    ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ->afterStateHydrated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set)),
                Select::make('reservation_id')
                    ->relationship('reservation', 'id')
                    ->default(fn () => Request::query('reservation_id'))
                    ->disabled(fn () => !(Auth::user()->role=='admin'))
                    ->dehydrated(true)
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set))
                    ->afterStateHydrated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set)),
                Select::make('inspector_id')
                    ->relationship('inspector', 'full_name')
                    ->default(Auth::user()->id)
                    ->disabled(fn () => !(Auth::user()->role=='admin'))
                    ->dehydrated(true)
                    ->required(),
                Select::make('type')
                    ->options(['pickup' => 'Pickup', 'return' => 'Return'])
                    ->required(),
                TextInput::make('fuel_level')
                    ->required()
                    ->numeric(),
                TextInput::make('mileage')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options([
            'excellent' => 'Excellent',
            'good' => 'Good',
            'fair' => 'Fair',
            'needs_cleaning' => 'Needs cleaning',
            'needs_maintenance' => 'Needs maintenance',
            'out_of_service' => 'Out of service',
        ])
                    ->required(),
                Textarea::make('notes')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
