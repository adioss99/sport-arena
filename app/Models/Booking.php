<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function bookingFields(): HasMany
    {
        return $this->hasMany(BookingField::class);
    } 
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
