<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoursesController extends Controller 
{

    public function index() {
        $course = Course::all();
        return $this->success($course);
    }

    public function show($id) {
        $course = Course::find($id);
        if ($course) {
            return $this->success($course);
        } else {
            return $this->error("No Course with the specified ID not found!");
        }
    }

   
    public function filter(Request $request) {   

        if ($request->has('name') && $request->has('category')) {
            $courses = Course::where('name', $request->name)->where('category', $request->category);
            return $courses->get();
        } 
        
        if ($request->has('name')) {
            $courses = Course::where('name', $request->name);
            return $courses->get();
        }
        
        if ($request->has('category')) {
            $courses = Course::where('category', $request->category);
            return $courses->get();
        }
    }

    public function store(Request $request) {
        $course = Course::create($request->all());
        return $this->success($course);
    }

    public function destroy($id) {

        $course = Course::find($id);
        if ($course) {
            $course->delete();
            return $this->success("Course Deleted!");

        } else {
            return $this->error("Course with the specified ID not found");
        }
    }

    public function success($data) {
        return response()->json($data);
    }

    public function error($text) {
        return response()->json($text);
    }

}