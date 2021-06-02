<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SmsService;
use App\Models\Course;
use App\Models\Batch;
use App\Models\StudentProfile;

class MessageController extends Controller
{
    public function index(){
        return view('admin.message.index');
    }

    public function create(){
        return view('admin.message.create');
    }

    public function getCourse()
    {
    	return Course::get();
    }

    public function getBatch($course_id)
    {
    	return response(Batch::where('course_id', $course_id)->get());
    }

    public function preview(Request $request)
    {
        $this->validate($request,[
            'send_type' => 'required|numeric',
            'message' => 'required|string|max:140'
        ]);
        if ($request->ajax()) {

            if($request->student_id!=null){
                return $this->smsStudents()->where('student_id', $request->student_id)
                                           ->get();
            }
            if($request->course_id!=null AND $request->batch_id!=null){
                return $this->smsStudents()->where('course_id', $request->course_id)
                                           ->where('batch_id', $request->batch_id)
                                           ->get();
            }
            if($request->course_id!=null){
                return $this->smsStudents()->where('course_id', $request->course_id)
                                           ->get();
            }
            if($request->year!=null){
                return $this->smsStudents()->where('session', $request->year)
                                           ->get();
            }
            return false;                              
        }
    }

    private function smsStudents()
    {
        return StudentProfile::join('users','users.id','=','student_profiles.user_id')
                            ->join('enrolments','enrolments.user_id','=','users.id')
                            ->select("users.first_name",
                                "users.last_name",
                                "users.phone",
                                "enrolments.course_id",
                                "enrolments.batch_id",
                                "enrolments.session",
                                "student_profiles.student_id");
    }

    public function send(Request $request)
    {
        if ($request->ajax()) {

            if($request->student_id!=null){
                $students = $this->smsStudents()->where('student_id', $request->student_id)
                                           ->get();
            }
            if($request->course_id!=null AND $request->batch_id!=null){
                $students = $this->smsStudents()->where('course_id', $request->course_id)
                                           ->where('batch_id', $request->batch_id)
                                           ->get();
            }
            if($request->course_id!=null){
                $students = $this->smsStudents()->where('course_id', $request->course_id)
                                           ->get();
            }
            if($request->year!=null){
                $students = $this->smsStudents()->where('session', $request->year)
                                           ->get();
            }

            $contents = [];
            if ($request->send_type==0) {
                foreach ($students as $key => $value) {
                    array_push($contents, [
                        $value->phone => strpos( $request->message, '{$name}') !== false ? str_replace('{$name}',$value->first_name, $request->message) : $request->message,
                    ]);
                }
            }

            if (!empty($contents)) {
                return SmsService::sendSms($contents);
            }
                                         
        }
    }




}
