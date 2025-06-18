<x-teacher-app-layout>
    <x-slot name="header">All Grades</x-slot>

    <table class="mt-4 w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3">S.No.</th>
                <th class="p-3">Assignment</th>
                <th class="p-3">Student</th>
                <th class="p-3">Grade</th>
                <th class="p-3">Comments</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grades as $grade)
                <tr>
                    <td>{{ $grade->id }}</td>
                    <td>{{ $grade->assignment->title }}</td>
                    <td>{{ $grade->student->name }}</td>
                    <td>{{ $grade->grade }}</td>
                    <td>{{ $grade->comments }}</td>
                    <td class="p-3">
                        <a href="{{ route('grades.edit', $grade->id) }}" class="text-green-600 mr-2">Edit</a>
                        <form action="{{ route('grades.destroy', $grade->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete grade?')" class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-teacher-app-layout>
