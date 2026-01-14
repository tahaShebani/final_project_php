<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\Location;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        $locationsName = Location::all('name');


        return $schema
            ->components([
                TextInput::make('full_name')
                    ->required(),

                TextInput::make('phone_number')
                    ->tel()
                    ->required(),

                Select::make('role')
                    ->options([
            'operation_employee' => 'Operation employee',
            'booking_agent' => 'Booking agent',
            'customer' => 'Customer',
                            ])->live()->required(),



                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->required(),
                                Section::make('Employee Information')
                ->schema([
                    TextInput::make('employee_id')->required(),
                    TextInput::make('department')->required(),
                    DateTimePicker::make('hire_date')->required(),
                    TextInput::make('job_title')->required(),
                    Select::make('location')
                    ->options($locationsName)->live()->required(),
                ])->columnSpanFull()
                ->columns(2)
                ->visible(fn (Get $get) => $get('role') === 'booking_agent' || $get('role') === 'operation_employee'),

            Section::make('Customer Information')
                ->schema([
                    TextInput::make('driver_license_number'),
                    DateTimePicker::make('license_expiry_date'),
                    DateTimePicker::make('date_of_birth'),
                    TextInput::make('address'),
                ])->columnSpanFull()
                ->columns(2)
                ->visible(fn (Get $get) => $get('role') === 'customer'),
            ]);
    }
}
