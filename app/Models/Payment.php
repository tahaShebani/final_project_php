<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'reservation_id',   // ✅ العمود الصحيح
        'payment_source',
        'payment_method',
        'processed_by',
        'transaction_id',
        'paid_at',          // ✅ التصحيح الإملائي
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
            'amount' => 'double',
            'processed_by' => 'integer',
            'transaction_id' => 'integer',
            'reservation_id' => 'integer', // ✅ العمود الصحيح
            'paid_at' => 'timestamp',      // ✅ التصحيح الإملائي
        ];
    }

    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class)
            ->where('role','booking_agent');
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }
}
