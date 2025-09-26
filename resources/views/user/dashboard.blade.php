@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-8 sm:px-10 sm:py-10">
            <div class="flex flex-col md:flex-row items-center">
                <div class="flex-shrink-0 mb-6 md:mb-0 md:mr-8">
                    <div
                        class="bg-gray-200 border-2 border-dashed rounded-xl w-32 h-32 flex items-center justify-center">
                        <i class="fas fa-user-graduate text-gray-500 text-4xl"></i>
                    </div>
                </div>
                <div class="text-center md:text-left text-white">
                    <h1 class="text-3xl font-bold">Welcome, {{ Auth::user()->name }}!</h1>
                    <p class="mt-2 text-blue-100">
                        <i class="fas fa-id-card mr-2"></i>
                        Student Dashboard
                    </p>
                    <p class="mt-1 text-blue-100">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Today is {{ date('d M, Y') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="p-6 sm:p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Profile Card -->
                <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                            <i class="fas fa-user-graduate text-xl"></i>
                        </div>
                        <h3 class="ml-4 text-lg font-semibold text-gray-900">My Profile</h3>
                    </div>
                    <p class="mt-4 text-gray-600">
                        View and manage your personal and academic information.
                    </p>
                    <a href="{{ route('user.profile') }}"
                        class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        View Profile
                        <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>

                <!-- Exams Card -->
                <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <i class="fas fa-clipboard-check text-xl"></i>
                        </div>
                        <h3 class="ml-4 text-lg font-semibold text-gray-900">My Exams</h3>
                    </div>
                    <p class="mt-4 text-gray-600">
                        Check your upcoming exams, results, and schedules.
                    </p>
                    <button
                        class="mt-4 inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                        View Exams
                        <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </button>
                </div>

                <!-- Attendance Card -->
                <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                            <i class="fas fa-calendar-check text-xl"></i>
                        </div>
                        <h3 class="ml-4 text-lg font-semibold text-gray-900">Attendance</h3>
                    </div>
                    <p class="mt-4 text-gray-600">
                        Track your attendance records and statistics.
                    </p>
                    <button
                        class="mt-4 inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors">
                        View Attendance
                        <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection