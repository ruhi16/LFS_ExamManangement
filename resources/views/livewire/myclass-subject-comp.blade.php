<div class="flex-1 p-6 overflow-y-auto max-w-full mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Class Subjects Management</h1>
                <p class="mt-1 text-sm text-gray-600">Manage subjects assigned to each class with ordering and configuration</p>
            </div>
            <div class="flex space-x-2">
                <button wire:click="refreshData" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                    Refresh Data
                </button>
                @if($selectedClassId)
                    <button wire:click="showAddForm" 
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Add Subject
                    </button>
                @endif
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

    <!-- Class Tabs -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8">
            @if($classes && count($classes) > 0)
                @foreach($classes as $class)
                    <button wire:click="selectClass({{ $class->id }})"
                        class="@if($selectedClassId == $class->id) border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        {{ $class->name }}
                    </button>
                @endforeach
            @else
                <div class="text-gray-500 py-4">No classes available</div>
            @endif
        </nav>
    </div>

    <!-- Add/Edit Form -->
    @if($showAddForm)
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ $editingId ? 'Edit Class Subject' : 'Add New Class Subject' }}
                </h3>
                <button wire:click="hideAddForm" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="saveClassSubject">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Subject Selection -->
                    <div>
                        <label for="selectedSubjectId" class="block text-sm font-medium text-gray-700 mb-2">
                            Subject <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="selectedSubjectId" id="selectedSubjectId" 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select a subject</option>
                            @if($editingId)
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }} ({{ $subject->code }})</option>
                                @endforeach
                            @else
                                @foreach($availableSubjects as $subject)
                                    <option value="{{ $subject['id'] }}">{{ $subject['name'] }} ({{ $subject['code'] ?? 'N/A' }})</option>
                                @endforeach
                            @endif
                        </select>
                        @error('selectedSubjectId') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Class Subject Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Class Subject Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" wire:model="name" id="name" 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="e.g., Mathematics - Grade 10">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea wire:model="description" id="description" rows="3"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Brief description of the subject for this class"></textarea>
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Order Index -->
                    <div>
                        <label for="orderIndex" class="block text-sm font-medium text-gray-700 mb-2">
                            Order Index <span class="text-red-500">*</span>
                        </label>
                        <input type="number" wire:model="orderIndex" id="orderIndex" min="1"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @error('orderIndex') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="status" id="status" 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="pending">Pending</option>
                        </select>
                        @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Is Optional -->
                    <div class="flex items-center">
                        <input type="checkbox" wire:model="isOptional" id="isOptional" 
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="isOptional" class="ml-2 block text-sm text-gray-700">
                            Optional Subject
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
                    <button type="button" wire:click="hideAddForm" 
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
    @endif

    <!-- Class Subjects Table -->
    @if($selectedClassId)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">
                    Subjects for
                    <span class="text-indigo-600 font-semibold">
                        {{ $classes->firstWhere('id', $selectedClassId)->name ?? 'Selected Class' }}
                    </span>
                </h3>
                <p class="text-sm text-gray-600 mt-1">
                    Total Subjects: {{ count($classSubjects) }} | 
                    Available to Add: {{ count($availableSubjects) }}
                </p>
            </div>

            @if(count($classSubjects) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Order
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Subject
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Class Subject Name
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Created By
                                </th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($classSubjects as $classSubject)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-900">
                                        <div class="flex items-center space-x-1">
                                            <span class="font-medium">{{ $classSubject['order_index'] }}</span>
                                            <div class="flex flex-col space-y-1">
                                                @if($classSubject['order_index'] > 1)
                                                    <button wire:click="moveUp({{ $classSubject['id'] }})" 
                                                        class="text-blue-600 hover:text-blue-800">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </button>
                                                @endif
                                                @if($classSubject['order_index'] < count($classSubjects))
                                                    <button wire:click="moveDown({{ $classSubject['id'] }})" 
                                                        class="text-blue-600 hover:text-blue-800">
                                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                        </svg>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-900">
                                        <div class="font-medium">{{ $classSubject['subject_name'] }}</div>
                                        @if($classSubject['subject_code'])
                                            <div class="text-xs text-gray-500">{{ $classSubject['subject_code'] }}</div>
                                        @endif
                                        @if($classSubject['is_optional'])
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Optional
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-900">
                                        <div class="font-medium">{{ $classSubject['name'] }}</div>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500">
                                        {{ $classSubject['description'] ?: 'No description' }}
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <div class="flex flex-col space-y-1">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                                {{ $classSubject['is_active'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $classSubject['is_active'] ? 'Active' : 'Inactive' }}
                                            </span>
                                            @if($classSubject['is_finalized'])
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                    Finalized
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500">
                                        <div>{{ $classSubject['created_by'] }}</div>
                                        <div class="text-xs">{{ $classSubject['created_at'] }}</div>
                                        @if($classSubject['approved_by'])
                                            <div class="text-xs text-green-600">Approved by: {{ $classSubject['approved_by'] }}</div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm text-center">
                                        <div class="flex justify-center space-x-2">
                                            <button wire:click="editClassSubject({{ $classSubject['id'] }})" 
                                                class="text-indigo-600 hover:text-indigo-900">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </button>
                                            
                                            <button wire:click="toggleStatus({{ $classSubject['id'] }})" 
                                                class="{{ $classSubject['is_active'] ? 'text-red-600 hover:text-red-900' : 'text-green-600 hover:text-green-900' }}">
                                                @if($classSubject['is_active'])
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                @else
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                @endif
                                            </button>

                                            @if(!$classSubject['is_finalized'])
                                                <button wire:click="finalizeClassSubject({{ $classSubject['id'] }})" 
                                                    class="text-blue-600 hover:text-blue-900"
                                                    title="Finalize">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </button>
                                            @endif
                                            
                                            <button wire:click="deleteClassSubject({{ $classSubject['id'] }})" 
                                                onclick="return confirm('Are you sure you want to delete this class subject?')"
                                                class="text-red-600 hover:text-red-900">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-6 text-center text-gray-500">
                    <div class="text-lg font-medium mb-2">No subjects assigned</div>
                    <div class="text-sm">No subjects have been assigned to this class yet.</div>
                    @if(count($availableSubjects) > 0)
                        <button wire:click="showAddForm" 
                            class="mt-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                            Add First Subject
                        </button>
                    @else
                        <div class="text-sm text-red-500 mt-2">No subjects available to add.</div>
                    @endif
                </div>
            @endif
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
            <div class="text-lg font-medium mb-2">Select a class to manage subjects</div>
            <div class="text-sm">Choose a class from the tabs above to view and manage its subjects.</div>
        </div>
    @endif
</div>