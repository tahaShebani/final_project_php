<?php

namespace App\Filament\OperationEmployee\Resources\InspectionReports\Pages;

use App\Filament\OperationEmployee\Resources\InspectionReports\InspectionReportResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInspectionReport extends EditRecord
{
    protected static string $resource = InspectionReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
