<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'boking_date',
        'total_hours',
        'total_price',
        'status',
        'user_id',
        'location_id',
        'location_name',
        'booking_code',
    ];

    public function bookingFields()
    {
        return $this->hasMany(BookingField::class);
    }
}
