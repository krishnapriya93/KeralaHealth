<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class SurveyAnswers extends Model
{
    use HasFactory;
    use HasTags;

    protected $table = "survey_answers";
   
    protected $guarded = [];
    

}
