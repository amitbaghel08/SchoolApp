<x-teacher-app-layout>
    <x-slot name="header">Add Subjects</x-slot>
    @if($errors->any())
        <ul style="color:red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('teacher.subjects.store') }}">
        @csrf
        <div>
            <x-input-label value="Name" />
            <x-text-input name="name" required class="w-full" />
        </div>
        <div class="mt-4">
           <input type="hidden" name="teacher_id" value="{{ auth()->user()->id }}">
            <p>Teacher: <strong>{{ auth()->user()->name }}</strong></p>
        </div>

            

        <x-primary-button class="mt-6">Create Subject</x-primary-button>
    </form>
</x-teacher-app-layout>
