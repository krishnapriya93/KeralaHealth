<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentFieldsSub extends Model
{
    use HasFactory;

    protected $table = 'departmentfields_subs';

    protected $fillable = ['departmentfieldid', 'languageid', 'title'];
}
