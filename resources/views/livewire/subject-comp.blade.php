<div class="flex-1 p-6 overflow-y-auto max-w-full mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Subjects Management xx</h1>
                <p class="mt-1 text-sm text-gray-600">Manage school subjects and their types</p>
            </div>
            <div class="flex space-x-2">
                <button wire:click="refreshData"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                    Refresh Data
                </button>
                <button wire:click="showAddModal"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                    Add Subject
                </button>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md">
        {{ session('message') }}
    </div>
    @endif

    @if (session()->has('error'))
    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md">
        {{ session('error') }}
    </div>
    @endif

    <!-- Subjects Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">All Subjects</h3>
            <p class="text-sm text-gray-600 mt-1">
                @php
                $totalSubjects = count($subjects['summative']) + count($subjects['formative']) +
                count($subjects['others']);
                @endphp
                Total Subjects: {{ $totalSubjects }} |
                Summative: {{ count($subjects['summative']) }} |
                Formative: {{ count($subjects['formative']) }} |
                Others: {{ count($subjects['others']) }}
            </p>
        </div>

        @if($totalSubjects > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Subject
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Code
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Description
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Class Assignments
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Finalization
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Summative Subjects Section -->
                    @if(count($subjects['summative']) > 0)
                    <tr class="bg-blue-50">
                        <td colspan="8" class="px-4 py-2 text-sm font-semibold text-blue-800 border-b border-blue-200">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                SUMMATIVE SUBJECTS ({{ count($subjects['summative']) }})
                            </div>
                        </td>
                    </tr>
                    @foreach($subjects['summative'] as $subject)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm text-gray-900">
                            <div class="font-medium">{{ $subject['name'] }}xx</div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            {{ $subject['code'] ?: 'No code' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $subject['subject_type_name'] }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            {{ $subject['description'] ?: 'No description' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                            {{ $subject['is_active'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $subject['is_active'] ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            <span class="font-medium">{{ $subject['myclass_subjects_count'] }}</span> classes
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @if($subject['is_finalized'])
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                🔒 FINALIZED
                            </span>
                            @else
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                ✏️ EDITABLE
                            </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-center">
                            <div class="flex justify-center space-x-2">
                                @if($subject['is_finalized'])
                                <button wire:click="unfinalizeData({{ $subject['id'] }})"
                                    onclick="return confirm('Are you sure you want to unfinalize this subject? This will allow changes again.')"
                                    class="bg-orange-500 hover:bg-orange-700 text-white px-2 py-1 rounded text-xs">
                                    🔓 Unfinalize
                                </button>
                                @else
                                <button wire:click="confirmFinalize({{ $subject['id'] }})"
                                    class="bg-green-500 hover:bg-green-700 text-white px-2 py-1 rounded text-xs mr-1">
                                    🔒 Finalize
                                </button>
                                <button wire:click="editSubject({{ $subject['id'] }})"
                                    class="text-indigo-600 hover:text-indigo-900">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </button>

                                <button wire:click="toggleStatus({{ $subject['id'] }})"
                                    class="{{ $subject['is_active'] ? 'text-red-600 hover:text-red-900' : 'text-green-600 hover:text-green-900' }}">
                                    @if($subject['is_active'])
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                    @else
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    @endif
                                </button>

                                <button wire:click="deleteSubject({{ $subject['id'] }})"
                                    onclick="return confirm('Are you sure you want to delete this subject?')"
                                    class="text-red-600 hover:text-red-900">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                    <!-- Formative Subjects Section -->
                    @if(count($subjects['formative']) > 0)
                    <tr class="bg-green-50">
                        <td colspan="8"
                            class="px-4 py-2 text-sm font-semibold text-green-800 border-b border-green-200">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                FORMATIVE SUBJECTS ({{ count($subjects['formative']) }})
                            </div>
                        </td>
                    </tr>
                    @foreach($subjects['formative'] as $subject)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm text-gray-900">
                            <div class="font-medium">{{ $subject['name'] }}</div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            {{ $subject['code'] ?: 'No code' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                {{ $subject['subject_type_name'] }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            {{ $subject['description'] ?: 'No description' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                            {{ $subject['is_active'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $subject['is_active'] ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            <span class="font-medium">{{ $subject['myclass_subjects_count'] }}</span> classes
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @if($subject['is_finalized'])
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                🔒 FINALIZED
                            </span>
                            @else
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                ✏️ EDITABLE
                            </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-center">
                            <div class="flex justify-center space-x-2">
                                @if($subject['is_finalized'])
                                <button wire:click="unfinalizeData({{ $subject['id'] }})"
                                    onclick="return confirm('Are you sure you want to unfinalize this subject? This will allow changes again.')"
                                    class="bg-orange-500 hover:bg-orange-700 text-white px-2 py-1 rounded text-xs">
                                    🔓 Unfinalize
                                </button>
                                @else
                                <button wire:click="confirmFinalize({{ $subject['id'] }})"
                                    class="bg-green-500 hover:bg-green-700 text-white px-2 py-1 rounded text-xs mr-1">
                                    🔒 Finalize
                                </button>
                                <button wire:click="editSubject({{ $subject['id'] }})"
                                    class="text-indigo-600 hover:text-indigo-900">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </button>

                                <button wire:click="toggleStatus({{ $subject['id'] }})"
                                    class="{{ $subject['is_active'] ? 'text-red-600 hover:text-red-900' : 'text-green-600 hover:text-green-900' }}">
                                    @if($subject['is_active'])
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                    @else
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    @endif
                                </button>

                                <button wire:click="deleteSubject({{ $subject['id'] }})"
                                    onclick="return confirm('Are you sure you want to delete this subject?')"
                                    class="text-red-600 hover:text-red-900">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                    <!-- Other Subjects Section -->
                    @if(count($subjects['others']) > 0)
                    <tr class="bg-gray-50">
                        <td colspan="8" class="px-4 py-2 text-sm font-semibold text-gray-800 border-b border-gray-200">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                OTHER SUBJECTS ({{ count($subjects['others']) }})
                            </div>
                        </td>
                    </tr>
                    @foreach($subjects['others'] as $subject)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm text-gray-900">
                            <div class="font-medium">{{ $subject['name'] }}</div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            {{ $subject['code'] ?: 'No code' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $subject['subject_type_name'] }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            {{ $subject['description'] ?: 'No description' }}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                            {{ $subject['is_active'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $subject['is_active'] ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            <span class="font-medium">{{ $subject['myclass_subjects_count'] }}</span> classes
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @if($subject['is_finalized'])
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                🔒 FINALIZED
                            </span>
                            @else
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                ✏️ EDITABLE
                            </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-center">
                            <div class="flex justify-center space-x-2">
                                @if($subject['is_finalized'])
                                <button wire:click="unfinalizeData({{ $subject['id'] }})"
                                    onclick="return confirm('Are you sure you want to unfinalize this subject? This will allow changes again.')"
                                    class="bg-orange-500 hover:bg-orange-700 text-white px-2 py-1 rounded text-xs">
                                    🔓 Unfinalize
                                </button>
                                @else
                                <button wire:click="confirmFinalize({{ $subject['id'] }})"
                                    class="bg-green-500 hover:bg-green-700 text-white px-2 py-1 rounded text-xs mr-1">
                                    🔒 Finalize
                                </button>
                                <button wire:click="editSubject({{ $subject['id'] }})"
                                    class="text-indigo-600 hover:text-indigo-900">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </button>

                                <button wire:click="toggleStatus({{ $subject['id'] }})"
                                    class="{{ $subject['is_active'] ? 'text-red-600 hover:text-red-900' : 'text-green-600 hover:text-green-900' }}">
                                    @if($subject['is_active'])
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                    @else
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    @endif
                                </button>

                                <button wire:click="deleteSubject({{ $subject['id'] }})"
                                    onclick="return confirm('Are you sure you want to delete this subject?')"
                                    class="text-red-600 hover:text-red-900">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        @else
        <div class="p-6 text-center text-gray-500">
            <div class="text-lg font-medium mb-2">No subjects found</div>
            <div class="text-sm">No subjects have been created yet.</div>
            <button wire:click="showAddModal"
                class="mt-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                Add First Subject
            </button>
        </div>
        @endif
    </div>

    <!-- Modal -->
    @if($showModal)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ $editingId ? 'Edit Subject' : 'Add New Subject' }}
                    </h3>
                    <button wire:click="hideModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="saveSubject">
                    <div class="space-y-4">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Subject Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" wire:model="name" id="name"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="e.g., Mathematics, English, Physics">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Code -->
                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                                Subject Code
                            </label>
                            <input type="text" wire:model="code" id="code"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="e.g., MATH, ENG, PHY">
                            @error('code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Subject Type -->
                        <div>
                            <label for="subjectTypeId" class="block text-sm font-medium text-gray-700 mb-2">
                                Subject Type
                            </label>
                            <select wire:model="subjectTypeId" id="subjectTypeId"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Select a subject type</option>
                                @foreach($subjectTypes as $subjectType)
                                <option value="{{ $subjectType['id'] }}">{{ $subjectType['name'] }}</option>
                                @endforeach
                            </select>
                            @error('subjectTypeId') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea wire:model="description" id="description" rows="3"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Brief description of the subject"></textarea>
                            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Is Active -->
                        <div class="flex items-center">
                            <input type="checkbox" wire:model="isActive" id="isActive"
                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="isActive" class="ml-2 block text-sm text-gray-700">
                                Active Subject
                            </label>
                        </div>

                        <!-- Remarks -->
                        <div>
                            <label for="remarks" class="block text-sm font-medium text-gray-700 mb-2">
                                Remarks
                            </label>
                            <input type="text" wire:model="remarks" id="remarks"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Additional notes">
                            @error('remarks') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" wire:click="hideModal"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-md text-sm font-medium">
                            Cancel
                        </button>
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                            {{ $editingId ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Finalization Confirmation Modal -->
    @if($showFinalizeModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="cancelFinalize"></div>

            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-1a2 2 0 00-2-2H6a2 2 0 00-2 2v1a2 2 0 002 2zM12 7a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Finalize Subject</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to finalize this subject? Once finalized, it cannot be edited
                                    or deleted.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="finalizeData"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                        🔒 Finalize
                    </button>
                    <button wire:click="cancelFinalize"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>