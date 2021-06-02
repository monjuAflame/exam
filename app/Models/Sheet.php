<?php

namespace App\Models;
use Exception;

use App\Models\User;
use App\Models\Model;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sheet extends Model
{
    use HasFactory, SoftDeletes;

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function getCourseNameAttribute()
    {
        return $this->course != null ? $this->course->name : 'N/A';
    }

    public static function createNew($data)
    {
        try {
            return Sheet::create([
                'course_id' => $data->course_id,
                'name' => $data->name,
            ]);

        } catch (Exception $e) {
            logger($e->getMessage());
            return null;
        }
    }

    public static function sheetsExist(array $sheet_ids = [])
    {
        return static::whereIn('id', $sheet_ids)->count() == count($sheet_ids);
    }

    public function users()
    {        
        return $this->belongsToMany(User::class, 'pivot_user_sheet', 'sheet_id', 'user_id');
    }

    public function getIsDeletableAttribute()
    {
        return $this->users()->count() == 0;
    }

}
