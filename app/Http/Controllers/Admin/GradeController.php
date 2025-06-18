<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Assignment;
use App\Models\User;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['assignment', 'student'])->get();
        return view('admin.grades.index', compact('grades'));
    }

    public function create()
    {
        $assignments = Assignment::all();
        $students = User::where('role', 'student')->get();
        return view('admin.grades.create', compact('assignments', 'students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'assignment_id' => 'required|exists:assignments,id',
            'student_id' => 'required|exists:users,id',
            'grade' => 'required|string|max:10',
            'comments' => 'nullable|string',
        ]);

        Grade::create($validated);

        return redirect()->route('admin.grades.index')->with('success', 'Grade assigned successfully.');
    }

    public function edit(Grade $grade)
    {
        $students = User::where('role', 'student')->get();
        $assignments = Assignment::where('teacher_id', auth()->id())->get();

        return view('admin.grades.edit', compact('grade', 'students', 'assignments'));
    }

    public function update(Request $request, Grade $grade)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'assignment_id' => 'required|exists:assignments,id',
            'grade' => 'required|string|max:5',
        ]);

        $grade->update($validated);

        return redirect()->route('admin.grades.index')->with('success', 'Grade updated.');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('admin.grades.index')->with('success', 'Grade deleted.');
    }

}
