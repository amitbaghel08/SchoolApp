<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TeacherAssignmentController extends Controller
{
    public function create()
    {
        return view('teachers.assignments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,docx,zip|max:10240',
        ]);

        $assignment = new Assignment();
        $assignment->title = $request->title;
        $assignment->description = $request->description;
        $assignment->teacher_id = Auth::id();

        if ($request->hasFile('file')) {
            $assignment->file_path = $request->file('file')->store('assignments', 'public');
        }

        $assignment->save();

        return redirect()->route('teacher.dashboard')->with('success', 'Assignment uploaded!');
    }
}

