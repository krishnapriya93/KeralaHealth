<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $table = 'gallerycategory';

    protected $guarded = [];

    public function gallerycatsub()
    {
        return $this->hasMany(GalleryCategorySub::class, 'gallerycategoryId', 'id');
    }
}
