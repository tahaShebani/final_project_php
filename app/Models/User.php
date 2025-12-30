<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'role',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
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
            'password'=>'hashed',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
    public function getNameAttribute(): string
{
    return $this->full_name ?? 'User';
}
public function employeeProfile()
    {
        return $this->hasOne(EmployeeProfile::class);
    }

    // Define the relationship to the CustomerProfile model
    public function customerProfile()
    {
        return $this->hasOne(CustomerProfile::class);
    }
public function canAccessPanel(Panel $panel): bool
    {
        return match ($panel->getId()) {
            'admin'  => $this->role === 'admin',
            'operation_employee'  => in_array($this->role, ['admin', 'operation_employee']),
            'booking_agent'  => in_array($this->role, ['admin', 'booking_agent']),
            default  => false,
        };
    }

}
