<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'vehicle_id',
        'pickup_location_id',
        'dropoff_location_id',
        'reserved_at',
        'expires_at',
        'pickup_date',
        'return_date',
        'status',
        'total_price',
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
            'customer_id' => 'integer',
            'vehicle_id' => 'integer',
            'pickup_location_id' => 'integer',
            'dropoff_location_id' => 'integer',
            'reserved_at' => 'timestamp',
            'expires_at' => 'timestamp',
            'pickup_date' => 'datetime',
            'return_date' => 'datetime',
            'total_price' => 'double',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function pickupLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function dropoffLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
