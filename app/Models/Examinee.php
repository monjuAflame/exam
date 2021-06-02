<?php

namespace App\Models;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;
use App\Models\Exam;
use App\Models\StudentProfile;
use Carbon\Carbon;

class Examinee extends Model
{
    use HasFactory;

    public function exam()
    {
        return $this->belongsToMany(Exam::class, 'id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function createNew($exam_id, $user_id)
    {
        try {
            return Examinee::create([
                'exam_id' => $exam_id,
                'user_id' => $user_id,
                'total_right_answer' => 0,
                'start_time' => Carbon::now(),
                'end_time' => 0,
                'marks' => 0,
            ]);
        } catch (Exception $e) {
            logger($e->getMessage());
            return null;
        }

    }
}
