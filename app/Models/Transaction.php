<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $payment_method;
    protected $fillable = [
        'reservation_id',
        'vehicle_id',
        'customer_id',
        'total_amount',
        'new_column',
        'actual_pickup_at',
        'actual_return_at',
        'pickup_location_id',
        'return_location_id',
        'status',
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
            'reservation_id' => 'integer',
            'vehicle_id' => 'integer',
            'customer_id' => 'integer',
            'total_amount' => 'double',
            'new_column' => 'integer',
            'actual_pickup_at' => 'timestamp',
            'actual_return_at' => 'timestamp',
            'pickup_location_id' => 'integer',
            'return_location_id' => 'integer',
        ];
    }

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class)
        ->whereIn('status',['available','reserved']);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class)->where('role','customer');
    }

    public function pickupLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function returnLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

        public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class,'processed_by')
            ->where('role','booking_agent');
    }
}
