<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function index()
    {
        $teacher = auth()->user()->teacher;
        $assignments = $teacher->assignments()//Teacher model ka relation (hasMany)
                    ->with('course', 'subject') //Relations eager load kar rahe hain taaki loop me bar-bar query na lage
                    ->latest() //Newest assignments first
                    ->get();
        return view('teachers.assignments.index', compact('assignments'));
    }

    public function create()
    {
        $teacher = auth()->user()->teacher;
        $courses = $teacher->courses;
        $subjects = $teacher->subjects;
        return view('teachers.assignments.create', compact('courses', 'subjects'));
       
    }

    public function store(Request $request)
    {
        $request->validate([
        'course_id' => 'required|exists:courses,id',
        'subject_id' => 'required|exists:subjects,id',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        'due_date' => 'required|date',
        ]);

        $filePath = $request->hasFile('file') //Agar file upload hui ho to
            ? $request->file('file')->store('assignments', 'public')
            : null;

        Assignment::create([
        'teacher_id' => auth()->user()->teacher->id,
        'course_id' => $request->course_id,
        'subject_id' => $request->subject_id,
        'title' => $request->title,
        'description' => $request->description,
        'file_path' => $filePath,
        'due_date' => $request->due_date,
        ]);

        return redirect()->route('teacher.assignments.index')->with('success', 'Assignment created successfully.');
    }

    public function edit(Assignment $assignment)
    {
        $teacher = auth()->user()->teacher;
        if($assignment->teacher_id != $teacher->id){
            abort(403);
        }
        $courses = $teacher->courses;
        $subjects = $teacher->subjects;
        return view('teachers.assignments.edit', compact('assignment', 'courses', 'subjects'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        
        $teacher = auth()->user()->teacher;
        if ($assignment->teacher_id !== $teacher->id) {
            abort(403);
        }
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'due_date' => 'required|date',
        ]);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('assignments', 'public');
            $assignment->file_path = $filePath;
        }

       $assignment->update([
        'course_id' => $request->course_id,
        'subject_id' => $request->subject_id,
        'title' => $request->title,
        'description' => $request->description,
        'due_date' => $request->due_date,
    ]);

        return redirect()->route('teacher.assignments.index')->with('success', 'Assignment updated.');
    }

    public function destroy(Assignment $assignment)
    {
        $teacher = auth()->user()->teacher;

        if ($assignment->teacher_id !== $teacher->id) {
            abort(403);
        }

        $assignment->delete();

        return back()->with('success', 'Assignment deleted.');
    }

}
