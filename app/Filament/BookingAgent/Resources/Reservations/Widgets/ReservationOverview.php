<?php

namespace App\Filament\BookingAgent\Resources\Reservations\Widgets;

use App\Models\Reservation;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ReservationOverview extends StatsOverviewWidget
{
   protected function getStats(): array
{
    return [
        Stat::make('Pending', Reservation::where('status', 'pending')->count())
            ->color('warning')
            ->icon('heroicon-m-clock')
            ->description('Awaiting action'),

        Stat::make('Confirmed', Reservation::where('status', 'confirmed')->count())
            ->color('success')
            ->icon('heroicon-m-check-badge')
            ->description('Active bookings'),

        Stat::make('Cancelled', Reservation::where('status', 'cancelled')->count())
            ->color('gray')
            ->icon('heroicon-m-x-circle')
            ->description('Voided reservations'),

        Stat::make('Re-reserve', Reservation::where('status', 'rereserve')->count())
            ->color('danger')
            ->icon('heroicon-m-arrow-path-rounded-square')
            ->description(' Need Vehicle swap'),
    ];
}
}
