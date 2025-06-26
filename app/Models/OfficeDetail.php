<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeDetail extends Model
{
    use HasFactory;

    protected $table = 'officedetails';

    protected $guarded = [];


    public function officedetailsub()
    {
        return $this->hasMany(OfficeDetailSub::class, 'officedetailId', 'id');
    }
    public function officemain()
    {
        return $this->hasMany(Office::class, 'id', 'officeId');
    }


}
