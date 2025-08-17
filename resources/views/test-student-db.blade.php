<x-livewire-layout title="Student Database Test">
    <div class="container mx-auto py-8 px-4">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-database text-blue-500 mr-3"></i>
                    Student Database Component Test
                </h1>
                <p class="text-gray-600">Testing comprehensive student database with 4-step registration and document
                    management</p>
                <div class="mt-3 inline-flex items-center px-3 py-1 bg-blue-100 border border-blue-400 rounded-lg">
                    <i class="fas fa-graduation-cap text-blue-600 mr-2"></i>
                    <span class="text-blue-800 text-sm font-medium">Student Management</span>
                </div>
            </div>

            @livewire('student-db-component')
        </div>
    </div>
</x-livewire-layout>