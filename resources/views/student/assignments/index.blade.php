<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Assignments') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @forelse ($assignments as $assignment)
            <div class="bg-white shadow rounded p-4 mb-4">
                <h3 class="text-lg font-semibold">{{ $assignment->title }}</h3>
                <p class="text-gray-600 text-sm">Uploaded by: {{ $assignment->teacher->name ?? 'Unknown' }}</p>
                <p class="mt-2">{{ $assignment->description }}</p>

                @if ($assignment->file_path)
                    <a href="{{ asset('storage/' . $assignment->file_path) }}" target="_blank"
                       class="text-indigo-600 underline mt-2 inline-block">Download</a>
                @endif

                
            </div>
        @empty
            <p>No assignments available.</p>
        @endforelse
    </div>
</x-app-layout>
