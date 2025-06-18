<x-admin-app-layout>
    <x-slot name="header">Add Student</x-slot>
    @if($errors->any())
        <ul style="color:red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('admin.students.store') }}">
        @csrf
        <div>
            <x-input-label value="Name" />
            <x-text-input name="name" required class="w-full" />
        </div>

        <div class="mt-4">
            <x-input-label value="Email" />
            <x-text-input name="email" type="email" required class="w-full" />
        </div>

        <div class="mt-4">
            <x-input-label value="Student Number" />
            <x-text-input name="student_number" required class="w-full" />
        </div>

        <div class="mt-4">
            <x-input-label value="Password" />
            <x-text-input name="password" type="password" required class="w-full" />
        </div>

        <div class="mt-4">
            <x-input-label value="Confirm Password" />
            <x-text-input name="password_confirmation" type="password" required class="w-full" />
        </div>

        <x-primary-button class="mt-4">Create Student</x-primary-button>
    </form>
</x-admin-app-layout>
