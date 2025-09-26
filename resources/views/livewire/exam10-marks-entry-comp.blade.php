<div class="flex-1 p-6 overflow-y-auto max-w-6xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Exam Marks Entry Management</h1>
                <p class="mt-1 text-sm text-gray-600">Manage student exam marks entries and their settings</p>
            </div>
            <button wire:click="openModal"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                Add New Marks Entry
            </button>
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

    <!-- Search and Filters -->
    <div class="mb-6 bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <input wire:model.debounce.300ms="search" type="text" id="search"
                    placeholder="Search by student or exam name..."
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label for="selectedClassId" class="block text-sm font-medium text-gray-700 mb-1">Filter by
                    Class</label>
                <select wire:model="selectedClassId" id="selectedClassId"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">All Classes</option>
                    @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="selectedSectionId" class="block text-sm font-medium text-gray-700 mb-1">Filter by
                    Section</label>
                <select wire:model="selectedSectionId" id="selectedSectionId"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">All Sections</option>
                    @foreach($classSections as $section)
                    <option value="{{ $section->id }}">{{ $section->myclass->name ?? 'N/A' }} - {{
                        $section->section->name ?? 'N/A' }}</option>
                    @endforeach
                </select>
            </div>

            @if($search || $selectedClassId || $selectedSectionId)
            <div class="flex items-end">
                <button wire:click="$set('search', ''); $set('selectedClassId', ''); $set('selectedSectionId', '')"
                    class="text-gray-400 hover:text-gray-600 text-sm">
                    Clear Filters
                </button>
            </div>
            @endif
        </div>
    </div>

    <!-- Marks Entries Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Student
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Exam
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Class/Section
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Subject
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Marks
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Grade
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Finalization
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Created
                        </th>
                        <th scope="col"
                            class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($marksEntries as $marksEntry)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $marksEntry->studentcr->studentdb->name ??
                                'N/A' }}</div>
                            <div class="text-xs text-gray-500">ID: {{ $marksEntry->studentcr->studentdb->id ?? 'N/A' }}
                            </div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $marksEntry->examDetail->examName->name ?? 'N/A' }}
                            </div>
                            <div class="text-xs text-gray-500">ID: {{ $marksEntry->exam_detail_id }}</div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $marksEntry->myclassSection->myclass->name ?? 'N/A' }}
                            </div>
                            <div class="text-xs text-gray-500">{{ $marksEntry->myclassSection->section->name ?? 'N/A' }}
                            </div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $marksEntry->examClassSubject->subject->name ?? 'N/A'
                                }}</div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                @if($marksEntry->is_absent)
                                <span class="text-red-600">ABSENT</span>
                                @else
                                {{ $marksEntry->getDisplayMarks() }}
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $marksEntry->grade->name ?? 'N/A' }}</div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="flex items-center space-x-2">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium 
                                    @if($marksEntry->is_active) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                                    {{ $marksEntry->is_active ? 'Active' : 'Inactive' }}
                                </span>
                                @if($marksEntry->status)
                                <span class="text-xs text-gray-500">{{ $marksEntry->status }}</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if($marksEntry->is_finalized)
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                🔒 FINALIZED
                            </span>
                            @else
                            <span
                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                ✏️ EDITABLE
                            </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                            {{ $marksEntry->created_at->format('Y-m-d') }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                @if(!$isDataFinalized)
                                <button wire:click="toggleStatus({{ $marksEntry->id }})"
                                    class="text-indigo-600 hover:text-indigo-900 text-xs">
                                    {{ $marksEntry->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                                <button wire:click="edit({{ $marksEntry->id }})"
                                    class="text-indigo-600 hover:text-indigo-900 text-xs">
                                    Edit
                                </button>
                                <button wire:click="confirmDelete({{ $marksEntry->id }})"
                                    class="text-red-600 hover:text-red-900 text-xs">
                                    Delete
                                </button>
                                @endif

                                @if($marksEntry->is_finalized)
                                <button
                                    wire:click="unfinalizeData({{ $marksEntry->id }}, '{{ addslashes(App\Models\Exam10MarksEntry::class) }}', 'marks entry')"
                                    onclick="return confirm('Are you sure you want to unfinalize this marks entry? This will allow changes again.')"
                                    class="bg-orange-500 hover:bg-orange-700 text-white px-2 py-1 rounded text-xs">
                                    🔓 Unfinalize
                                </button>
                                @else
                                <button wire:click="confirmFinalize({{ $marksEntry->id }})"
                                    class="bg-green-500 hover:bg-green-700 text-white px-2 py-1 rounded text-xs">
                                    🔒 Finalize
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="px-4 py-8 text-center text-gray-500">
                            <div class="text-lg font-medium mb-2">No marks entries found</div>
                            <div class="text-sm">
                                @if($search || $selectedClassId || $selectedSectionId)
                                No marks entries match your search criteria.
                                @else
                                Get started by creating your first marks entry.
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($marksEntries->hasPages())
        <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
            {{ $marksEntries->links() }}
        </div>
        @endif
    </div>

    <!-- Create/Edit Modal -->
    @if($showModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeModal"></div>

            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form wire:submit.prevent="save">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="mb-4">
                            <h3 class="text-lg font-medium text-gray-900" id="modal-title">
                                {{ $editingId ? 'Edit Marks Entry' : 'Add New Marks Entry' }}
                            </h3>
                        </div>

                        <div class="space-y-4">
                            <!-- Exam Detail -->
                            <div>
                                <label for="exam_detail_id" class="block text-sm font-medium text-gray-700">Exam Detail
                                    *</label>
                                <select wire:model="exam_detail_id" id="exam_detail_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Select an exam detail</option>
                                    @foreach($examDetails as $examDetail)
                                    <option value="{{ $examDetail->id }}">
                                        {{ $examDetail->examName->name ?? 'N/A' }} -
                                        {{ $examDetail->myclass->name ?? 'N/A' }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('exam_detail_id') <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Exam Class Subject -->
                            <div>
                                <label for="exam_class_subject_id" class="block text-sm font-medium text-gray-700">Exam
                                    Class Subject *</label>
                                <select wire:model="exam_class_subject_id" id="exam_class_subject_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Select an exam class subject</option>
                                    @foreach($examClassSubjects as $examClassSubject)
                                    <option value="{{ $examClassSubject->id }}">
                                        {{ $examClassSubject->subject->name ?? 'N/A' }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('exam_class_subject_id') <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Class Section -->
                            <div>
                                <label for="myclass_section_id" class="block text-sm font-medium text-gray-700">Class
                                    Section *</label>
                                <select wire:model="myclass_section_id" id="myclass_section_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Select a class section</option>
                                    @foreach($classSections as $classSection)
                                    <option value="{{ $classSection->id }}">
                                        {{ $classSection->myclass->name ?? 'N/A' }} -
                                        {{ $classSection->section->name ?? 'N/A' }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('myclass_section_id') <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Student -->
                            <div>
                                <label for="studentcr_id" class="block text-sm font-medium text-gray-700">Student
                                    *</label>
                                <select wire:model="studentcr_id" id="studentcr_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Select a student</option>
                                    @foreach($students as $student)
                                    <option value="{{ $student->id }}">
                                        {{ $student->studentdb->name ?? 'N/A' }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('studentcr_id') <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Marks -->
                            <div>
                                <label for="exam_marks" class="block text-sm font-medium text-gray-700">Marks</label>
                                <input wire:model="exam_marks" type="number" id="exam_marks" min="0" max="100"
                                    step="0.01"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                @error('exam_marks') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Grade -->
                            <div>
                                <label for="grade_id" class="block text-sm font-medium text-gray-700">Grade</label>
                                <select wire:model="grade_id" id="grade_id"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Select a grade</option>
                                    @foreach($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                                @error('grade_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <input wire:model="status" type="text" id="status"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Remarks -->
                            <div>
                                <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks</label>
                                <textarea wire:model="remarks" id="remarks" rows="2"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                                @error('remarks') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Checkboxes -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="flex items-center">
                                    <input wire:model="is_absent" type="checkbox" id="is_absent"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <label for="is_absent" class="ml-2 block text-sm text-gray-900">Absent</label>
                                </div>
                                <div class="flex items-center">
                                    <input wire:model="is_active" type="checkbox" id="is_active"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <label for="is_active" class="ml-2 block text-sm text-gray-900">Active</label>
                                </div>
                                <div class="flex items-center">
                                    <input wire:model="is_finalized" type="checkbox" id="is_finalized"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <label for="is_finalized" class="ml-2 block text-sm text-gray-900">Finalized</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                            {{ $editingId ? 'Update' : 'Create' }}
                        </button>
                        <button type="button" wire:click="closeModal"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if($confirmingDeletion)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Delete Marks Entry</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to delete this marks entry? This action cannot be undone.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="delete"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Delete
                    </button>
                    <button wire:click="cancelDelete"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
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
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Finalize Marks Entry</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to finalize this marks entry? Once finalized, it cannot be
                                    edited or deleted.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button
                        wire:click="finalizeData('{{ addslashes(App\Models\Exam10MarksEntry::class) }}', 'marks entry')"
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
    @endif
</div>