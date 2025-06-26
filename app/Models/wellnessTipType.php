<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wellnessTipType extends Model
{
    use HasFactory;

    protected $table = 'wellnessTipTypes';

    protected $guarded = [];

    public function wellnessTipTypesub()
    {
        return $this->hasMany(wellnessTipTypeSub::class, 'wellnessTipTypesid', 'id');
    }
}
