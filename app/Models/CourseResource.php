<?php

namespace App\Models;

use App\Models\User;
use App\Models\Model;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseResource extends Model
{
    use HasFactory;

    public const TYPE_NONE = 'none';
    public const TYPE_VIDEO = 'video';
    public const TYPE_PDF = 'pdf';
    public const TYPE_WORD = 'word';
    public const TYPE_EXCEL = 'excel';
    public const TYPE_PPTX = 'pptx';
    public const TYPE_IMAGE = 'image';
    public const TYPE_YOUTUBE = 'youtube';

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
