<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Submissions for: {{ $assignment->title }}</h2>
    </x-slot>

    <div class="py-12 max-w-6xl mx-auto">
        @foreach ($submissions as $submission)
            <div class="bg-white rounded shadow p-4 mb-4">
                <p><strong>Student:</strong> {{ $submission->student->name }}</p>
                <p>
                    <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank" class="text-indigo-600 underline">View Submission</a>
                </p>

                <form method="POST" action="{{ route('submissions.grade', $submission->id) }}" class="mt-2 flex gap-2">
                    @csrf
                    <input type="text" name="grade" value="{{ $submission->grade }}" placeholder="Grade (e.g. A, B+)" class="border rounded px-2 py-1" required />
                    <x-primary-button>Save</x-primary-button>
                </form>
            </div>
        @endforeach
    </div>
</x-app-layout>
