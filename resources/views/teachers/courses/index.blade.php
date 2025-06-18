<x-teacher-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Course</h2>
    </x-slot>
 @if($errors->any())
        <ul style="color:red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <a href="{{ route('teacher.courses.create') }}" class="text-blue-600 underline">+ Add Course</a>

    <table class="mt-4 w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3">S.No.</th>
                <th class="p-3">Title</th>
                <th class="p-3">Description</th>
                <th class="p-3">Teacher</th>
                <th class="p-3">Subject</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr class="border-t">
                    <td class="p-3">{{ $loop->iteration }}</td>
                    <td class="p-3">{{ $course->title }}</td>
                    <td class="p-3">{{ $course->description }}</td>
                    <td class="p-3">{{ $course->teacher->user->name }}</td>
                    <td class="p-3">{{ $course->subject->name }}</td>
                    
                    <td class="p-3">
                        <a href="{{ route('teacher.courses.edit', $course->id) }}" class="text-green-600 mr-2">Edit</a>
                        <form action="{{ route('teacher.courses.destroy', $course->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Are you sure you want to delete this student?')" class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-teacher-app-layout>
