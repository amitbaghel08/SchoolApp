<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('user')->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
        //Step 1: Create user with role = teacher
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'teacher',
        ]);
        // Step 2: Create teacher table entry with user_id
        Teacher::create([
            'user_id' => $user->id,
           
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher created.');
    }

    public function edit(User $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, User $teacher)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => "required|email|unique:users,email,{$teacher->id}",
          
        ]);

        $teacher->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

       

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated.');
    }

    public function destroy(User $teacher)
    {
        $teacher->teacher->delete();
        $teacher->delete();

        return back()->with('success', 'teacher deleted.');
    }
}


