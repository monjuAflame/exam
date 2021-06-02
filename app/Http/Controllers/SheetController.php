<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Sheet;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\CreateSheetRequest;
use App\Traits\RedirectPages;

class SheetController extends Controller
{

    use RedirectPages;

    public function index()
    {
        $sheets = Sheet::with('course')->get();
        return view('admin.sheet.index', compact('sheets'));
    }

    public function create()
    {
        $sheets = Sheet::with('course')->get();
        $courses = Course::all();
        return view('admin.sheet.create', compact('courses', 'sheets'));
    }

    public function store(CreateSheetRequest $request)
    {
        $sheet = Sheet::createNew($request);

        if ($sheet instanceof Sheet) {
            return back()->with('message', 'Sheet created successfully!');
        } else {
            return back()->with('message', 'Something went wrong!')->withInput();
        }
    }

    public function edit(Sheet $sheet)
    {
        $courses = Course::all();
        return view('admin.sheet.edit', compact('sheet','courses'));
    }

    public function update(CreateSheetRequest $request, Sheet $sheet)
    {
        $sheet->course_id = $request->course_id;
        $sheet->name = $request->name;
        if ($sheet->save()) {
            return redirect()->route('sheet.create')->with('message', 'Sheet updated successfuly!');
        }
        return back()->with('message', 'Something went wrong!');
    }

    public function destroy(Sheet $sheet)
    {
        if ($sheet->isDeletable == false) {
    		return back()->with('message', 'Unable to delete!');
        }

        if ($sheet->delete()) {
            return back()->with('message', 'Sheet deleted successfuly!');
        }
        return back()->with('message', 'Something went wrong!');

    }

    public function attach(Request $request, User $user)
    {
        $message = [];
        $sheet_section = 'profile-sheet-section';
        $previous_url = url()->previous();

        if($request->has('new_sheet_id') == false || !is_array($request->new_sheet_id) || count($request->new_sheet_id) == 0) {
            $message = [
                'sheet_message' => 'Invalid Request!',
            ];
        } else {

            try {

                $sheet_ids = $request->new_sheet_id;
                if (Sheet::sheetsExist($sheet_ids) == false) {
                    $message = [
                        'sheet_message' => 'All sheet(s) does not exist!',
                    ];
                } else {
                    $user->attachSheets($sheet_ids);
                    $message = [
                        'sheet_message' => 'Sheet attached to the student successfully!',
                    ];
                }

            } catch (Exception $e) {
                logger($e->getMessage());
                $message = [
                    'sheet_message' => 'Something went wrong!',
                ];                
            }

        }

        return $this->redirectTo($previous_url, $sheet_section, $message);
    }

    public function detach(Request $request, User $user)
    {
        $message = [];
        $sheet_section = 'profile-sheet-section';
        $previous_url = url()->previous();

        if($request->has('detach_sheet_id') == false || is_null($request->detach_sheet_id) || !is_numeric($request->detach_sheet_id)) {
            $message = [
                'sheet_message' => 'Invalid Request!',
            ];
        } else {
            $sheet = Sheet::find($request->detach_sheet_id);
            if ($sheet == null || $user->sheets->contains($sheet) == false) {
                $message = [
                    'sheet_message' => 'Invalid Request!',
                ];
            } else {
                try {
                    $user->sheets()->detach($sheet);
                    $message = [
                        'sheet_message' => 'Sheet detached from the student successfully!',
                    ];
                } catch (Exception $e) {
                    logger($e->getMessage());
                    $message = [
                        'sheet_message' => 'Something went wrong!',
                    ];
                }
            }
        }
        return $this->redirectTo($previous_url, $sheet_section, $message);        

    }

}
