<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Welcome, {{ Auth::user()->name }}!</h3>

                <p class="text-gray-700 mb-2">This is your student dashboard.</p>

                <ul class="list-disc ml-6 text-gray-600">
                    <li>View your courses and subjects</li>
                    <li>Download assignments uploaded by teachers</li>
                    <li>View grades</li>
                    <li>Edit your profile</li>
                </ul>

                <div class="mt-6">
                    <h2 class="text-xl font-semibold">Recent Grades</h2>
                    <ul class="mt-2 list-disc pl-5">
                        @foreach (\App\Models\Grade::latest()->take(5)->get() as $grade)
                            <li>{{ $grade->assignment->title }} — Grade: {{ $grade->grade }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ route('student.grades.index') }}" class="text-blue-500 underline">View all grades</a>
                </div>

                <div class="mt-6">
                    <h2 class="text-xl font-semibold">Recent Assignments</h2>
                    <ul class="mt-2 list-disc pl-5">
                        @foreach (\App\Models\Assignment::latest()->take(5)->get() as $assignment)
                            <li>
                                {{ $assignment->title }} —
                                <a href="{{ asset('storage/' . $assignment->file_path) }}" class="text-blue-600 underline" target="_blank">
                                    View File
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('student.assignments') }}" class="text-blue-500 underline mt-2 inline-block">View all assignments</a>
                </div>

                <div class="p-4">
                    @forelse ($assignments as $assignment)
                        <div class="mb-4 p-4 border rounded shadow">
                            <h3 class="text-lg font-bold">{{ $assignment->title }}</h3>
                            <p class="text-sm text-gray-600">
                                Course: {{ $assignment->course->title }} | 
                                Subject: {{ $assignment->subject->name }} | 
                                Teacher: {{ $assignment->teacher->user->name }}
                            </p>
                            <p class="mt-2">{{ $assignment->description }}</p>
                            @if ($assignment->file_path)
                                <a href="{{ asset('storage/' . $assignment->file_path) }}" target="_blank"
                                class="text-blue-600 underline mt-2 inline-block">Download</a>
                            @endif
                            <p class="text-sm mt-2 text-red-600">Due: {{ \Carbon\Carbon::parse($assignment->due_date)->format('d M, Y') }}</p>
                        </div>
                    @empty
                        <p>No assignments available.</p>
                    @endforelse
                </div>

            </div>
           
        </div>
    </div>

    
</x-app-layout>
