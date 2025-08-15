<x-livewire-layout title="Subject Teacher Test">
    <div class="container mx-auto py-8 px-4">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-user-graduate text-purple-500 mr-3"></i>
                    Subject Teacher Component Test
                </h1>
                <p class="text-gray-600">Testing Subject-Teacher assignment functionality with debugging features</p>
                <div class="mt-3 inline-flex items-center px-3 py-1 bg-purple-100 border border-purple-400 rounded-lg">
                    <i class="fas fa-flask text-purple-600 mr-2"></i>
                    <span class="text-purple-800 text-sm font-medium">Test Environment</span>
                </div>
            </div>

            @livewire('subject-teacher-comp')
        </div>
    </div>
</x-livewire-layout>