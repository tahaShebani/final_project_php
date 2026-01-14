<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory;
use SoftDeletes;
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
    public $payment_method;
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
            'return_at_id' => 'integer',
            'total_price' => 'double',
        ];
    }

    public function stillNotRented(){
        if($this->transaction_id && ($this->status!=='cancelled')){

             return false;
        }else if(($this->status!=='cancelled')){
            return true;
        }else{
            return false;
        }
    }
    public function setRereserve(){
        $this->status='rereserve';
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class)->where('role','customer');
    }
        public function transaction()
    {
        return $this->hasOne(Transaction::class);
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
        public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class,'processed_by')
            ->where('role','booking_agent');
    }
}
