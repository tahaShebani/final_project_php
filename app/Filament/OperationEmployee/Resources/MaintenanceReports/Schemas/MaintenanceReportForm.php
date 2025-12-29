<?php

namespace App\Filament\OperationEmployee\Resources\MaintenanceReports\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MaintenanceReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('vehicle_id')
                    ->relationship('vehicle', 'vin')
                    ->required(),
                Select::make('employee_id')
                    ->label('Employee')
                    ->relationship('employee', 'full_name')
                    ->required(),
                DateTimePicker::make('entered_at')
                    ->required(),
                DateTimePicker::make('exited_at'),
                TextInput::make('cost')

                    ->numeric()
                    ->prefix('$'),
                Textarea::make('descriptopn')

                    ->columnSpanFull(),
            ]);
    }
}
