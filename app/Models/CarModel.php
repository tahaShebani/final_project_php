<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarModel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'car_class',
        'brand',
        'model_name',
        'year',
        'fuel_type',
        'image_path',
        'transmission',
        'seating_capacity',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'car_class' => 'integer',
        ];
    }

    public function carClass(): BelongsTo
    {
        return $this->belongsTo(CarClass::class,'car_class');
    }
    public function getFullNameAttribute(): string
{
    return "{$this->model_name} ({$this->year})";
}
}
