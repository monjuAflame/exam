<?php

namespace App\Models;

use App\Models\Exam;
use App\Models\User;
use App\Models\Model;
use App\Models\Course;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionSet extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'pivot_question_and_question_set', 'question_set_id', 'question_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'question_set_id');
    }

}
