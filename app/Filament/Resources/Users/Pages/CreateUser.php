<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Models\Location;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        // 1. Separate the User data from the Profile data
        $role = $data['role'] ?? null;

        // 2. Create the User (the main record)
        // We use static::getModel() to get the User model automatically
        $record = static::getModel()::create($data);

        // 3. Create the related profile based on selection
        if ($role === 'employee') {
            $record->employeeProfile()->create([
                'employee_id' => $data['employee_id'],
                'department' => $data['department'],
                'hire_date' => $data['hire_date'],
                'job_title' => $data['job_title'],
                'location_id' => Location::where('name',$data['location'])->get('id'),
            ]);
        } elseif ($role === 'customer') {
            $record->customerProfile()->create([
                'phone_number' => $data['phone_number'],
                'driver_license_number' => $data['driver_license_number'],
                'license_expiry_date' => $data['license_expiry_date'],
                'date_of_birth' => $data['date_of_birth'],
                'address' => $data['address'],
            ]);
        }

        return $record;
    }
}
