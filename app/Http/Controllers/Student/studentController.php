<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;

class studentController extends Controller
{
     public function index()
    {
         $student = auth()->user()->student;
        $assignments = Assignment::latest()->get();
        return view('student.dashboard', compact('assignments'));
    }
    public function assignments()
    {
        $student = auth()->user()->student;

        // Get all course + subject IDs linked to this student
        $courseIds = $student->courses->pluck('name'); //Sirf IDs nikale
        $subjectIds = $student->subjects->pluck('id');

        // Fetch assignments matching student’s course/subject
        $assignments = Assignment::whereIn('course_id', $courseIds) //Matching records filter kare
                        ->whereIn('subject_id', $subjectIds)
                        ->orderBy('due_date', 'asc') //Nearest deadline pehle
                        ->with(['teacher.user', 'course', 'subject'])
                        ->get();

        return view('student.assignments.index', compact('assignments'));
    }
}
