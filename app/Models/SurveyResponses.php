<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class SurveyResponses extends Model
{
    use HasFactory;

    use HasTags;

    protected $table = "survey_responses";
   
    protected $guarded = [];
    public function articleval_sub()
    {
        return $this->hasMany(Articlesub::class, 'articleid', 'id');
    }

}
