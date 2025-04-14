<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Field extends Model
{
    //
    protected $fillable = [
        'name',
        'number',
        'field_type_id',
        'location_id',
    ];

    protected $attributes = [
        'field_image_url' => 'https://www.shutterstock.com/shutterstock/photos/2443537831/display_1500/stock-photo-bang-saen-thailand-december-interior-view-of-an-indoor-badminton-court-at-bang-saen-2443537831.jpg',
    ];
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function fieldType(): BelongsTo
    {
        return $this->belongsTo(FieldType::class, 'field_type_id');
    }
    public function pivot(): HasMany
    {
        return $this->hasMany(SchedulePivot::class);
    }
}
