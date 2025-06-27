<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wellnessTipTypeSub extends Model
{
    use HasFactory;

    protected $table = 'wellnessTipTypesubs';

    protected $guarded = [];

    public function lang_sel()
    {
        return $this->belongsTo(Language::class, 'languageid', 'id');
    }
}
