<?php

namespace App\Repositories;

use App\Models\Exam;
use Exception;

class ExamRepository
{
    public static function createBasicTest($data)
    {

        try {
            return Exam::create([
                'title' => $data['name'],
                'course_id' => $data['course_id'],
                'user_id' => auth()->id(),
                'duration_in_minutes' => $data['duration'],
                'total_marks' => 0,
                'passing_score' => $data['passing_score'],
                'intro_text' => $data['intro_text'],
                'conclusion_text' => $data['conclusion_text'],
                'pass_message' => $data['pass_message'],
                'fail_message' => $data['fail_message'],
                ]);
        } catch (Exception $e) {
            logger($e->getMessage());
            logger($e->getTraceAsString());
            return null;
        }
    }    
}
