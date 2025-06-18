<x-admin-app-layout>
    <x-slot name="header">Courses</x-slot>
    <a href="{{ route('admin.courses.create') }}" class="text-blue-600 underline">+ Add Course</a>
    <table class="mt-4 w-full bg-white shadow rounded">
        <thead><tr class="bg-gray-100 text-left">
            <th class="p-3">S.No.</th>
            <th class="p-3">Name</th>
            <th class="p-3">Description</th>
            <th class="p-3">Teacher</th>
            <th class="p-3">Subject</th>
            <th class="p-3">Actions</th>
        </tr></thead>
        <tbody>
            @foreach ($courses as $course)
                <tr class="border-t">
                    <td class="p-3">{{ $loop->iteration }}</td>
                    <td class="p-3">{{ $course->title }}</td>
                    <td class="p-3">{{ $course->description }}</td>
                    <td class="p-3">{{ $course->teacher->user->name }}</td>
                    <td class="p-3">{{ $course->subject->name }}</td>
                    <td class="p-3">
                        <a href="{{ route('admin.courses.edit', $course) }}" class="text-green-600 mr-2">Edit</a>
                        <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete?')" class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-admin-app-layout>
