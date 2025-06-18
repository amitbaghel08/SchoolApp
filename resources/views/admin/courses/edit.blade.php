<x-admin-app-layout>
    <x-slot name="header">Edit Course</x-slot>

    <form method="POST" action="{{ route('admin.courses.update', $course->id) }}">
        @csrf
         @method('PUT')
        <div>
            <x-input-label value="Title" />
            <x-text-input name="title" value="{{ $course->title }}" required class="w-full" />
        </div>

        <div class="mt-4">
            <x-input-label value="Description" />
            <x-text-input name="description" value="{{ old('name', $course->description)}}" type="text" required class="w-full" />
        </div>

        <div>
            <x-input-label for="teacher_id" value="Select Teacher" />
            <select name="teacher_id" id="teacher_id" class="mt-1 block w-full">
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}"
                        {{ $course->teacher_id == $teacher->id ? 'selected': ''}}>
                        {{ $teacher->user->name}}
                    </option>
                    {{-- @if ($teacher->user)
                        <option value="{{ $teacher->id }}">{{ $teacher->user->name }}</option>
                    @endif --}}
                @endforeach
            </select>
            
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
</x-admin-app-layout>
