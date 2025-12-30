<?php

namespace App\Filament\BookingAgent\Resources\Transactions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TransactionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reservation.id')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('vehicle.vin')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('customer.full_name')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('total_amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('actual_pickup_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('actual_return_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('pickupLocation.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('returnLocation.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status'),
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
            ]);
    }
}
