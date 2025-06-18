<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Assignments</h2>
    </x-slot>

    <a href="{{ route('admin.assignments.create') }}" class="text-blue-600 underline">Upload New Assignment</a>
    <table class="mt-4 w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3">S. No.</th>
                <th class="p-3">Tittle</th>
                <th class="p-3">Tittle</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tbody>
             @foreach($assignments as $assignment)
                <tr>
                    <td class="p-3">{{ $loop->iteration }}</td>
                    <td>{{ $assignment->title }}</td>
                    <td>{{ $assignment->description}}</td>
                    <td class="p-3">
                        <a href="{{ route('admin.assignments.edit', $assignment->id) }}" class="text-green-600 mr-2">Edit</a>
                        <form action="{{ route('admin.assignments.destroy', $assignment->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete this assignment?')" class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
           
   
       
</x-admin-app-layout>
