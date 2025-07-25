<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bannercategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status_id',
        'user_id',
    ];
}
