<x-livewire-layout title="Classes Component Test">
    <div class="container mx-auto py-8 px-4">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-school text-blue-500 mr-3"></i>
                    Classes Component Test
                </h1>
                <p class="text-gray-600">Testing school classes management with ordering and configuration</p>
                <div class="mt-3 inline-flex items-center px-3 py-1 bg-blue-100 border border-blue-400 rounded-lg">
                    <i class="fas fa-cube text-blue-600 mr-2"></i>
                    <span class="text-blue-800 text-sm font-medium">Basic Component</span>
                </div>
            </div>

            @livewire('myclass-comp')
        </div>
    </div>
</x-livewire-layout>