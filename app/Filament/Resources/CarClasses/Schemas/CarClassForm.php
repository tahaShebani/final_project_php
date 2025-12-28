<?php

namespace App\Filament\Resources\CarClasses\Schemas;

use App\Models\CarClass;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CarClassForm
{
    public static function configure(Schema $schema): Schema
    {
          $carclassesName = CarClass::all('class');
        return $schema
            ->components([
                TextInput::make('class')
                    ->required(),
                FileUpload::make('image_path')

                    ->image()
    ->disk('public') // This points to storage/app/public
    ->directory('cars') // Files will be in storage/app/public/uploads
    ->visibility('public'),
            ]);
    }
}
