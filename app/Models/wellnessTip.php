<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wellnessTip extends Model
{
    use HasFactory;

    protected $table = 'wellnessTips';

    protected $guarded = [];

    public function wellnessTipsub()
    {
        return $this->hasMany(wellnessTipSub::class, 'wellnessTipId', 'id');
    }

    public function wellnessTipType()
    {
        return $this->hasMany(wellnessTipType::class, 'id', 'wellnessTipTypeId');
    }
}
