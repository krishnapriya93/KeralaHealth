<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentSubmenu extends Model
{
    use HasFactory;

    protected $table = 'departmentsubmenus';

    protected $guarded = [];

    public function dep_submenu()
    {
        return $this->hasMany(DepartmentSubmenuSub::class, 'depsubmenuid', 'id');
    }

}
