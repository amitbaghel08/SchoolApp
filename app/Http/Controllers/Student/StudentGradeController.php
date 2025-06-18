<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Grade;

class StudentGradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with('assignment')
                    ->where('student_id', auth()->id())
                    ->get();

        return view('student.grades.index', compact('grades'));
    }
}
