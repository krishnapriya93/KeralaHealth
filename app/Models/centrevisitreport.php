<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class centrevisitreport extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function centervisitsub()
    {
        return $this->hasMany(centrevisitreportAttachment::class, 'centervisitId', 'id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'userid');
    }
}
