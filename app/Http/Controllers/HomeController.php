<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Batch;
use App\Models\StudentProfile;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $course_count = Course::count();
        $batch_count = Batch::count();
        $student_count = StudentProfile::count();
        return view('home', compact('course_count', 'batch_count', 'student_count'));
    }
}
