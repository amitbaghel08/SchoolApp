<x-teacher-app-layout>
    <x-slot name="header">Edit Course</x-slot>

    <form method="POST" action="{{ route('teacher.courses.update', $course->id) }}">
        @csrf
         @method('PUT')
        <div>
            <x-input-label value="Title" />
            <x-text-input name="title" value="{{ $course->title }}" required class="w-full" />
        </div>

        <div class="mt-4">
            <x-input-label value="Description" />
            <x-text-input name="description" value="{{ $course->description}}" type="text" required class="w-full" />
        </div>
         <div class="mt-4">
             <input type="hidden" name="teacher_id" value="{{ auth()->user()->teacher->id }}">
        </div>

         
        <div>
            <x-input-label for="subject_id" value="Select Subject" />
            <select name="subject_id" id="subjectr_id" class="mt-1 block w-full">
                @foreach ($subjects as $subject)
                <option value="{{ $subject->id}}"
                    {{ $course->subject_id == $subject->id ? 'selected': ''}}>
                    {{$subject->name}}
                </option>
                    {{-- @if ($subject->id)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endif --}}
                @endforeach
            </select>
            
        </div>  

        <x-primary-button class="mt-4">Update Course</x-primary-button>
    </form>
</x-teacher-app-layout>
