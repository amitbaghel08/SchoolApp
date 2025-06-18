<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="flex justify-between items-center bg-white shadow px-6 py-4">
        <div class="text-xl font-semibold">Admin Panel</div>
        <div class="flex items-center space-x-4">
            <span>{{ Auth::user()->name }}</span>
            <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:underline">Profile</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-red-500 hover:underline">Logout</button>
            </form>
        </div>
    </div>

    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        <aside class="w-64 bg-white shadow-md">
            <div class="p-4 font-bold text-xl border-b">Navigation</div>
            <nav class="p-4">
                <ul class="space-y-2">
                    <li><a href="{{ route('admin.dashboard') }}" class="block hover:text-blue-500">Dashboard</a></li>
                    <li><a href="{{ route('admin.students.index') }}" class="block hover:text-blue-500">Students</a></li>
                    <li><a href="{{ route('admin.teachers.index') }}" class="block hover:text-blue-500">Teachers</a></li>
                    <li><a href="{{ route('admin.courses.index') }}" class="block hover:text-blue-500">Courses</a></li>
                    <li><a href="{{ route('admin.subjects.index') }}" class="block hover:text-blue-500">Subjects</a></li>
                    <li><a href="{{ route('admin.assignments.index') }}" class="block hover:text-blue-500">Assignments</a></li>
                    <li><a href="{{ route('admin.grades.index') }}" class="block hover:text-blue-500">Grades</a></li>
                </ul>
            </nav>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 p-6">
            <header class="mb-4 border-b pb-2">
                <h1 class="text-2xl font-semibold">{{ $header ?? 'Admin Dashboard' }}</h1>
            </header>

            {{ $slot }}
        </main>
    </div>
</body>
</html>
