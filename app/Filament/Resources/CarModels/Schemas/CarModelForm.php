<?php

namespace App\Filament\Resources\CarModels\Schemas;

use App\Models\CarClass;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CarModelForm
{
    public static function configure(Schema $schema): Schema
    {

        return $schema
            ->components([
                Select::make('car_class')
    ->relationship('carClass', 'class')
    ->searchable()
    ->preload()
    ->required(),
                TextInput::make('brand')
                    ->required(),
                TextInput::make('model_name')
                    ->required(),
                TextInput::make('year')
                    ->required(),
                    Select::make('fuel_type')
                    ->options([
                   'Petrol'=>'Petrol',
                   'Diesel'=>'Diesel',
                   'Electric'=>'Electric',
                   'Hybrid'=>'Hybrid'
                         ])->required(),
                    Select::make('transmission')
                    ->options(        [
                        'Manual'=>'Manual',
                        'Automatic'=>'Automatic',
                        'CVT'=>'CVT',
                        'DCT'=>'DCT',
                        'AMT'=>'AMT',
                  ])->required(),

                TextInput::make('seating_capacity')
                    ->required()
                    ->numeric(),
                FileUpload::make('image_path')
                    ->image()
    ->disk('public')
    ->directory('carModels')
    ->visibility('public'),
            ]);
    }
}
