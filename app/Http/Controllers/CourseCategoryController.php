<?php

namespace App\Http\Controllers;

use App\Models\CourseCategory;
use Illuminate\Http\Request;

class CourseCategoryController extends Controller
{
    public function index(){

        $courseCategories = CourseCategory::all();
    	return view('admin.category.index', compact([
            'courseCategories'
        ]));
    }

    public function create(){
        $courseCategories = CourseCategory::all();        
    	return view('admin.category.create', compact([
            'courseCategories'
        ]));
    }

    public function store(Request $request)
    {   
        logger(json_encode($request->all()));

        if($request->has('name') == false || is_null($request->name) || strlen($request->name) < 2) {
            return back()->withErrors(['name' => 'Invalid category name']);
        } else if (CourseCategory::where('name', $request->name)->count() > 0) {
            return back()->withErrors(['name' => 'Category already exists!']);            
        }

        $category = CourseCategory::create([
            'name' => $request->name,
        ]);

        return back()->with('message', 'Category created successfully!');

    }

    public function edit(CourseCategory $category)
    {

        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, CourseCategory $category)
    {
   
        logger(json_encode($request->all()));

        if($request->has('name') == false || is_null($request->name) || strlen($request->name) < 2) {
            return back()->withErrors(['name' => 'Invalid category name']);
        } else if (CourseCategory::where('name', $request->name)->count() > 0) {
            return back()->withErrors(['name' => 'Category already exists!']);            
        }

        $category->name = $request->name;
        if ($category->save()) {
            return redirect()->route('category.create')->with('message', 'Category updated successfully!!');    
        }
        return back()->with('message', 'Something were wrong.');    
    }

    public function destroy(CourseCategory $category)
    {
        if ($category->isDeletable == false) {
    		return back()->with('message', 'Unable to delete!');
        }

        if ($category->delete()) {
    		return back()->with('message', 'Category deleted successfully!');
        }
        return back()->with('message', 'Something were wrong.');    
        
    }

}
