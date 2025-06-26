<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $table = 'offices';

    protected $guarded = [];

    public function office_sub()
    {
        return $this->hasMany(OfficeSub::class, 'officeid', 'id');
    }

    public function departmentfields()
    {
        return $this->hasMany(DepartmentField::class, 'id', 'depafields');
    }

    public function departmentcat()
    {
        return $this->hasMany(DepartmentCat::class, 'id', 'depcat');
    }

    public function officedetail()
    {
        return $this->hasMany(OfficeDetail::class, 'officeId', 'id');
    }

    public function depsubmenu()
    {
        return $this->hasMany(DepartmentSubmenu::class, 'officeId', 'id');
    }

}
