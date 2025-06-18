<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;


use Illuminate\Http\Request;

class AssignmentSubmissionController extends Controller
{
    public function create($id)
    {
        $assignment = Assignment::findOrFail($id);
        return view('student.assignments.submit', compact('assignment'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,docx,zip|max:10240',
        ]);

        $path = $request->file('file')->store('submissions', 'public');

        AssignmentSubmission::create([
            'assignment_id' => $id,
            'student_id' => Auth::id(),
            'file_path' => $path,
        ]);

        return redirect()->route('student.assignments')->with('success', 'Assignment submitted!');
    }
}
