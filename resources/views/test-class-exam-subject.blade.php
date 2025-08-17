<x-livewire-layout title="Class Exam Subject Component Test">
    <div class="container mx-auto py-8 px-4">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-list-check text-blue-500 mr-3"></i>
                    Class Exam Subject Component Test
                </h1>
                <p class="text-gray-600">Testing configuration of exam subjects for classes with exam type combinations
                </p>
                <div class="mt-3 inline-flex items-center px-3 py-1 bg-blue-100 border border-blue-400 rounded-lg">
                    <i class="fas fa-clipboard-check text-blue-600 mr-2"></i>
                    <span class="text-blue-800 text-sm font-medium">Exam Component</span>
                </div>
            </div>

            @livewire('class-exam-subject-comp')
        </div>
    </div>
</x-livewire-layout>