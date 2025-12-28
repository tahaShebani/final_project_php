<?php

namespace App\Filament\OperationEmployee\Resources\InspectionReports\Pages;

use App\Filament\OperationEmployee\Resources\InspectionReports\InspectionReportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInspectionReports extends ListRecords
{
    protected static string $resource = InspectionReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
