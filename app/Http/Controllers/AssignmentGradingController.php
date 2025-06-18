<?php

namespace App\Http\Controllers;
use app\Models\Assignment;
use app\Models\AssignmentSubmission;

use Illuminate\Http\Request;

class AssignmentGradingController extends Controller
{
    public function index($assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);
        $submissions = $assignment->submissions()->with('student')->get();
        return view('teacher.assignments.submissions', compact('assignment', 'submissions'));
    }

    public function grade(Request $request, $submissionId)
    {
        $request->validate([
            'grade' => 'required|string|max:5',
        ]);

        $submission = AssignmentSubmission::findOrFail($submissionId);
        $submission->grade = $request->grade;
        $submission->save();

        return back()->with('success', 'Grade saved!');
    }
}
