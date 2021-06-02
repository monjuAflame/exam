<?php

namespace App\Models;

use App\Models\User;
use App\Models\Model;
use App\Models\Course;
use App\Models\QuestionSet;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory, SoftDeletes;

    public function questionSet()
    {
        return $this->belongsTo(QuestionSet::class, 'question_set_id');
    }

    public function question()
    {        
        return $this->belongsToMany(Question::class, 'pivot_question_and_exam_set', 'exam_id', 'question_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function batches()
    {
        // loop $exam->batches as $batch
        //      $batch->schedule->start_date_time, 
        //      $batch->schedule->user_id
        //      $batch->schedule->created_at

        return $this->belongsToMany(Batch::class, 'pivot_exam_schedule', 'exam_id', 'batch_id')
                    ->withTimestamps()
                    ->withPivot(['start_date_time', 'user_id'])
                    ->as('schedule');

    }

    public function examinee()
    {        
        return $this->hasMany(Examinee::class, 'exam_id')->orderBy('marks', 'desc');
    }
    

}
