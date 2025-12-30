<?php

namespace App\Filament\BookingAgent\Widgets;

use App\Filament\BookingAgent\Resources\Reservations\ReservationResource;
use App\Models\Reservation ;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class RereservationTable extends TableWidget
{
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
       return $table
            ->query(
                // Show only the 5 most recent reservations
                Reservation::query()->where('status','rereserv')->latest()->limit(5)
            )
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('customer.full_name')->searchable(),
                TextColumn::make('vehicle.vin')->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'rereserv' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('Booked At')
                    ->dateTime(),
                ])->actions([
                Action::make('Rereserv')
                    ->label('Rereserv')
                    ->icon('heroicon-m-clipboard-document-check')
                    ->color('success')
                    ->url(fn (Reservation $record): string =>
                        ReservationResource::getUrl('edite', [
                            'id' => $record->id,
                        ])
                    )
]);

    }
}
