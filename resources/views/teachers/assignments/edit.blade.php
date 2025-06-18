<x-teacher-app-layout>
    <x-slot name="header">Edit Assignment</x-slot>
     @if($errors->any())
        <ul style="color:red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('teacher.assignments.update', $assignment->id) }}" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" name="title" value="{{ $assignment->title}}" type="text" class="mt-1 block w-full" required />
            </div>

            <div class="mt-4">
                <label for="description" class="block text-sm font-medium">Description</label>
                <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ $assignment->description }}</textarea>
            </div>

            <div class="mb-4">
                <label for="due_date" class="block text-sm font-medium">Due Date</label>
                <input type="date" name="due_date" id="due_date" value="{{ $assignment->due_date }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

           <div class="mb-4">
            <label for="file_path" class="block text-sm font-medium">Replace File (optional)</label>
            <input type="file" name="file_path" id="file_path" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @if($assignment->file_path)
                <p class="mt-2 text-sm text-gray-600">Current file: <a href="{{ asset('storage/' . $assignment->file_path) }}" target="_blank" class="text-blue-500 underline">View</a></p>
            @endif
        </div>

            <div class="mt-4">
                <p>Teacher: <strong>{{ auth()->user()->name }}</strong></p>
                
            </div>

            <div class="mt-4">
                <label for="subject_id" class="block text-sm font-medium">Subject</label>
                <select name="subject_id" id="subject_id" class="mt-1 block w-full">
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id}}"
                            {{ $assignment->subject_id == $subject->id ? 'selected': ''}}>
                            {{$subject->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="course_id" class="block text-sm font-medium">Course</label>
                <select name="course_id" id="course_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ $assignment->course_id == $course->id ? 'selected' : '' }}>
                            {{ $course->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-6">
                <x-primary-button>{{ __('Save Assignment') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-teacher-app-layout>
