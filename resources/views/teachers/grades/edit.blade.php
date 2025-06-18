<x-app-layout>
    <x-slot name="header">Edit Grade</x-slot>

    <form method="POST" action="{{ route('grades.update', $grade) }}" class="space-y-4 mt-4">
        @csrf
        @method('PUT')

        <div>
            <label for="student_id">Select Student</label>
            <select name="student_id" id="student_id" class="block w-full">
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ $grade->student_id == $student->id ? 'selected' : '' }}>{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="assignment_id">Select Assignment</label>
            <select name="assignment_id" id="assignment_id" class="block w-full">
                @foreach ($assignments as $assignment)
                    <option value="{{ $assignment->id }}" {{ $grade->assignment_id == $assignment->id ? 'selected' : '' }}>{{ $assignment->title }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="grade">Grade</label>
            <input type="text" name="grade" id="grade" class="block w-full" value="{{ $grade->grade }}" required>
        </div>

        <div class="mt-6">
            <x-primary-button>{{ __('Update Grade') }}</x-primary-button>
        </div>
    </form>
</x-app-layout>
