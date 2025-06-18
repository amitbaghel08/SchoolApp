<x-teacher-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Subject</h2>
    </x-slot>

    <a href="{{ route('teacher.subjects.create') }}" class="text-blue-600 underline">+ Add Subject</a>

    <table class="mt-4 w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3">S.No.</th>
                <th class="p-3">name</th>
                <th class="p-3">Teacher</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject)
                <tr class="border-t">
                    <td class="p-3">{{ $loop->iteration }}</td>
                    <td class="p-3">{{ $subject->name }}</td>
                    <td class="p-3">{{ auth()->user()->name }}</td>
                    <td class="p-3">
                        <a href="{{ route('teacher.subjects.edit', $subject->id) }}" class="text-green-600 mr-2">Edit</a>
                        <form action="{{ route('teacher.subjects.destroy', $subject->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete course?')" class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-teacher-app-layout>
