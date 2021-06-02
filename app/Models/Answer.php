<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Exception;
use App\Models\Model;
use App\Models\Question;

class Answer extends Model
{
    use HasFactory;
    
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
    public function userAns()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function createNew($data)
    {
        try {
            return Answer::create([
                'user_id' => $data->user_id,
                'exam_id' => $data->exam_id,
                'question_id' => $data->question_id,
                'answer' => $data->answer,
            ]);

        } catch (Exception $e) {
            logger($e->getMessage());
            return null;
        }
    }
}
