<x-teacher-app-layout>
   <x-slot name="header">Create Assignment</x-slot>
     @if($errors->any())
        <ul style="color:red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('teacher.assignments.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
            @csrf

            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                
            </div>

            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
            </div>

            <div class="mt-4">
                <x-input-label for="file" :value="__('Upload File (optional)')" />
                <input id="file" name="file" type="file" class="mt-1 block w-full" />
            </div>

            <div class="mt-4">
                <p>Teacher: <strong>{{ auth()->user()->name }}</strong></p>
                
            </div>

            <div class="mt-4">
                <x-input-label for="subject_id" value="Subject" />
                <select name="subject_id" id="subject_id" required class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Select Subject</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
            </div>

             <div class="mt-4">
                <x-input-label for="course_id" value="Course" />
                <select name="course_id" id="course_id" required class="w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Select Course</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <x-input-label for="due_date" value="Due Date" />
                <input type="date" name="due_date" class="mt-1 block w-full" required>
            </div>

            <div class="mt-6">
                <x-primary-button>{{ __('Submit Assignment') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-teacher-app-layout>
