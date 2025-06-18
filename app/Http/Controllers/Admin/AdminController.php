<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Assignment;
use App\Models\Grade;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard() {   
        return view('admin.dashboard', [
            'students' => Student::all(),
            'teachers' => User::all(),
            'courses' => Course::all(),
            'subjects' => Subject::all(),
            'assignments' => Assignment::all(),
            'grades' => Grade::all(),
        ]);
    }

}
