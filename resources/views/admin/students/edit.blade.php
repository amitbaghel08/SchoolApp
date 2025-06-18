<x-admin-app-layout>
    <x-slot name="header">Edit Student</x-slot>
    @if($errors->any())
        <ul style="color:red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('admin.students.update', $student->id) }}">
        @csrf @method('PUT')

        <div>
            <x-input-label value="Name" />
            <x-text-input name="name" value="{{ $student->user->name }}" required class="w-full" />
        </div>

        <div class="mt-4">
            <x-input-label value="Email" />
            <x-text-input name="email" value="{{ $student->user->email }}" required class="w-full" />
        </div>

        <div class="mt-4">
            <x-input-label value="Student Number" />
            <x-text-input name="student_number" value="{{ $student->student_number }}" required class="w-full" />
        </div>

        <x-primary-button class="mt-4">Update Student</x-primary-button>
    </form>
</x-admin-app-layout>
