<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Mockery\Matcher\Subset;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('teacher')->get();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        $teachers = \App\Models\Teacher::with('user')->get();
        return view('admin.subjects.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:subjects',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        Subject::create($request->only('name', 'teacher_id'));
        return redirect()->route('admin.subjects.index')->with('success', 'Subject created.');
    }

    public function edit($id)
    {
        $subject     = Subject::findOrFail($id);
        $teachers = Teacher::with('user')->get();
        return view('admin.subjects.edit', compact('subject','teachers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'teacher_id' => 'required|exists:teachers,id',
        ]);
       $subject = Subject::findOrFail($id);
       $subject->name = $request->name;
       $subject->teacher_id =$request->teacher_id;
       $subject->save();
        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return back()->with('success', 'Subject deleted.');
    }
}
