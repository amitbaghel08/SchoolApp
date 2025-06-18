<x-app-layout>
    <x-slot name="header">Your Grades</x-slot>

    <table class="mt-4 w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3">Assignment</th>
                <th class="p-3">Grade</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($grades as $grade)
                <tr>
                    <td class="p-3">{{ $grade->assignment->title }}</td>
                    <td class="p-3">{{ $grade->grade }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No grades found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-app-layout>
