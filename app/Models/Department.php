<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $guarded = [];

    public function dep_sub()
    {
        return $this->hasMany(DepartmentSub::class, 'departmentid', 'id');
    }
}
