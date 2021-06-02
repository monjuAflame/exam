<?php

namespace App\Models;

use App\Models\User;
use App\Models\Model;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentProfile extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function examinee()
    {
        return $this->hasMany(Examinee::class, 'user_id');
    }

    public static function createNew($data, User $user)
    {
        try {
            return StudentProfile::create([
                'guardian_name' => $data->guardian_name,
                'guardian_phone' => $data->guardian_phone,
                'guardian_email' => null,
                'user_id' => $user->id,
                'gender' => $data->gender,
                'student_id' => '007' . (StudentProfile::count() + 1),
                'address' => $data->address,
                'academic_info' => json_encode(static::prepareAcademicInfo($data)),
            ]);
        } catch (Exception $e) {
            logger($e->getMessage());
            return null;
        }

    }

    public static function prepareAcademicInfo($request)
    {
        return [
            'ssc' => [
                'name' => $request->ssc_academic_name,
                'board' => $request->ssc_board,
                'group' => $request->ssc_group,
                'passing_year' => $request->ssc_passing_year,
                'result' => $request->ssc_gpa,
                'exam_id' => $request->ssc_roll,
            ],
            'hsc' => [
                'name' => $request->hsc_academic_name,
                'board' => $request->hsc_board,
                'group' => $request->hsc_group,
                'passing_year' => $request->hsc_passing_year,
                'result' => $request->hsc_gpa,
                'exam_id' => $request->hsc_roll,
            ],
        ];
    }

    public function scopeSearchByStudentId($query, $student_id)
    {
        return $query->where('student_id', $student_id);
    }

    public function getFullNameAttribute()
    {
        return $this->user->first_name . ' ' . $this->user->last_name ?? '';
    }    

    public function getRouteKeyName()
    {
        return 'student_id';
    }

}
