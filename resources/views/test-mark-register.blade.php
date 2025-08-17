<x-livewire-layout title="Mark Register Component Test">
    <div class="container mx-auto py-8 px-4">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-chart-bar text-red-500 mr-3"></i>
                    Mark Register Component Test
                </h1>
                <p class="text-gray-600">Testing comprehensive class-wise mark register with all student marks</p>
                <div class="mt-3 inline-flex items-center px-3 py-1 bg-red-100 border border-red-400 rounded-lg">
                    <i class="fas fa-clipboard-check text-red-600 mr-2"></i>
                    <span class="text-red-800 text-sm font-medium">Report Component</span>
                </div>
            </div>

            @livewire('mark-register-comp')
        </div>
    </div>
</x-livewire-layout>