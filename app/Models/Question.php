<?php

namespace App\Models;
use Exception;

use App\Models\User;
use App\Models\Model;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Question;
use App\Models\Exam;

class Question extends Model
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

    public function answer()
    {
        return $this->hasMany(Answer::class, 'question_id');
    }

    public function exam()
    {        
        return $this->belongsToMany(Exam::class, 'pivot_question_and_exam_set', 'question_id', 'exam_id');
    }

    public static function attachExam($q, $exam_id)
    {
        $e = Exam::find($exam_id);
        $e->question()->attach($q);
    }

    public static function createNew($data)
    {
        try {
            return Question::create([
                'type' => $data->type,
                'title' => $data->title,
                'options' => json_encode(static::prepareOptions($data)),
                'mcq_answer_index' => $data->mcq_answer_index,
                'explanation' => $data->explanation,
                'mark' => $data->mark,
                'course_id' => $data->course_id,
                'user_id' => $data->user_id,
            ]);
        } catch (Exception $e) {
            logger($e->getMessage());
            return null;
        }

    }

    public static function prepareOptions($request)
    {
        return [
            'options' => [
                '1' => $request->options[0],
                '2' => $request->options[1],
                '3' => $request->options[2],
                '4' => $request->options[3],
            ]
        ];
    }

    public function questionSets()
    {
        return $this->belongsToMany(QuestionSet::class, 'pivot_question_and_question_set', 'question_id', 'question_set_id');
    }
}
