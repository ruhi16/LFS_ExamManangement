<div class="flex-1 p-6 overflow-y-auto max-w-full mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Answer Script Distribution</h1>
        <p class="mt-1 text-sm text-gray-600">Assign teachers to subjects for each exam.</p>
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

    <!-- Class Selection -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            @forelse($classes as $class)
                <button wire:click="selectClass({{ $class->id }})"
                    class="{{ $selectedClassId == $class->id ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    {{ $class->name }}
                </button>
            @empty
                <p class="text-gray-500 py-4">No classes available.</p>
            @endforelse
        </nav>
    </div>

    @if($selectedClassId)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">
                    Teacher Assignments for {{ $classes->find($selectedClassId)->name }}
                </h3>
            </div>

            @if($subjects->isNotEmpty() && $examNames->isNotEmpty())
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider sticky left-0 bg-gray-50 z-10">
                                    Subject
                                </th>
                                @foreach($examNames as $examName)
                                    <th scope="col"
                                        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-l border-gray-300">
                                        {{ $examName->name }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        @foreach($subjects->groupBy('display_type') as $typeName => $subjectsInGroup)
                            <tbody class="bg-white divide-y divide-gray-200" wire:key="group-{{ $typeName }}">
                                <tr class="bg-gray-100">
                                    <td colspan="{{ $examNames->count() + 1 }}" class="px-6 py-2 text-sm font-bold text-gray-600">
                                        {{ $typeName }}
                                    </td>
                                </tr>
                                @foreach($subjectsInGroup as $classSubject)
                                    <tr class="hover:bg-gray-50" wire:key="subject-{{ $classSubject->id }}">
                                        <td
                                            class="px-6 py-4 text-sm font-medium text-gray-900 sticky left-0 bg-white hover:bg-gray-50 z-10 border-r border-gray-200">
                                            {{ $classSubject->subject->name ?? 'Unknown Subject' }}
                                        </td>
                                        @foreach($examNames as $examName)
                                            <td class="px-4 py-4 text-center border-l border-gray-300"
                                                wire:key="cell-{{ $classSubject->id }}-{{ $examName->id }}">
                                                @php
                                                    $key = $classSubject->subject_id . '_' . $examName->id;
                                                    $assignedTeacherId = $distributions[$key] ?? null;
                                                    $assignedTeacher = $assignedTeacherId ? $teachers->find($assignedTeacherId) : null;
                                                @endphp

                                                @if($assignedTeacher)
                                                    <div class="text-sm font-bold text-green-600 mb-1" title="Assigned: {{ $assignedTeacher->name }}">
                                                        {{ $assignedTeacher->name }}
                                                    </div>
                                                @else
                                                    <div class="text-sm text-red-600 mb-1">No Teacher</div>
                                                @endif

                                                <select wire:model="distributions.{{ $key }}"
                                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                                    <option value="">-- Select Teacher --</option>
                                                    @foreach($teachers as $teacher)
                                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div wire:loading wire:target="distributions.{{ $key }}" class="text-xs text-blue-500 mt-1">
                                                    Saving...
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        @endforeach
                    </table>
                </div>
            @else
                <div class="p-6 text-center text-gray-500">
                    <p>No subjects or exams configured for this class.</p>
                </div>
            @endif
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
            <p class="text-lg font-medium">Please select a class to view and assign teachers.</p>
        </div>
    @endif
</div>