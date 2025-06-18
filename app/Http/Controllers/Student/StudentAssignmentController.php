<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;



class StudentAssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::latest()->get();
        return view('student.assignments.index', compact('assignments'));
    }
}
