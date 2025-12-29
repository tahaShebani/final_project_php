<?php

namespace App\Filament\OperationEmployee\Resources\InspectionReports\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class InspectionReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('vehicle_id')
                    ->relationship('vehicle', 'vin')
                    ->required(),
                Select::make('reservation_id')
                    ->relationship('reservation', 'id')
                    ->required(),
                Select::make('inspector_id')
                    ->relationship('inspector', 'full_name')
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
