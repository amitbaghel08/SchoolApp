<x-admin-app-layout>
    <x-slot name="header">Admin Dashboard</x-slot>

    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-lg font-bold">Students</h2>
            <p>Total: {{ \App\Models\Student::count() }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-lg font-bold">Teachers</h2>
            <p>Total: {{ \App\Models\Teacher::count() }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-lg font-bold">Courses</h2>
            <p>Total: {{ \App\Models\Course::count() }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded">
            <h2 class="text-lg font-bold">Subjects</h2>
            <p>Total: {{ \App\Models\Subject::count() }}</p>
        </div>
         <div class="bg-white p-4 shadow rounded">
            <h2 class="text-lg font-bold">Assignments</h2>
            <p>Total: {{ \App\Models\Assignment::count() }}</p>
        </div>
         <div class="bg-white p-4 shadow rounded">
            <h2 class="text-lg font-bold">Grades</h2>
            <p>Total: {{ \App\Models\Grade::count() }}</p>
        </div>
    </div>
</x-admin-app-layout>
