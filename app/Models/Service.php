<?php

namespace App\Models;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
    ];

    /**
     * Relasi booking service
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
