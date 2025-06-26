<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleDepartment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function articleval()
    {
        return $this->belongsTo(Article::class, 'articleid', 'id');
    }
}
