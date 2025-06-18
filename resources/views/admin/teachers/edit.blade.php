<x-admin-app-layout>
    <x-slot name="header">Edit Teacher</x-slot>
    @if($errors->any())
        <ul style="color:red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('admin.teachers.update', $teacher->id) }}">
        @csrf @method('PUT')

        <div>
            <x-input-label value="Name" />
            <x-text-input name="name" value="{{ $teacher->name }}" required class="w-full" />
        </div>

        <div class="mt-4">
            <x-input-label value="Email" />
            <x-text-input name="email" value="{{ $teacher->email }}" required class="w-full" />
        </div>

       

        <x-primary-button class="mt-4">Update Teacher</x-primary-button>
    </form>
</x-admin-app-layout>
