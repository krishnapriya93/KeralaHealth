<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentField extends Model
{
    use HasFactory;

    protected $table = 'departmentfields';

    protected $guarded = [];

    public function depfd_sub()
    {
        return $this->hasMany(DepartmentFieldsSub::class, 'departmentfieldid', 'id');
    }

    public function department()
    {
        return $this->hasMany(Department::class, 'id', 'departmentId');
    }

    public function office()
    {
        return $this->belongsToMany(Office::class, 'id', 'depafields');
    }
}
