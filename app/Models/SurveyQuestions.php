<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class SurveyQuestions extends Model
{
    use HasFactory;
    use HasTags;

    protected $table = "survey_questions";
   
    protected $guarded = [];

    public function survey_ans()
    {
        return $this->hasMany(SurveyAnswers::class, 'question_id', 'id');
    }

}
