<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Repositories\ExamRepository;
use App\Http\Requests\CreateExamRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Models\User;

class ExamController extends Controller
{
    public function index()
    {
        $examsUnschedule = Exam::where('schedule', 0)->get(); 
        $exams = Exam::all(); // required for exam schedule
        $batches = Batch::all();
    	return view('exam.index', compact('exams', 'batches','examsUnschedule'));
    }

    public function create()
    {
        $courses = Course::all();
    	return view('exam.create', compact('courses'));
    }

    public function store(CreateExamRequest $request)
    {

        $exam = ExamRepository::createBasicTest($request->all());
        if ($exam instanceof Exam) {
            return redirect()->route('exam.questions', $exam->id);
        } else {
            return back()->with('message', 'Could not create the exam');
        }
    }

    public function setupQuestion(Exam $exam)
    {
        return view('exam.question_setup', compact('exam'));
    }
 
    public function results()
    {
        $exams = Exam::all();
        $answers = Exam::all();
        return view('exam.results', compact('exams','answers'));
    }

    public function showQuestions(Exam $exam)
    {   
        $questions = $exam->question;
        return view('exam.exam_questions', compact('exam','questions'));        
    }

    public function singleExamResult(Exam $exam)
    {
        $answers = Answer::all();
        $users = User::all();
        return view('exam.single_exam_result', compact('exam','answers','users'));        
    }

    public function scheduleExam(Request $request)
    {
        $batches = $request->schedule_batches;
        $dateTime =  date('Y-m-d H:i:s', strtotime("{$request->schedule_date} {$request->schedule_time}"));

        $exam = Exam::find($request->schedule_exam);
        $exam->schedule = 1;
        if($exam->save())
        {
            $exam->batches()->attach($batches, [
                'start_date_time' => $dateTime,
                'user_id' => auth()->id(),
            ]);
        }

/*        foreach ($exam->batches as $batch) {
            $dateTime = $batch->schedule->start_date_time;
            $batch_name = $batch->name;
            logger($dateTime);
            logger($batch_name);
        }
*/

        // Multi is not working
        //foreach ($batches as $batch_id) {
        //    $exam->batches()->attach($batch_id, [
        //        'start_date_time' => $dateTime,
        //        'user_id' => auth()->id(),
        //    ]);
        //}

        return back();

    }

    public function resultPublish(Exam $exam)
    {
        $exam->result_publish = 1;
        $exam->save();
        return back()->with('message', 'Test Result Publish successfully !');
    }

    public function edit(Exam $exam)
    {
        $courses = Course::all();
    	return view('exam.edit_exam', compact('courses', 'exam'));
    }

    public function update(Request $request, Exam $exam)
    {
        $exam->title = $request->name;
        $exam->course_id = $request->course_id;
        $exam->user_id = auth()->id();
        $exam->duration_in_minutes = $request->duration;
        $exam->passing_score = $request->passing_score;
        $exam->intro_text = $request->intro_text;
        $exam->conclusion_text = $request->conclusion_text;
        $exam->pass_message = $request->pass_message;
        $exam->fail_message = $request->fail_message;

        if($exam->save())
        {
            return back()->with('message', 'Test updated successfully !');
        }
        return back()->with('message', 'Could not create the exam');
    }

    public function destroy(Exam $exam)
    {
        if ($exam->delete()) {
            return back()->with('message', 'Exam deleted successfuly!');
        }
        return back()->with('message', 'Something went wrong!');
    }





}
