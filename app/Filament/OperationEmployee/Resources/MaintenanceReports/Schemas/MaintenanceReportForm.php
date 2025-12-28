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
                    ->relationship('vehicle', 'id')
                    ->required(),
                Select::make('employee_id')
                    ->relationship('employee', 'id')
                    ->required(),
                DateTimePicker::make('entered_at')
                    ->required(),
                DateTimePicker::make('exited_at'),
                TextInput::make('cost')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Textarea::make('descriptopn')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
