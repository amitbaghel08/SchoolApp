<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TeacherAuthController extends Controller
{
    public function showRegisterForm() {
        return view('auth.register-teacher');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
           
            'email' => 'required|string|email|max:255|unique:users',
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
            
        ]);

        Auth::login($user);
        return redirect()->route('teacher.dashboard');
    }

    public function showLoginForm() {
        return view('auth.login-teacher');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials) && Auth::user()->role === 'teacher') {
            return redirect()->route('teacher.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }
}

