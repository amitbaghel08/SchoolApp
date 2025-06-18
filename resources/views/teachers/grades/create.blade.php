<x-app-layout>
    <x-slot name="header">Assign Grade</x-slot>

    <form method="POST" action="{{ route('grades.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="assignment_id" value="Assignment" />
            <select name="assignment_id" required>
                @foreach ($assignments as $assignment)
                    <option value="{{ $assignment->id }}">{{ $assignment->title }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <x-input-label for="student_id" value="Student" />
            <select name="student_id" required>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <x-input-label for="grade" value="Grade" />
            <x-text-input name="grade" type="text" required />
        </div>

        <div>
            <x-input-label for="comments" value="Comments (optional)" />
            <textarea name="comments" class="block w-full mt-1"></textarea>
        </div>

        <x-primary-button class="mt-4">Submit Grade</x-primary-button>
    </form>
</x-app-layout>
