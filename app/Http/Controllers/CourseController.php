<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    // List courses for teacher
    public function index()
    {
        $courses = Course::where('teacher_id', auth()->user()->id)->get();
        return view('courses.index', compact('courses'));
    }

    // Show form to create new course
    public function create()
    {
        return view('courses.create');
    }

    // Store new course
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'teacher_id' => auth()->user()->id,
            'subject_id' => $request->subject_id,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    // Show a specific course
    public function show($id)
    {
        $course = Course::with('assignments')->findOrFail($id);
        return view('courses.show', compact('course'));
    }
}
