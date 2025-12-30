<?php

namespace App\Filament\OperationEmployee\Widgets;

use App\Filament\OperationEmployee\Resources\InspectionReports\InspectionReportResource;
use App\Models\Reservation ;
use Filament\Actions\Action as ActionsAction;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\Action;

class RecentReservations extends TableWidget

{
protected static ?string $heading = 'Pickup Vehicles Need To Inspect';
    // Optional: Use this to make it the first or last thing on the page
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Show only the 5 most recent reservations
                Reservation::query()->where('status','pending')->latest()->limit(5)
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
                ActionsAction::make('create_inspection')
                    ->label('Inspect')
                    ->icon('heroicon-m-clipboard-document-check')
                    ->color('success')
                    // This generates the URL: /admin/inspection-reports/create?reservation_id=5
                    ->url(fn (Reservation $record): string =>
                        InspectionReportResource::getUrl('create', [
                            'reservation_id' => $record->id,
                            'type'=>'pickup'
                        ])
                    )
]);

    }
}
