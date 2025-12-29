<?php

namespace App\Filament\Resources\Users\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Customers', User::where('role', 'customer')->count())
                ->description('Registered clients')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            Stat::make('Operational Employees', User::where('role', 'operation_employee')->count())
                ->description('Staff handling fleet')
                ->descriptionIcon('heroicon-m-briefcase')
                ->color('success'),

            Stat::make('Booking Agents', User::where('role', 'booking_agent')->count())
                ->description('Sales & reservations')
                ->descriptionIcon('heroicon-m-ticket')
                ->color('warning'),
        ];
    }
}
