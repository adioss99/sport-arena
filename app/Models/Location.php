<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Relations\HasMany;
class Location extends Model
{
    protected $fillable = ['name', 'regency', 'district', 'slug'];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($location) {
            $location->slug = self::generateSlug($location->name, $location->regency);
        });

        static::updating(function ($location) {
            $location->slug = self::generateSlug($location->name, $location->regency);
        });
    }

    private static function generateSlug($name, $regency)
    {
        $slugBase = Str::slug("{$name}-{$regency}"); // Combine all fields into slug
        $count = Location::where('slug', 'LIKE', "$slugBase%")->count();

        return $count ? "{$slugBase}-{$count}" : $slugBase;
    }

    public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }
}
