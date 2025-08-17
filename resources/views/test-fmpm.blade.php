<x-livewire-layout title="FMPM Settings Component Test">
    <div class="container mx-auto py-8 px-4">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-calculator text-green-500 mr-3"></i>
                    FMPM Settings Component Test
                </h1>
                <p class="text-gray-600">Testing full marks, pass marks, and time allocation configuration for exams</p>
                <div class="mt-3 inline-flex items-center px-3 py-1 bg-green-100 border border-green-400 rounded-lg">
                    <i class="fas fa-clipboard-check text-green-600 mr-2"></i>
                    <span class="text-green-800 text-sm font-medium">Exam Component</span>
                </div>
            </div>

            @livewire('exam-settings-fmpm-comp')
        </div>
    </div>
</x-livewire-layout>