<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::where('id', Auth::id())->get();
        return view('admin.assignments.index', compact('assignments'));
    }

    public function create()
    {
        return view('admin.assignments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:2048',
        ]);

        $path = $request->hasFile('file')
            ? $request->file('file')->store('assignments', 'public')
            : null;

        Assignment::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
            'teacher_id' => Auth::id(),
        ]);

        return redirect()->route('admin.assignments.index')->with('success', 'Assignment uploaded.');
    }

    public function edit(Assignment $assignment)
    {
        return view('admin.assignments.edit', compact('assignment'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('file')) {
            if ($assignment->file_path) {
                Storage::disk('public')->delete($assignment->file_path);
            }
            $assignment->file_path = $request->file('file')->store('assignments', 'public');
        }

        $assignment->update($request->only('title', 'description'));

        return redirect()->route('admin.assignments.index')->with('success', 'Assignment updated.');
    }

    public function destroy(Assignment $assignment)
    {
        if ($assignment->file_path) {
            Storage::disk('public')->delete($assignment->file_path);
        }

        $assignment->delete();
        return back()->with('success', 'Assignment deleted.');
    }

}
