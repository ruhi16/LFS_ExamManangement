<x-livewire-layout title="Logs Viewer Component Test">
    <div class="container mx-auto py-8 px-4">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-file-code text-gray-500 mr-3"></i>
                    Logs Viewer Component Test
                </h1>
                <p class="text-gray-600">Testing system logs monitoring and analysis for debugging and system health</p>
                <div class="mt-3 inline-flex items-center px-3 py-1 bg-gray-100 border border-gray-400 rounded-lg">
                    <i class="fas fa-cog text-gray-600 mr-2"></i>
                    <span class="text-gray-800 text-sm font-medium">System Component</span>
                </div>
            </div>

            @livewire('logs-viewer-comp')
        </div>
    </div>
</x-livewire-layout>