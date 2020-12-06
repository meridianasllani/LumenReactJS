<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoursesController extends Controller 
{

    public function index() {
        $course = Course::all();
        return $this->response($course);
    }

    public function show($id) {
        $course = Course::find($id);
        if ($course) {
            return $this->response($course);
        } else {
            return $this->response("No Course with the specified ID not found!");
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

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'category' => 'required|in:Free,Subscription,Locked,Paid',
            'teacher' => 'required',
            'video_link' => 'required|url'
        ]);

        $course = Course::create($request->all());
        return $this->response($course);
    }

    public function destroy($id) {

        $course = Course::find($id);
        if ($course) {
            $course->delete();
            return $this->response("Course Deleted!");
        } else {
            return $this->response("Course with the specified ID not found");
        }
    }

    public function response($response) {
        return response()->json($response);
    }
}