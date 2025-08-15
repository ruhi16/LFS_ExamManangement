<x-livewire-layout title="User Role Management Test">
    <div class="container mx-auto py-8 px-4">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-user-shield text-orange-500 mr-3"></i>
                    User Role Management Test
                </h1>
                <p class="text-gray-600">Testing user role management with CRUD operations and permission controls</p>
                <div class="mt-3 inline-flex items-center px-3 py-1 bg-orange-100 border border-orange-400 rounded-lg">
                    <i class="fas fa-shield-alt text-orange-600 mr-2"></i>
                    <span class="text-orange-800 text-sm font-medium">Permission Testing</span>
                </div>
            </div>

            @livewire('user-role-comp')
        </div>
    </div>
</x-livewire-layout>