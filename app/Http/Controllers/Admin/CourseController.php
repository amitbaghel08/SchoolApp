<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Subject;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['teacher.user', 'subject'])->get ();//eager loads the related teacher and their associated user, plus the subject.
        return view('admin.courses.index', compact('courses'));//compact passes the data to the view
    }

    public function create()
    {
        //Show form to create a course.
        $teachers = Teacher::with('user')->get();//gets each teacher's user info to display the name
        $subjects = Subject::all();//to populate the subject dropdown.
        return view('admin.courses.create',  compact('teachers', 'subjects'));
    }

    public function store(Request $request)
    {
        //ensures data is correct before inserting.
        $request->validate([
            'title' => 'required|unique:courses',
            'description' => 'required',
            'teacher_id' => 'required|exists:teachers,id',//makes sure the selected teacher exists.
            'subject_id' => 'required|exists:subjects,id',
        ]);

        //saves the course in the DB.
        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'teacher_id' => $request->teacher_id,
            'subject_id' => $request->subject_id,

        ]);
        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $teachers = Teacher::with('user')->get();
        $subjects = Subject::all();
        return view('admin.courses.edit', compact('course', 'teachers', 'subjects'));
    }

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

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully.');
    }
}
