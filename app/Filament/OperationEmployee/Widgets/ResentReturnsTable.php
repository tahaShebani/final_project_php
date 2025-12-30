<?php

namespace App\Filament\OperationEmployee\Widgets;

use App\Filament\OperationEmployee\Resources\InspectionReports\InspectionReportResource;
use App\Models\Transaction ;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Filament\Actions\Action as ActionsAction;

class ResentReturnsTable extends TableWidget
{
    protected static ?string $heading = 'Return Vehicles Need To Inspect';
    // Optional: Use this to make it the first or last thing on the page
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Show only the 5 most recent reservations
                Transaction::query()->where('status','need_inspaction')->latest()->limit(5)
            )
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('customer.full_name')->searchable(),
                TextColumn::make('vehicle.vin')->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'need_inspaction' => 'warning',
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
                    ->url(fn (Transaction $record): string =>
                        InspectionReportResource::getUrl('create', [
                            'reservation_id' => $record->reservation_id,
                            'type'=>'return'
                        ])
                    )
]);

    }
}
