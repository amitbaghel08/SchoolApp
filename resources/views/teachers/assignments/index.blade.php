<x-teacher-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">My Assignments</h2>
    </x-slot>

    <a href="{{ route('teacher.assignments.create') }}" class="text-blue-600 underline">Upload New Assignment</a>

    @foreach($assignments as $assignment)
        <div class="mt-4 p-4 bg-white rounded shadow">
            <h3>Tittle: {{ $assignment->title }}</h3>
            <p>Description: {{ $assignment->description }}</p>
            <p>Subject: {{ $assignment->subject->name }}</p>
            <p>Course: {{ $assignment->course->title }}</p>
            <p>Due Date: {{ $assignment->due_date }}</p>

            {{-- @if($assignment->file_path)
                <a href="{{ asset('storage/' . $assignment->file_path) }}" class="text-blue-600 underline">Download</a>
            @endif --}}
            <div class="mt-2">
                <a href="{{ route('teacher.assignments.edit', $assignment->id) }}" class="text-green-600 mr-2">Edit</a>
                <form action="{{ route('teacher.assignments.destroy', $assignment->id) }}" method="POST" class="inline-block">
                    @csrf @method('DELETE')
                    <button class="text-red-600" onclick="return confirm('Delete this assignment?')">Delete</button>
                </form>
            </div>
        </div>
    @endforeach
</x-teacher-app-layout>
