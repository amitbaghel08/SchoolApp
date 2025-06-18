<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('user')->get();
        return view('teachers.students.index', compact('students'));
    }

    public function create()
    {
        return view('teachers.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'student_number' => 'required|unique:students',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'student',
            'password' => Hash::make($request->password),
        ]);

        $user->student()->create([
            'student_number' => $request->student_number,
        ]);

        return redirect()->route('teacher.students.index')->with('success', 'Student created.');
    }

    public function edit($id)
    {
        $student = Student::with('user')->findOrFail($id);
        return view('teachers.students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'student_number' => 'required',
        ]);

       $student = Student::findOrFail($id);
       $user = $student->user;
       $user->name = $request->name;
       $user->email = $request->email;
       $user->save();

       $student->student_number = $request->student_number;
       $student->save();

        return redirect()->route('teacher.students.index')->with('success', 'Student updated.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
       // Pehle user ko bhi delete karo
        $user = $student->user;  // relation ke through user milta hai

        $student->delete();      // student table se delete
        $user->delete();         // user table se bhi delete

        return back()->with('success', 'Student deleted.');
    }
}


