<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCourseRequest;
use App\Models\Course;
use App\Models\Batch;
use App\Models\CourseCategory;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('batches')->get();
    	return view('admin.course.index', compact(['courses']));
    }
    public function create()
    {
        $courses = Course::with('batches')->get();
        $course_cats = CourseCategory::all();
    	return view('admin.course.create', compact(['course_cats', 'courses']));
    }

    public function store(CreateCourseRequest $request)
    {
        $course = Course::createNew($request);

        if ($course instanceof Course) {
            return back()->with('message', 'Course created successfully!');
        } else {
            return back()->with('message', 'Something went wrong!')->withInput();
        }

    }

    public function edit(Course $course)
    {
        $course_cats = CourseCategory::all();
        return view('admin.course.edit', compact('course', 'course_cats'));
    }

    public function update(CreateCourseRequest $request, Course $course)
    {

        $course->name = $request->name;
        $course->code = $request->code;
        $course->fee = $request->fee;
        $course->course_category_id = $request->course_category_id;
        $course->duration_in_weeks = $request->duration_in_weeks;
        $course->total_class = $request->total_class;
        $course->total_exam = $request->total_exam;

        if ($course->save()) {
            return redirect()->route('course.create')->with('message', 'Course updated successfully!!');    
        }
        return back()->with('message', 'Something went wrong!');
    }

    public function destroy(Course $course)
    {
        if ($course->isDeletable == false) {
    		return back()->with('message', 'Unable to delete!');
        }

        if ($course->delete()) {
            logger('delete');
    		return back()->with('message', 'Course deleted successfully!');
        }
        return back()->with('message', 'Ops! Something went wrong.');    
    }

    public function getBatch(Request $request)
    {
        if ($request->ajax()) {
    		return response(Batch::where('course_id', $request->course_id)->get());
    	}
    }

}
