<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    //
    public function pivot(): HasMany
    {
        return $this->hasMany(SchedulePivot::class);
    }
}
