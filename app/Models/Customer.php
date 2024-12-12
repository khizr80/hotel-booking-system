<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'password'];

    // A customer can book many rooms
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Automatically hash passwords when creating or updating
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
