<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wellnessTipSub extends Model
{
    use HasFactory;

    protected $table = 'wellnessTipSubs';

    protected $guarded = [];

    public function lang_sel()
    {
        return $this->belongsTo(Language::class, 'languageid', 'id');
    }
}
