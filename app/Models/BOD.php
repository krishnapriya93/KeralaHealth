<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BOD extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function bodsub()
    {
        return $this->hasMany(BOD_sub::class, 'bod_main_id', 'id');
    }

    public function designation()
    {
        return $this->hasMany(Designation::class, 'id', 'desigId');
    }
}
