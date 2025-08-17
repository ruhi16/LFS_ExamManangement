<x-livewire-layout title="Marks Entry Component Test">
    <div class="container mx-auto py-8 px-4">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-edit text-orange-500 mr-3"></i>
                    Marks Entry Component Test
                </h1>
                <p class="text-gray-600">Testing student marks entry across different exam types and parts</p>
                <div class="mt-3 inline-flex items-center px-3 py-1 bg-orange-100 border border-orange-400 rounded-lg">
                    <i class="fas fa-clipboard-check text-orange-600 mr-2"></i>
                    <span class="text-orange-800 text-sm font-medium">Exam Component</span>
                </div>
            </div>

            @livewire('marks-entry-comp')
        </div>
    </div>
</x-livewire-layout>