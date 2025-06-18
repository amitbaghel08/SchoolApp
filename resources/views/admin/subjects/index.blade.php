<x-admin-app-layout>
    <x-slot name="header">Subject</x-slot>
    <a href="{{ route('admin.subjects.create') }}" class="text-blue-600 underline">+ Add Subject</a>
    <table class="mt-4 w-full bg-white shadow rounded">
        <thead><tr class="bg-gray-100 text-left">
            <th class="p-3">S. No.</th>
            <th class="p-3">Name</th>
            <th class="p-3">Teacher</th>
            <th class="p-3">Actions</th>
        </tr></thead>
        <tbody>
            @foreach ($subjects as $subject)
                <tr class="border-t">
                    <td class="p-3">{{ $loop->iteration }}</td>
                    <td class="p-3">{{ $subject->name }}</td>
                    <td class="p-3">{{ $subject->teacher->user->name }}</td>
                    <td class="p-3">
                        <a href="{{ route('admin.subjects.edit', $subject->id) }}" class="text-green-600 mr-2">Edit</a>
                        <form method="POST" action="{{ route('admin.subjects.destroy', $subject) }}" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete?')" class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-admin-app-layout>
