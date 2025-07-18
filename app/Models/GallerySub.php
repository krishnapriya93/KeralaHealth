<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GallerySub extends Model
{
    use HasFactory;

    protected $table = 'gallery_subs';

    protected $guarded = [];

    public function lang()
    {
        return $this->belongsTo(Language::class, 'languageid', 'id');
    }
}
