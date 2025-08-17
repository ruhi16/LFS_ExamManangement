<x-livewire-layout title="Answer Script Distribution Test">
    <div class="container mx-auto py-8 px-4">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-file-alt text-purple-500 mr-3"></i>
                    Answer Script Distribution Test
                </h1>
                <p class="text-gray-600">Testing assignment of answer scripts to teachers for evaluation</p>
                <div class="mt-3 inline-flex items-center px-3 py-1 bg-purple-100 border border-purple-400 rounded-lg">
                    <i class="fas fa-clipboard-check text-purple-600 mr-2"></i>
                    <span class="text-purple-800 text-sm font-medium">Exam Component</span>
                </div>
            </div>

            @livewire('answer-script-distribution-comp')
        </div>
    </div>
</x-livewire-layout>