<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicrelationtypSub extends Model
{
    use HasFactory;

    protected $table = 'publicrelationtypesubs';

    protected $guarded = [];

    public function lang()
    {
        return $this->belongsTo(Language::class, 'languageid', 'id');
    }
}
