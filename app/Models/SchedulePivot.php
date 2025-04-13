<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SchedulePivot extends Model
{
    //
    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }
    public function fields(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }
}
