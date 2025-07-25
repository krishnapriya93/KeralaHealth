<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';

    protected $fillable = ['status_id', 'userid', 'delet_flag'];

    public function district_sub()
    {
        return $this->hasMany(Districtsub::class, 'districtid', 'id');
    }
}
