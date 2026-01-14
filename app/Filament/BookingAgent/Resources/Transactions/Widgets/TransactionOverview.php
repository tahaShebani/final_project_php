<?php

namespace App\Filament\BookingAgent\Resources\Transactions\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TransactionOverview extends StatsOverviewWidget
{
    protected int | string | array $columnSpan = 'full';
    protected function getStats(): array
    {
       return [
            Stat::make('Open Transactions', Transaction::where('status', 'open')->count())
                ->description('Still rented')
                ->descriptionIcon('heroicon-m-clock')
                ->color('waiting'),

            Stat::make('Closed Transactions', Transaction::where('status', 'closed')->count())
                ->description('Completed successfully')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Need Inspactions', Transaction::where('status', 'need_inspaction')->count())
                ->description('Need to be tested')
                ->descriptionIcon('heroicon-m-clock')
                ->color('waiting'),
        ];
    }
}
