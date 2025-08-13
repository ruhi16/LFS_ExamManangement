<div class="p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Subject-Teacher Management</h1>
            <p class="text-gray-600 mt-1">Assign teachers to subjects and manage subject-wise teaching assignments</p>
        </div>
        <div class="flex space-x-3">
            <button wire:click="refreshData"
                class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                <i class="fas fa-sync-alt mr-2"></i>Refresh
            </button>
            <button wire:click="testModal"
                class="px-3 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors">
                <i class="fas fa-bug mr-1"></i>Test
            </button>
            <button wire:click="forceShowModal"
                class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                Show
            </button>
            <button wire:click="hideModal"
                class="px-3 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                Hide
            </button>
            <button wire:click="openModal"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-plus mr-2"></i>Assign Teacher
            </button>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md">
            <div class="flex">
                <i class="fas fa-check-circle mr-2 mt-0.5"></i>
                {{ session('message') }}
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md">
            <div class="flex">
                <i class="fas fa-exclamation-circle mr-2 mt-0.5"></i>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Filters Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <input type="text" wire:model.debounce.300ms="searchTerm"
                    placeholder="Search subjects or teachers..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Filter by Subject</label>
                <select wire:model="selectedSubject"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Subjects</option>
                    @if($subjects && $subjects->count() > 0)
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="flex items-end">
                <button wire:click="clearFilters"
                    class="w-full px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                    <i class="fas fa-refresh mr-2"></i>Clear Filters
                </button>
            </div>
        </div>
    </div>

    <!-- Subject-Teacher Assignments -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Subject-wise Teacher Assignments</h3>
        </div>

        @if($subjectTeachers && $subjectTeachers->count() > 0)
            <div class="divide-y divide-gray-200">
                @foreach($subjectTeachers as $subject)
                    <div class="p-6">
                        <!-- Subject Header -->
                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-book text-blue-600"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-semibold text-gray-900">{{ $subject->name }}</h4>
                                    <p class="text-sm text-gray-600">
                                        {{ $subject->teachers->count() }} teacher(s) assigned
                                        @if($subject->subject_type)
                                            • Type: {{ $subject->subject_type->name }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <button wire:click="openModal({{ $subject->id }})"
                                class="px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition-colors">
                                <i class="fas fa-plus mr-1"></i>Add Teacher
                            </button>
                        </div>

                        <!-- Assigned Teachers -->
                        @if($subject->teachers->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($subject->teachers as $teacher)
                                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                        <div class="flex items-start justify-between">
                                            <div class="flex items-center flex-1">
                                                <div class="flex-shrink-0">
                                                    @if($teacher->img_ref)
                                                        <img src="{{ asset('storage/' . $teacher->img_ref) }}" 
                                                            alt="{{ $teacher->name }}"
                                                            class="w-10 h-10 rounded-full object-cover border-2 border-gray-200">
                                                    @else
                                                        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                                            <i class="fas fa-user text-gray-600"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ml-3 flex-1">
                                                    <div class="flex items-center">
                                                        <h5 class="text-sm font-medium text-gray-900">{{ $teacher->name }}</h5>
                                                        @if($teacher->pivot->is_primary)
                                                            <span class="ml-2 inline-flex px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                                Primary
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <p class="text-xs text-gray-600">{{ $teacher->desig }}</p>
                                                    @if($teacher->pivot->status)
                                                        <span class="inline-flex px-2 py-0.5 text-xs font-semibold rounded-full mt-1
                                                            {{ $teacher->pivot->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                            {{ ucfirst($teacher->pivot->status) }}
                                                        </span>
                                                    @endif
                                                    @if($teacher->pivot->notes)
                                                        <p class="text-xs text-gray-500 mt-1">{{ Str::limit($teacher->pivot->notes, 50) }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <!-- Action Buttons -->
                                            <div class="flex space-x-1 ml-2">
                                                <button wire:click="openModal({{ $subject->id }}, {{ $teacher->id }})"
                                                    class="inline-flex items-center p-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition-colors" 
                                                    title="Edit Assignment">
                                                    <i class="fas fa-edit text-xs"></i>
                                                </button>
                                                
                                                @if($teacher->pivot->status === 'active')
                                                    <button wire:click="toggleStatus({{ $subject->id }}, {{ $teacher->id }})"
                                                        onclick="return confirm('Deactivate this assignment?')"
                                                        class="inline-flex items-center p-1 bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 transition-colors" 
                                                        title="Deactivate Assignment">
                                                        <i class="fas fa-pause text-xs"></i>
                                                    </button>
                                                @else
                                                    <button wire:click="toggleStatus({{ $subject->id }}, {{ $teacher->id }})"
                                                        onclick="return confirm('Activate this assignment?')"
                                                        class="inline-flex items-center p-1 bg-green-100 text-green-700 rounded hover:bg-green-200 transition-colors" 
                                                        title="Activate Assignment">
                                                        <i class="fas fa-play text-xs"></i>
                                                    </button>
                                                @endif
                                                
                                                <button wire:click="removeAssignment({{ $subject->id }}, {{ $teacher->id }})"
                                                    onclick="return confirm('Remove this teacher from the subject?')"
                                                    class="inline-flex items-center p-1 bg-red-100 text-red-700 rounded hover:bg-red-200 transition-colors" 
                                                    title="Remove Assignment">
                                                    <i class="fas fa-times text-xs"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 bg-gray-50 rounded-lg">
                                <div class="text-gray-400 mb-2">
                                    <i class="fas fa-user-plus text-3xl"></i>
                                </div>
                                <p class="text-gray-600">No teachers assigned to this subject</p>
                                <button wire:click="openModal({{ $subject->id }})"
                                    class="mt-2 px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-plus mr-1"></i>Assign Teacher
                                </button>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $subjectTeachers->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-chalkboard-teacher text-6xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Subject-Teacher Assignments Found</h3>
                <p class="text-gray-600 mb-4">Start by assigning teachers to subjects.</p>
                <button wire:click="openModal"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>Create Assignment
                </button>
            </div>
        @endif
    </div>
</div>

<!-- Debug Info -->
<div class="mb-4 p-4 bg-yellow-100 border-2 border-yellow-400 rounded text-sm">
    <strong>🐛 DEBUG INFO:</strong><br>
    showModal = <span class="font-bold {{ $showModal ? 'text-green-600' : 'text-red-600' }}">{{ $showModal ? 'TRUE' : 'FALSE' }}</span><br>
    editMode = {{ $editMode ? 'true' : 'false' }}<br>
    subjects = {{ $subjects ? $subjects->count() : 0 }}<br>
    teachers = {{ $teachers ? $teachers->count() : 0 }}<br>
    testCounter = <span class="font-bold text-blue-600">{{ $testCounter }}</span>
</div>

<!-- Test Buttons -->
<div class="mb-4 p-4 bg-blue-100 border-2 border-blue-400 rounded">
    <h3 class="font-bold mb-2">🧪 LIVEWIRE TESTS:</h3>
    <div class="flex space-x-2">
        <button wire:click="incrementCounter"
            class="px-3 py-2 bg-green-500 text-white rounded hover:bg-green-600">
            Counter: {{ $testCounter }}
        </button>
        <button wire:click="forceShowModal"
            class="px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600">
            Force Modal
        </button>
        <button wire:click="hideModal"
            class="px-3 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            Hide Modal
        </button>
    </div>
</div>

<!-- Modal -->
@if($showModal)
    <div class="fixed inset-0 bg-red-500 bg-opacity-75 flex items-center justify-center p-4" style="z-index: 9999;">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto border-4 border-blue-500">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-6 border-b border-gray-200 bg-blue-100">
                <h3 class="text-xl font-semibold text-gray-900">
                    🎯 MODAL IS WORKING! {{ $editMode ? 'Edit Subject-Teacher Assignment' : 'Assign Teacher to Subject' }}
                </h3>
                <button wire:click="closeModal" class="text-red-600 hover:text-red-800 text-2xl font-bold">
                    ✕
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <div class="space-y-6">
                    <!-- Subject Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Subject *</label>
                        <select wire:model="subject_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            {{ $editMode ? 'disabled' : '' }}>
                            <option value="">Select Subject</option>
                            @if($subjects && $subjects->count() > 0)
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('subject_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Teacher Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Teacher *</label>
                        <select wire:model="teacher_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            {{ $editMode ? 'disabled' : '' }}>
                            <option value="">Select Teacher</option>
                            @if($teachers && $teachers->count() > 0)
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }} - {{ $teacher->desig }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('teacher_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Primary Teacher -->
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" wire:model="is_primary"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Primary Teacher for this Subject</span>
                        </label>
                        <p class="text-xs text-gray-500 mt-1">Mark this teacher as the primary/main teacher for this subject</p>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select wire:model="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Notes -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                        <textarea wire:model="notes" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Additional notes about this assignment..."></textarea>
                        @error('notes') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end items-center p-6 border-t border-gray-200 space-x-3">
                <button wire:click="closeModal"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                    Cancel
                </button>
                <button wire:click="save"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-save mr-2"></i>{{ $editMode ? 'Update' : 'Assign' }}
                </button>
            </div>
        </div>
    </div>
@endif