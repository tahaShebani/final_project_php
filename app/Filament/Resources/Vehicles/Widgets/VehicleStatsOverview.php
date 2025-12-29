<?php

namespace App\Filament\Resources\Vehicles\Widgets;

use App\Models\Vehicle;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VehicleStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Available', Vehicle::where('status', 'available')->count())
                ->color('success')
                ->icon('heroicon-m-check-circle'),

            Stat::make('Maintenance', Vehicle::where('status', 'maintenance')->count())
                ->color('warning')
                ->icon('heroicon-m-wrench'),

            Stat::make('Out of Service', Vehicle::where('status', 'out_of_service')->count())
                ->color('danger')
                ->icon('heroicon-m-x-circle'),
            Stat::make('Reserved', Vehicle::where('status', 'reserved')->count())
                ->color('danger')
                ->icon('heroicon-m-x-circle'),

            Stat::make('Rented', Vehicle::where('status', 'rented')->count())
                ->color('danger')
                ->icon('heroicon-m-x-circle'),
        ];
    }
}
