<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Step 1: Get current authenticated user
        $user = Auth::user();

        // Step 2: Find the Teacher record linked to this user
        $teacher = Teacher::where('user_id', $user->id)->first();

        // Step 3: If teacher exists, get only his subjects
        if ($teacher) {
            $subjects = $teacher->subjects()->with('course')->get();
        } else {
            $subjects = collect(); // empty list
        }

        return view('teachers.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = auth()->user()->name;
        return view('teachers.subjects.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            
        ]);

         // Get the teacher ID from logged-in user
        $teacherId = auth()->user()->teacher->id;

        $subject = Subject::create([
            'name' => $request->name,
            'teacher_id' =>$teacherId,
        ]);
        return redirect()->route('teacher.subjects.index')->with('success', 'subject created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = Subject::where('id', $id)
                      ->where('teacher_id', auth()->user()->teacher->id)
                      ->firstOrFail();

        return view('teachers.subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Get the subject only if it belongs to the logged-in teacher
        $subjects = Subject::where('id', $id)
                        ->where('teacher_id', auth()->user()->teacher->id)
                        ->firstOrFail();

        // Update the subject
        $subjects->update([
            'name' => $request->name,
        ]);
        return redirect()->route('teacher.subjects.index')->with('success', 'Subject updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find subject only if it belongs to this teacher
        $subject = Subject::findOrFail($id);

        $subject->delete();

        return redirect()->route('teacher.subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
