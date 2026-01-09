<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarModel extends Model
{
    use HasFactory;
    use SoftDeletes;
protected $fillable = [
    'car_class',
    'brand',
    'model_name',
    'year',
    'fuel_type',
    'image_path',
    'transmission',
    'seating_capacity',
    'price',             // السعر
    'doors',             // عدد الأبواب
    'luggage_capacity',  // عدد الشنط
];


    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'car_class' => 'integer',
        ];
    }

    // العلاقة مع CarClass
    public function carClass(): BelongsTo
    {
        return $this->belongsTo(CarClass::class, 'car_class');
    }

    // العلاقة مع Vehicle
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'car_model_id');
    }

    // اسم كامل للموديل
    public function getFullNameAttribute(): string
    {
        return "{$this->model_name} ({$this->year})";
    }
    public function reservations() { 
        return $this->hasMany(Reservation::class, 'vehicle_id'); }
}
