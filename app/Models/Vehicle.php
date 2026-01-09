<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
            'reserved_until' => 'datetime',
            'current_location_id' => 'integer',
            'returned_at_id'=>'integer'
        ];
    }

        public function scopeAvailableVechiles($query,$location,$date)
    {
        return $query->where(function ($q) use ($location, $date) {

            $q->where(function ($sub) use ($location) {
                $sub->where('status','available')
                    ->where('current_location_id', $location);
            })
            ->orWhere(function ($sub) use ($location, $date) {
                $sub->whereDate('reserved_until', '<',$date)
                    ->where('returned_at_id', $location);
            });
        });
    }
     public function scopeClasses($query,$classes){
            if($classes){
     $query->whereRelation('carModel.carClass','class',$classes);
            }


        return $query;
     }
     public function scopeModeles($query,$brand){
        if($brand){
           $query->whereRelation('carModel','brand',$brand);
        }

         return $query;
     }
        public function scopeColor($query,$color){
            if($color){
        $query->where('color',$color);
        }
        return $query;
        }
     public function scopePrice($query,$startPrice,$endPrice){
            if($startPrice){
        $query->where('price','>=',$startPrice);
        }

        if($endPrice){
            $query->where('price','<=',$endPrice);
        }
        return $query;
     }
     public function scopeYear($query,$startYear,$endtYear){
        if($startYear){
        $query->whereRelation('carModel','year','>=',$startYear);
        }

        if($endtYear){
            $query->whereRelation('carModel','year','<=',$endtYear);
        }
        return $query;
     }

    public function rereserveAll()
    {
        $reservations=$this->reservation;
        if($reservations){
            foreach($reservations as $reservation){
                if($reservation->stillNotRented()){
                    $reservation->setRereserve();
                }
            }
        }
    }

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class,'car_model');
    }



    public function currentLocation(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function reservation(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

        public function returnedAt(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
