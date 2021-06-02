<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\CreateBatchRequest;

class BatchController extends Controller
{
    public function index()
    {    
        $batches = Batch::with('course')->get();
        // dd($batches);
    	return view('admin.batch.index', compact([ 'batches',]));
    }

    public function create()
    {

        $courses = Course::all();
        $batches = Batch::with('course')->get();
        return view('admin.batch.create', compact(['courses', 'batches']));
    }

    public function store(CreateBatchRequest $request)
    {

        $batch = Batch::createNew($request);

        if ($batch instanceof Batch) {
            return back()->with('message', 'Batch created successfully!');
        } else {
            return back()->with('message', 'Something went wrong!')->withInput();
        }
    }

    public function edit(Batch $batch)
    {
        $courses = Course::all();
        return view('admin.batch.edit', compact('batch','courses'));
    }

    public function update(CreateBatchRequest $request, Batch $batch)
    {
        
        $batch->name = $request->name;
        $batch->course_id = $request->course_id;
        // $batch->id_prefix = $request->id_prefix;
        $batch->days = $request->days != null ? json_encode(explode(',', $request->days)) : null;
        $batch->start_time = $request->start_time != null ? date('H:i:s', strtotime($request->start_time)) : null;
        $batch->end_time = $request->end_time != null ? date('H:i:s', strtotime($request->end_time)) : null;
        $batch->start_date = null;

        if ($batch->save()) {
            return redirect()->route('batch.create')->with('message', 'Batch updated successfully!');    
        }
        return back()->with('message', 'Something went wrong!');
    }

    public function destroy(Batch $batch)
    {
        if ($batch->isDeletable == false) {
    		return back()->with('message', 'Unable to delete!');
        }
        
        if ($batch->delete()) {
            return back()->with('message', 'Batch deleted succcessfully!');
        }
        return back()->with('message', 'Something went wrong!');
    }


}
