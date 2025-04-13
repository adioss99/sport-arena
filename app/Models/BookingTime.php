<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingTime extends Model
{
    //
    protected $fillable = [
        'schedule_pivot_id',
        'booking_field_id', 
    ];

    public function bookingField()
    {
        return $this->belongsTo(BookingField::class);
    }
    
    // public function schedulePivot()
    // {
    //     return $this->belongsTo(SchedulePivot::class);
    // }
}
