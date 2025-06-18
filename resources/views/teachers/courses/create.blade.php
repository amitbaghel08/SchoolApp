<x-teacher-app-layout>
    <x-slot name="header">Add Course</x-slot>
     @if($errors->any())
        <ul style="color:red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('teacher.courses.store') }}">
        @csrf
        <div>
            <x-input-label value="Title :" />
            <x-text-input name="title" required class="w-full" />
        </div>

        <div class="mt-4">
            <x-input-label value="Description:" />
            <x-text-input name="description"  required class="w-full" />
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

       

        <x-primary-button class="mt-4">Create Student</x-primary-button>
    </form>
</x-teacher-app-layout>
