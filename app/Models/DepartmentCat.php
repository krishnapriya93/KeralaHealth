<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentCat extends Model
{
    use HasFactory;

    protected $table = 'departmentcategory';

    protected $guarded = [];

    public function depcat_sub()
    {
        return $this->hasMany(DepartmentCatSub::class, 'departmentcatid', 'id');
    }

    public function depcat_field()
    {
        return $this->hasMany(DepartmentField::class, 'id', 'departmentfieldid');
    }
}
