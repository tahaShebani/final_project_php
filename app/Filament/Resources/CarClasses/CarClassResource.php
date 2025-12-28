<?php

namespace App\Filament\Resources\CarClasses;

use App\Filament\Resources\CarClasses\Pages\CreateCarClass;
use App\Filament\Resources\CarClasses\Pages\EditCarClass;
use App\Filament\Resources\CarClasses\Pages\ListCarClasses;
use App\Filament\Resources\CarClasses\Schemas\CarClassForm;
use App\Filament\Resources\CarClasses\Tables\CarClassesTable;
use App\Models\CarClass;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CarClassResource extends Resource
{
    protected static ?string $model = CarClass::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'CarClass';

    public static function form(Schema $schema): Schema
    {
        return CarClassForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CarClassesTable::configure($table);
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
            'index' => ListCarClasses::route('/'),
            'create' => CreateCarClass::route('/create'),
            'edit' => EditCarClass::route('/{record}/edit'),
        ];
    }
}
