<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Step 1: Get current authenticated user
        $user = Auth::user();
        // Step 2: Find the Teacher record linked to this user
        $teacher = Teacher::where('user_id', $user->id)->first();

        if ($teacher) {
            $courses = $teacher->courses()->with('subject')->get();
        } else {
            $courses = collect(); // empty list
        }
        
        return view('teachers.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = auth()->user()->name;
        $subjects = Subject::all();
        
        return view('teachers.courses.create', compact('subjects', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'title' => 'required',
        'description' => 'required',
        'subject_id' => 'required|exists:subjects,id',
        
        ]);

        Course::create([
            'title'=> $request->title,
            'description' => $request->description,
            'subject_id' => $request->subject_id,
            'teacher_id' => auth()->user()->teacher->id,
        ]);

        return redirect()->route('teacher.courses.index')->with('success', 'Course created successfully');
    }

      /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $teachers = auth()->user()->teacher->id;
        $subjects = Subject::all();
        return view('teachers.courses.edit', compact('course', 'teachers', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
           'title' => 'required|string|max:255',
            'description' => 'required|string',
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);
        $course = Course::findOrFail($id);
        $course->title = $request->title;
        $course->description = $request->description;
        $course->teacher_id = $request->teacher_id;
        $course->subject_id = $request->subject_id;
        $course->save();

        return redirect()->route('teacher.courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('teacher.courses.index')->with('success', 'Course deleted successfully.');
    }
}
