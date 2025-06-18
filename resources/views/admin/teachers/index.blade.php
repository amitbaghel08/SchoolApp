<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Teachers</h2>
    </x-slot>

    <a href="{{ route('admin.teachers.create') }}" class="text-blue-600 underline">+ Add Teacher</a>
    @if($errors->any())
        <ul style="color:red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <table class="mt-4 w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3">S.No.</th>
                <th class="p-3">Name</th>
                <th class="p-3">Email</th>
                <th class="p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $teacher)
                <tr class="border-t text-left ">
                   <td class="p-3">{{ $loop->iteration }}</td>
                   <td class="p-3">{{ $teacher->user->name }}</td>
                   <td class="p-3">{{ $teacher->user->email }}</td>
                    
                    <td class="p-3">
                        <a href="{{ route('admin.teachers.edit', $teacher->user->id) }}" class="text-green-600 mr-2">Edit</a>
                        <form action="{{ route('admin.teachers.destroy', $teacher->user->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete teacher?')" class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-admin-app-layout>
