<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisteredTeacherController extends Controller
{
    public function create()
    {
        return view('auth.register-teacher');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'employee_id' => 'required|string|unique:teachers',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'teacher',
            'password' => Hash::make($request->password),
        ]);

        Teacher::create([
            'user_id' => $user->id,
            'employee_id' => $request->employee_id,
        ]);

        Auth::login($user);
        return redirect()->route('teacher.dashboard');
    }
}
