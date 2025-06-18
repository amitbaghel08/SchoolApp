<x-admin-app-layout>
    <x-slot name="header">Edit Subject</x-slot>

    <form method="POST" action="{{ route('admin.subjects.update', $subject->id) }}" class="mt-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <x-input-label for="name" value="Subject Name" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                value="{{ old('name', $subject->name) }}" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="teacher_id" value="Select Teacher" />
            <select name="teacher_id" id="teacher_id" class="mt-1 block w-full">
                @foreach ($teachers as $teacher)
                  <option value="{{ $teacher->id }}"
                        {{ $subject->teacher_id == $teacher->id ? 'selected': ''}}>
                        {{ $teacher->user->name}}
                    </option>
                @endforeach
            </select>
           
        </div>

        <x-primary-button class="mt-4">Update Subject</x-primary-button>
    </form>
</x-admin-app-layout>
