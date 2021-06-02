<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Batch;
use App\Models\Sheet;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\StudentProfile;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateStudentRequest;
use App\Models\Answer;
use App\Models\CourseCategory;
use App\Models\Exam;
use App\Models\Examinee;
use App\Models\Question;
use Carbon\Carbon;
use Symfony\Component\Console\Question\Question as QuestionQuestion;

class StudentController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $batches = Batch::all();
        $students = StudentProfile::with('user')->get();
        return view('admin.student.index', compact(['students','courses','batches']));
    }

    public function create()
    {
        $courses = Course::all();
        $batches = Batch::all();
        return view('admin.student.create', compact(['courses', 'batches']));
    }

    public function store(CreateStudentRequest $request)
    {
        logger(json_encode($request->all()));

        $user = new User;
        $user = User::createNew($request);
        if ($user == null) {
            return $this->returnFailedResponse();
        }

        $student = StudentProfile::createNew($request, $user);

        if ($student == null) {
            $user->forceDelete();
            return $this->returnFailedResponse();
        }

        try {
            $user->enrolledCourses()->attach($request->course_id, [
                'batch_id' => $request->batch_id,
                'session' => $request->session,
                'admission_type' => $request->admission_id,
            ]);

            $batch = Batch::find($request->batch_id);
            $student->student_id = $batch->id_prefix . $batch->enrolledUsers()->count();
            $student->save();
            $studentRole = Role::where('name', 'student');
            $user->assignRole($studentRole);

        } catch (Exception $e) {
            logger($e->getMessage());
            logger($e->getTraceAsString());
        } finally {

            $user->assignStudentRole();
            if (auth()->check() == false) {
                Auth::login($user);
            }
            // redirect to new created student profile
            return redirect()->route('student.show', $student->student_id);            
        }

        //return back()->with('message', 'Student is registered successfully with ID: ' . $student->student_id);
    }

    public function search(Request $request)
    {
        $student_id = $request->student_id;
        $student = StudentProfile::searchByStudentId($student_id)->first();
        
        if (is_null($student)) {
            return redirect()->route('payment.search')
                ->withInput(['student_id' => $student_id])
                ->withErrors(['student_id' => 'Student was not found!']);
        }

        return redirect()->route('student.show', $student_id);
    }

    public function show(Request $request, StudentProfile $student)
    {
        $user = $student->user;
        $sheets = Sheet::whereNotIn('id', $user->sheets()->pluck('id')->toArray())->with('course')->get();
        $attached_sheets = $user->sheets()->with('course')->get();

        $latest_enrolment = $user->enrolledCourses()->orderByPivot('created_at', 'desc')->first();
        $enrolments = $user->enrolments()->with(
            [
                'course', 
                'user', 
                'payments' => function($query){
                    $query->latest();
                }
            ])->latest()->get();

        return view('admin.payment.create', compact([
            'student', 'user', 'sheets', 'attached_sheets', 'latest_enrolment', 'enrolments',
        ]));
    }

    public function profile(Request $request, $student)
    {
        return view('student.exams.exam_result');
    }

    private function returnFailedResponse($message = null)
    {
        $message = $message ?? 'Something went wrong!';
        return back()->withInput()->with('message', $message);
    }

    
    public function filter(Request $request)
    {
        if ($request->ajax()) {
           if ($request->course_id != "") {
               $criterial = array('courses.id'=>$request->course_id);
           }
           if ($request->batch_id != "") {
               $criterial = array('batches.id'=>$request->batch_id);
           } 
           if ($request->course_id != "" && $request->batch_id != "") {
               $criterial = array(
                                   'courses.id'=>$request->course_id,
                                   'batches.id'=>$request->batch_id
                               );
           }
        }
        if ($request->dueFilter != 1) {
            $students = $this->filteringStudents($criterial)->get();
            return view('admin.student.filter.list', compact('students'));
        }
        $students = $this->dueFilteringStudents($criterial)->get();
        return view('admin.student.filter.due_list', compact('students'));

    }

    public function filteringStudents($criterial)
    {
        
        return StudentProfile::join('enrolments','enrolments.user_id','=','student_profiles.user_id')
                             ->join('courses','courses.id','=','enrolments.course_id')
                             ->join('batches','batches.id','=','enrolments.batch_id')
                             ->where($criterial)
                             ->orderBy('student_profiles.student_id','DESC');
    }

    public function due()
    {
        $students = $this->dueStudents()->get();
        $courses = Course::all();
        return view('admin.student.due', compact(['students','courses']));
    }

    public function dueFilteringStudents($criterial)
    {
        
        return $this->dueStudents()->where($criterial)
                                   ->orderBy('student_profiles.student_id','DESC');
    }

    public function dueStudents()
    {
        return StudentProfile::join('enrolments','enrolments.user_id','=','student_profiles.user_id')
                             ->join('users','users.id','=','enrolments.user_id')
                             ->join('payments','payments.enrolment_id','=','enrolments.id')
                             ->join('courses','courses.id','=','enrolments.course_id')
                             ->join('batches','batches.id','=','enrolments.batch_id')
                             ->select("users.first_name",
                                    "users.last_name",
                                    "student_profiles.student_id",
                                    "courses.name AS course",
                                    "batches.name AS batch")
                             ->selectRaw('(courses.fee-enrolments.discount)-payments.amount AS due');
    }

    // frontEnd student

    public function stundetProfile()
    {
        $student = User::find(Auth::user()->id);
        $courseCat = CourseCategory::all();
        return view('student.profile', compact('student','courseCat'));
        
    }

    public function exam()
    {
        $exams = Exam::all();
        $examinee = Examinee::all();
        $user = User::find(auth::user()->id);
        return view('student.exams.index', compact('exams','examinee','user'));
    }

    public function examStart($id)
    {
        
        $exam = Exam::find($id);
        $question = $exam->question->first();

        Examinee::createNew($exam->id, Auth::user()->id);

        $previous_q_id = $exam->question->where('id', '<', $question->id)->max('id');
        $next_q_id = $exam->question->where('id', '>', $question->id)->min('id');

        $total_ans = 0;
        
        return view('student.exams.exam_start', compact('question','exam','previous_q_id','next_q_id','total_ans'));
    }

    public function nextQues(Request $request)
    {

        
        $exam = Exam::find($request->exam_id);
        $start_date_time = $exam->batches[0]->schedule->start_date_time;
        $end_time = date('Y-m-d H:i:s', strtotime($start_date_time . " " . $exam->duration_in_minutes . " minutes" ));
        $current_time = date('Y-m-d H:i:s', time());

        if($start_date_time <= $current_time && $end_time >= $current_time)
        {
            if($request->next_q_id != null)
            {
                    $answer = Answer::createNew($request);
                    if($answer)
                    {
                        $question = $exam->question->find($request->next_q_id);
                        $previous_q_id = $exam->question->where('id', '<', $question->id)->max('id');
                        $next_q_id = $exam->question->where('id', '>', $question->id)->min('id');
                        $total_ans = Answer::where('exam_id',$request->exam_id)->where('user_id',$request->user_id)->count();
                        
                        $p_q_a = $exam->question->find($request->current_q_id);
                        $right_answer = $answer->where('answer', $p_q_a->mcq_answer_index)->where('user_id', $request->user_id)->where('question_id', $p_q_a->id)->count();
                        if($right_answer!=0)
                        {
                            $examinee = Examinee::where('exam_id', $exam->id)->where('user_id', $request->user_id)->first();
                            $examinee->total_right_answer = $examinee->total_right_answer+$right_answer;
                            $examinee->end_time = Carbon::now();
                            $examinee->marks = $examinee->total_right_answer*$p_q_a->mark;
                            if($examinee->save())
                            {
                                return view('student.exams.exam_start', compact('question','exam','previous_q_id','next_q_id','total_ans','end_time'));
                            }
                        }

                        return view('student.exams.exam_start', compact('question','exam','previous_q_id','next_q_id','total_ans','end_time'));
                    }
                    
                return back()->with('message', 'Something went wrong!');

            } else {
                $answer = Answer::createNew($request);
                if($answer)
                {
                        $total_ans = Answer::where('exam_id',$request->exam_id)->where('user_id',$request->user_id)->count();
                        $p_q_a = $exam->question->find($request->current_q_id);
                        $right_answer = $answer->where('answer', $p_q_a->mcq_answer_index)->where('user_id', $request->user_id)->where('question_id', $p_q_a->id)->count();
                        
                        if($right_answer!=0)
                        {
                            $examinee = Examinee::where('exam_id', $exam->id)->where('user_id', $request->user_id)->first();
                            $examinee->total_right_answer = $examinee->total_right_answer+$right_answer;
                            $examinee->end_time = Carbon::now();
                            $examinee->marks = $examinee->total_right_answer*$p_q_a->mark;
                            if($examinee->save())
                            {
                                $question = $exam->question->count();
                                 return view('student.exams.exam_finish', compact('question','exam','total_ans','end_time'));
                            }
                        }
                        $question = $exam->question->count();
                        return view('student.exams.exam_finish', compact('question','exam','total_ans','end_time'));
                }
            }
        }
        return back()->with('message', 'Something went wrong!');
        
    }

    public function result()
    {
        $exams = Exam::all();
        $answer = Answer::all();
        $user = User::find(auth::user()->id);
        return view('student.exams.result', compact('exams','answer', 'user'));       
        
    }

    public function resultDetails(Exam $exam)
    {
        $answer = Answer::all();
        return view('student.exams.exam_result', compact('exam','answer'));       
        
    }
       

    

   
    
}
