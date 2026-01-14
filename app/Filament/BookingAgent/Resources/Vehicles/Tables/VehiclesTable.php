<?php

namespace App\Filament\BookingAgent\Resources\Vehicles\Tables;

use App\Filament\BookingAgent\Resources\Reservations\ReservationResource;
use App\Models\Reservation;
use App\Models\Vehicle;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Actions\Action as ActionsAction;

class VehiclesTable
{
    public static function configure(Table $table): Table
    {
        return $table->query(
                Vehicle::query()->where('status','available')
            )
            ->columns([
                TextColumn::make('carModel.model_name')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                    TextColumn::make('carModel.year')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('vin')
                    ->searchable(),
                TextColumn::make('license_plate')
                    ->searchable(),
                TextColumn::make('color')
                    ->searchable(),
                TextColumn::make('mileage')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('price')
                    ->money()
                    ->sortable(),
                TextColumn::make('status')
                 ->searchable(),
                TextColumn::make('currentLocation.name')
                ->label('Current Location')
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
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
            ])->actions([
                ActionsAction::make('create_reservation')
                                    ->label('Reserve')
                    ->icon('heroicon-m-key')
                    ->color('success')
        ->url(fn ($record) => ReservationResource::getUrl('create', [
            'vehicle_id' => $record->id,
            'pickup_location_id' => $record->current_location_id,
        ]))
]);;
    }
}
