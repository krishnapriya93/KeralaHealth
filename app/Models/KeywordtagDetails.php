<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeywordtagDetails extends Model
{
    use HasFactory;

    protected $table = 'keywordtagdetails';

    protected $guarded = [];

    public function Keywordtag()
    {
        return $this->hasMany(Keywordtag::class, 'keywordtagid', 'id');
    }
}
