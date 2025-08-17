<x-livewire-layout title="Session Component Test">
    <div class="container mx-auto py-8 px-4">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-calendar-alt text-green-500 mr-3"></i>
                    Session Component Test
                </h1>
                <p class="text-gray-600">Testing academic session management with widget and full modes</p>
                <div class="mt-3 inline-flex items-center px-3 py-1 bg-green-100 border border-green-400 rounded-lg">
                    <i class="fas fa-cog text-green-600 mr-2"></i>
                    <span class="text-green-800 text-sm font-medium">System Component</span>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Widget Mode -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h2 class="text-lg font-semibold mb-3 text-gray-800">
                            <i class="fas fa-th-large text-blue-500 mr-2"></i>
                            Widget Mode (Dashboard)
                        </h2>
                        @livewire('session-comp', ['widget' => true])
                    </div>

                    <!-- Full Mode -->
                    <div class="lg:col-span-2 bg-gray-50 rounded-lg p-4">
                        <h2 class="text-lg font-semibold mb-3 text-gray-800">
                            <i class="fas fa-expand text-purple-500 mr-2"></i>
                            Full Mode (Settings)
                        </h2>
                        @livewire('session-comp')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-livewire-layout>