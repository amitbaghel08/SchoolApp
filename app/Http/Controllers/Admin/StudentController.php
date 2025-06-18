<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        // $students = User::where('role', 'student')->with('student')->get();
        $students = Student::with('user')->get();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
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

        return redirect()->route('admin.students.index')->with('success', 'Student created.');
    }

    public function edit($id)
    {
        $student = Student::with('user')->findOrFail($id);
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => "required|email",
            'student_number' => 'required',
        ]);

        $student = Student::findOrFail($id);
        $user = $student->user;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $student->student_number = $request->student_number;
        $student->save();

        return redirect()->route('admin.students.index')->with('success', 'Student updated.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);  // ID se student dhoondo
        $student->delete();   

        return back()->with('success', 'Student deleted successfully.');
    }
}


