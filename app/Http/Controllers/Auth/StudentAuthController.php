<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentAuthController extends Controller
{
    public function showRegisterForm() {
        return view('auth.register-student');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'student_number' => 'required|unique:students',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'student',
            'password' => Hash::make($request->password),
        ]);

        Student::create([
            'user_id' => $user->id,
            'student_number' => $request->student_number,
        ]);

        Auth::login($user);
        return redirect()->route('student.dashboard');
    }

    public function showLoginForm() {
        return view('auth.login-student');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials) && Auth::user()->role === 'student') {
            return redirect()->route('student.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }
}

