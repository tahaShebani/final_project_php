<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'car_model',
        'vin',
        'license_plate',
        'color',
        'mileage',
        'price',
        'status',
        'reserved_until',
        'current_location_id',
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
            'car_model' => 'integer',
            'price' => 'double',
            'reserved_until' => 'timestamp',
            'current_location_id' => 'integer',
        ];
    }

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class,'car_model');
    }

    public function currentLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
