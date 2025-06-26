<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function translations()
    {
        return $this->hasMany(TagTranslation::class);
    }

    // Get the tag name for the current locale
    public function getNameAttribute()
    {
        return $this->translations->firstWhere('locale', app()->getLocale())?->name ?? $this->translations->first()->name;
    }
}

