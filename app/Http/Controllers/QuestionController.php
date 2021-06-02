<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateQuestionRequest;
use App\Models\Exam;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index ()
    {
    	return view('admin.question.index');
    }

    public function create ()
    {
    	return view('admin.question.create');
    }

    public function store(CreateQuestionRequest $request)
    {
        
        $question = Question::createNew($request);
        if($question->id!=null){
            Question::attachExam($question,$request->exam_id);
            $exam = Exam::find($request->exam_id);
            $exam->total_marks = $exam->total_marks+$request->mark;
            $exam->save();
        } else {
            return "Someting wrong";
        }

        if ($question instanceof Question) {
            return "Question save successfully";
        } else {
            return back()->with('message', 'Could not save the question');
        }
    }
}
