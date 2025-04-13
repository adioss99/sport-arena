<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingField extends Model
{
    protected $fillable = [
        'booking_id',
        'field_id',
        'field_price',
        'field_name',
    ];
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function bookingTimes()
    {
        return $this->hasMany(BookingTime::class);
    }
}
