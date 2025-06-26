<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;

    protected $table = 'awards';

    protected $guarded = [];

    public function awardsub()
    {
        return $this->hasMany(AwardSub::class, 'awardid', 'id');
    }
    public function awarditem()
    {
        return $this->hasMany(AwardItem::class, 'awardid', 'id');
    }
}
