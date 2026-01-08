<?php

namespace App\Filament\BookingAgent\Resources\Reservations\Tables;

use App\Filament\BookingAgent\Resources\Transactions\TransactionResource;
use App\Models\Reservation;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReservationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('customer.full_name')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('vehicle.vin')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('pickupLocation.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('dropoffLocation.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('reserved_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('expires_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('pickup_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('return_date')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('transaction.status')
                ->label('Rent Status')
                ->placeholder('No Rented Yet')
                ->searchable(),
                TextColumn::make('status')->searchable(),

                TextColumn::make('total_price')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                DeleteBulkAction::make(),
                ]),
            ])->actions([
                Action::make('pickup')
                    ->label('pickup')
                    ->icon('heroicon-m-key')
                    ->color('success')
                    // This generates the URL: /admin/inspection-reports/create?reservation_id=5
                    ->url(fn (Reservation $record): string =>
                        TransactionResource::getUrl('create', [
                            'reservations_id' => $record->id,
                        ])
                    )->visible(fn (Reservation $record) => ($record->status === 'confirmed'&&!($record->transaction))),
]);
    }
}
