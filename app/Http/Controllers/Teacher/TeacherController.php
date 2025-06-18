<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Assignment;
use App\Models\Grade;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
   public function index()
{
    $teacher = auth()->user()->teacher;

    // ✅ Get all subjects of the logged-in teacher
    $subjects = Subject::where('teacher_id', $teacher->id)->get();
    $subjectCount = $subjects->count();

    

    // ✅ Get students enrolled in teacher's courses (through subjects or courses)
    $courses = Course::where('teacher_id', $teacher->id)->get(); // if subject has course_id
    $courseCount = $courses->count();

    // ✅ Assignments created by this teacher
    $assignments = Assignment::where('teacher_id', $teacher->id)->get();

    // ✅ Grades for teacher's assignments
    $grades = Grade::whereIn('assignment_id', $assignments->pluck('id'))->get();

    return view('teachers.dashboard', compact('subjectCount', 'courseCount', 'assignments', 'grades'));

     
}


    
}
