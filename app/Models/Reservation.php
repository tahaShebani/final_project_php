<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'car_model_id',
        'vehicle_id',
        'pickup_location_id',
        'dropoff_location_id',
        'reserved_at',
        'expires_at',
        'pickup_date',
        'return_date',
        'status',
        'total_price',
        'payment_method',
    ];

    protected $casts = [
        'id' => 'integer',
        'customer_id' => 'integer',
        'vehicle_id' => 'integer',
        'pickup_location_id' => 'integer',
        'dropoff_location_id' => 'integer',
        'reserved_at' => 'datetime',
        'expires_at' => 'datetime',
        'pickup_date' => 'datetime',
        'return_date' => 'datetime',
        'total_price' => 'double',
    ];

    // علاقة مع المستخدم (العميل)
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id')
            ->where('role', 'customer');
    }

    // علاقة مع المعاملة (Transaction) إذا عندك جدول خاص بها
    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    // علاقة مع موديل السيارة
    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class, 'car_model_id');
    }

    // علاقة مع موقع الاستلام
    public function pickupLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'pickup_location_id');
    }

    // علاقة مع موقع التسليم
    public function dropoffLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'dropoff_location_id');
    }

    // علاقة مع الموظف الذي عالج الحجز
    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by')
            ->where('role', 'booking_agent');
    }

    // ✅ علاقة الدفع المرتبط بالحجز
    public function payment()
    {
        return $this->hasOne(Payment::class, 'reservation_id');
    }
}
