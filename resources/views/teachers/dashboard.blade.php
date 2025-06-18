<x-teacher-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Teacher Dashboard</h2></x-slot>

    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-lg font-bold">Students</h2>
            <p>Total: {{ \App\Models\Student::count() }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-lg font-bold">Assignments</h2>
            <p>Total: {{ \App\Models\Assignment::count() }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-lg font-bold">Courses</h2>
            <p>Total:{{ $courseCount }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-lg font-bold">Subjects</h2>
           <p>Total: {{ $subjectCount }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-lg font-bold">Grades</h2>
            <p>Total: {{ \App\Models\Grade::count() }}</p>
        </div>
       
    </div>

   

   
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Welcome, {{ Auth::user()->name }}!</h3>

                <p class="text-gray-700 mb-2">This is your teacher dashboard.</p>

                <ul class="list-disc ml-6 text-gray-600">
                    <li>Manage Courses and Subjects</li>
                    <li>Upload Assignments</li>
                    <li>Grade Student Submissions</li>
                    <li>Edit Profile</li>
                </ul>

                <div class="mt-6">
                    <a href="{{ route('teacher.assignments.create') }}"
                       class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Upload New Assignment
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- <h2>Students in Your Courses</h2>
    <ul>
        @foreach ($students as $student)
            <li>{{ $student->user->name }} ({{ $student->student_number }})</li>
        @endforeach
    </ul>

    <h2>Your Assignments</h2>
    <ul>
        @foreach ($assignments as $assignment)
            <li>{{ $assignment->title }}</li>
        @endforeach
    </ul>

    <h2>Grades Given</h2>
    <ul>
        @foreach ($grades as $grade)
            <li>{{ $grade->student->user->name }} - {{ $grade->assignment->title }}: {{ $grade->grade }}</li>
        @endforeach
    </ul> --}}
</x-teacher-app-layout>
