<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function suggItems()
    {
        return $this->hasMany(Suggestionitem::class, 'suggestionid', 'id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'userid');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'userid'); 
    }

}
