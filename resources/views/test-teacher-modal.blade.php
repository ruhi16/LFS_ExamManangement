<x-livewire-layout title="Teacher Modal Test">
    <div class="container mx-auto py-8 px-4">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-chalkboard-teacher text-blue-500 mr-3"></i>
                    Teacher Component Test
                </h1>
                <p class="text-gray-600">Testing Teacher component with modal functionality and debugging features</p>
                <div class="mt-3 inline-flex items-center px-3 py-1 bg-yellow-100 border border-yellow-400 rounded-lg">
                    <i class="fas fa-bug text-yellow-600 mr-2"></i>
                    <span class="text-yellow-800 text-sm font-medium">Debug Mode Active</span>
                </div>
            </div>

            @livewire('teacher-comp')
        </div>
    </div>
</x-livewire-layout>