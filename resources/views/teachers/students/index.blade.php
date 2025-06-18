<x-teacher-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Students</h2>
    </x-slot>

    <a href="{{ route('teacher.students.create') }}" class="text-blue-600 underline">+ Add Student</a>

    <table class="mt-4 w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3">S.No.</th>
                <th class="p-3">Name</th>
                <th class="p-3">Email</th>
                <th class="p-3">Student No.</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr class="border-t">
                    <td class="p-3">{{ $loop->iteration }}</td>
                    <td class="p-3">{{ $student->user->name }}</td>
                    <td class="p-3">{{ $student->user->email }}</td>
                    <td class="p-3">{{$student->student_number }}</td>
                    <td class="p-3">
                        <a href="{{ route('teacher.students.edit', $student->id) }}" class="text-green-600 mr-2">Edit</a>
                        <form action="{{ route('teacher.students.destroy', $student->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete student?')" class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-teacher-app-layout>
