<x-admin-app-layout>
    <x-slot name="header">Add New Subject</x-slot>
     @if($errors->any())
        <ul style="color:red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('admin.subjects.store') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="name" value="Subject Name" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required  />
           
        </div>

        <div>
            <x-input-label for="teacher_id" value="Select Teacher" />
            <select name="teacher_id" id="teacher_id" class="mt-1 block w-full">
                @foreach ($teachers as $teacher)
                    @if ($teacher->user)
                        <option value="{{ $teacher->id }}">{{ $teacher->user->name }}</option>
                    @endif
                @endforeach
            </select>
            
        </div>

        <x-primary-button class="mt-4">Create Subject</x-primary-button>
    </form>
</x-admin-app-layout>
