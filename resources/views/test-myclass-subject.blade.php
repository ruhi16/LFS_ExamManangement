<x-livewire-layout title="Class Subjects Component Test">
    <div class="container mx-auto py-8 px-4">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-clipboard-list text-teal-500 mr-3"></i>
                    Class Subjects Component Test
                </h1>
                <p class="text-gray-600">Testing assignment of subjects to classes with ordering and configuration</p>
                <div class="mt-3 inline-flex items-center px-3 py-1 bg-teal-100 border border-teal-400 rounded-lg">
                    <i class="fas fa-cube text-teal-600 mr-2"></i>
                    <span class="text-teal-800 text-sm font-medium">Basic Component</span>
                </div>
            </div>

            @livewire('myclass-subject-comp')
        </div>
    </div>
</x-livewire-layout>