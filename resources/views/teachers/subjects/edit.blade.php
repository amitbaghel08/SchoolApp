<x-teacher-app-layout>
    <x-slot name="header">Edit Subject</x-slot>
    @if($errors->any())
        <ul style="color:red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('teacher.subjects.update', $subject->id) }}">
        @csrf @method('PUT')

        <div>
            <x-input-label value="Name" />
            <x-text-input name="name" value="{{ old('name', $subject->name)}}" required class="w-full" />
        </div>

        <div class="mt-4">
             <input type="hidden" name="teacher_id" value="{{ auth()->user()->teacher->id }}">
        </div>

        

        <x-primary-button class="mt-4">Update Student</x-primary-button>
    </form>
</x-teacher-app-layout>
