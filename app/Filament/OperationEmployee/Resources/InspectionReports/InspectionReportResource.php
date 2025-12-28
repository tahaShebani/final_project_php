<?php

namespace App\Filament\OperationEmployee\Resources\InspectionReports;

use App\Filament\OperationEmployee\Resources\InspectionReports\Pages\CreateInspectionReport;
use App\Filament\OperationEmployee\Resources\InspectionReports\Pages\EditInspectionReport;
use App\Filament\OperationEmployee\Resources\InspectionReports\Pages\ListInspectionReports;
use App\Filament\OperationEmployee\Resources\InspectionReports\Schemas\InspectionReportForm;
use App\Filament\OperationEmployee\Resources\InspectionReports\Tables\InspectionReportsTable;
use App\Models\InspectionReport;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InspectionReportResource extends Resource
{
    protected static ?string $model = InspectionReport::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'InspectionReport';

    public static function form(Schema $schema): Schema
    {
        return InspectionReportForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InspectionReportsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInspectionReports::route('/'),
            'create' => CreateInspectionReport::route('/create'),
            'edit' => EditInspectionReport::route('/{record}/edit'),
        ];
    }
}
