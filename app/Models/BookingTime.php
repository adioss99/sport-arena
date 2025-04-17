<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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

    public function schedulePivot(): HasManyThrough
    {
        return $this->hasManyThrough(
            Schedule::class,
            SchedulePivot::class,
            'id', // foreign key on SchedulePivot
            'id', // foreign key on Schedule
            'schedule_pivot_id', // local key on BookingTime
            'schedule_id' // local key on SchedulePivot
        );
    }
}
