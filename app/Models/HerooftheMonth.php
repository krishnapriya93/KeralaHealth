<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HerooftheMonth extends Model
{
    use HasFactory;

    protected $table = 'herooftheMonths';

    protected $guarded = [];

    public function heromonthsub()
    {
        return $this->hasMany(HerooftheMonthSub::class, 'homid', 'id');
    }
}
