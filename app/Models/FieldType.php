<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FieldType extends Model
{
    protected $fillable = [
        'detail',
        'price_per_hour',
        'location_id',
    ];
    public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }
}
