<div class="flex-1 p-6 overflow-y-auto max-w-full mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Answer Script Distribution XX</h1>
                <p class="mt-1 text-sm text-gray-600">Assign teachers to evaluate answer scripts for different exam
                    types and parts</p>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md">
            {{ session('message') }}
            @php $msg = session('message') @endphp
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md">
            {{ session('error') }}
        </div>
    @endif

    @if (session()->has('warning'))
        <div class="mb-4 bg-yellow-50 border border-yellow-200 text-yellow-700 px-4 py-3 rounded-md">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm">X: {{ session('warning') }}</p>
                </div>
            </div>
        </div>
    @endif

    <!-- Debug Panel -->
    @if($debugMode)
        <div class="mb-4 p-4 bg-yellow-50 border border-yellow-200 rounded-md">
            <h4 class="text-sm font-medium text-yellow-800 mb-2">Debug Panel</h4>
            <div class="flex space-x-2 mb-2">
                {{ $msg ?? 'XX'}}
                <button wire:click="checkDatabaseConnection" class="bg-blue-500 text-white px-3 py-1 rounded text-xs">
                    Test DB Connection
                </button>
                <button wire:click="testDataLoad" class="bg-green-500 text-white px-3 py-1 rounded text-xs">
                    Test Data Load
                </button>
                <button wire:click="refreshData" class="bg-purple-500 text-white px-3 py-1 rounded text-xs">
                    Refresh Data
                </button>
            </div>
            <div class="text-xs text-yellow-700">
                Selected Class: {{ $selectedClassId ?? 'None' }} |
                Selected Exam for Class: {{ $classes->where('id', $selectedClassId)->first()->name ?? 'Unknown Class' }}
                Sections: {{ count($classSections) }} |
                Subjects: {{ count($classSubjects) }} |
                Distributions: {{ count($distributions) }}
            </div>
        </div>
    @endif

    <!-- Debug Toggle Button -->
    <div class="mb-4">
        <button wire:click="toggleDebugMode" class="bg-gray-500 text-white px-3 py-1 rounded text-xs">
            {{ $debugMode ? 'Hide Debug' : 'Show Debug' }}
        </button>
    </div>

    <!-- Class Selection -->
    <div class="border-b border-gray-200 mb-6">
        @if($selectedClassId)
            <div class="mb-3 p-2 bg-blue-50 border-l-4 border-blue-400">
                <span class="text-blue-800 font-medium">
                    Selected Class: {{ $classes->where('id', $selectedClassId)->first()->name ?? 'Unknown Class' }}
                </span>
            </div>
        @endif
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

    <!-- Exam Name Selection -->
    @if($selectedClassId && count($examNames) > 0)
        <div class="mb-6">
            <h3 class="text-lg font-medium text-gray-900 mb-3">Select Exam for Class: <span class="text-blue-500">{{ $classes->where('id', $selectedClassId)->first()->name ?? 'Unknown Class' }}</span></h3>
            <div class="flex flex-wrap gap-2">
                @foreach($examNames as $examName)
                    <button wire:click="selectExamName({{ $examName->id }})"
                        class="@if($selectedExamNameId == $examName->id) bg-indigo-600 text-white @else bg-gray-200 text-gray-700 hover:bg-gray-300 @endif px-4 py-2 rounded-md text-sm font-medium">
                        {{ $examName->name }}
                    </button>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Distribution Tables by Exam Type -->
    @if($selectedClassId && $selectedExamNameId && count($classSubjects) > 0 && count($classSections) > 0)
        <div class="space-y-8">
            @foreach($examTypes->sortByDesc('id') as $examType)
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="p-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900">
                            {{ $examType->name }} - Answer Script Distribution
                        </h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider sticky left-0 bg-gray-50 z-10">
                                        Subject
                                    </th>
                                    @foreach($classSections->sortBy('id') as $section)
                                        <th scope="col"
                                            class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-l border-gray-300">
                                            <div class="font-semibold text-gray-900">Section {{ $section->section->name ?? 'X'}}</div>
                                            {{-- <div class="text-xs text-gray-400 mt-1">Section</div> --}}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">

                                @foreach($classSubjects as $subject)
                                    <tr class="hover:bg-gray-50">
                                        <td
                                            class="px-6 py-4 text-sm font-medium text-gray-900 sticky left-0 bg-white z-10 border-r border-gray-200">
                                            <div class="font-semibold">{{ $subject->subject->name ?? 'Unknown Subject' }}</div>
                                            {{-- <div class="text-xs text-gray-500">{{ $subject ?? 'XX' }}</div> --}}
                                        </td>
                                        @foreach($classSections as $section)
                                            <td class="px-4 py-4 text-center border-l border-gray-300">
                                                <div class="space-y-2">
                                                    @php
                                                        // Get configured combinations for this subject
                                                        // dd($configuredCombinations);
                                                        $subjectCombinations = $configuredCombinations->get($subject->subject_id, collect());
                                                        // dd($subjectCombinations);
                                                        // Filter combinations for current exam type
                                                        $typePartCombinations = $subjectCombinations->where('exam_type_id', $examType->id);
                                                        // dd($typePartCombinations);
                                                    @endphp
                                                    xx 
                                                    {{ $examDetails }}
                                                    @if($typePartCombinations->isNotEmpty())
                                                        yy
                                                        @foreach($typePartCombinations as $combination)
                                                            @php
                                                                $examPart = $examParts->where('id', $combination->exam_part_id)->first();
                                                                if (!$examPart) continue;
                                                                
                                                                $key = "{$subject->subject_id}_{$examType->id}_{$combination->exam_part_id}_{$section->section_id}";
                                                                $distribution = $distributions[$key] ?? null;
                                                                $teacherName = null;
                                                                if ($distribution) {
                                                                    $teacher = $distribution->teacher ?? $distribution->user ?? null;
                                                                    $teacherName = $teacher ? ($teacher->name ?? 'Unknown Teacher') : 'No Teacher Assigned';
                                                                }
                                                            @endphp

                                                            <div class="relative">
                                                                @if($distribution)
                                                                    <div class="bg-green-50 border border-green-300 rounded p-2">
                                                                        <div class="text-xs font-medium text-green-800">{{ $examPart->name }}</div>
                                                                        <div class="text-xs text-green-900 truncate" title="{{ $teacherName }}">{{ $teacherName }}</div>
                                                                        <div class="text-xs text-gray-600 mt-1">
                                                                            FM: {{ $combination->full_marks }} | PM: {{ $combination->pass_marks }} | Time: {{ $combination->time_in_minutes }}min
                                                                        </div>
                                                                        <div class="flex mt-1 space-x-1">
                                                                            <button wire:click="openModal({{ $subject->subject_id }}, {{ $examType->id }}, {{ $combination->exam_part_id }}, {{ $section->section_id }})"
                                                                                class="text-xs bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Edit</button>
                                                                            <button wire:click="removeAssignment({{ $subject->subject_id }}, {{ $examType->id }}, {{ $combination->exam_part_id }}, {{ $section->section_id }})"
                                                                                onclick="return confirm('Remove teacher?')"
                                                                                class="text-xs bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">×</button>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <button wire:click="openModal({{ $subject->subject_id }}, {{ $examType->id }}, {{ $combination->exam_part_id }}, {{ $section->section_id }})"
                                                                        class="w-full bg-gray-100 border border-gray-300 rounded p-2 hover:bg-gray-200">
                                                                        <div class="text-xs font-medium text-gray-600">{{ $examPart->name }}</div>
                                                                        <div class="text-xs text-gray-400">Not Assigned</div>
                                                                        <div class="text-xs text-gray-500 mt-1">
                                                                            FM: {{ $combination->full_marks }} | PM: {{ $combination->pass_marks }}
                                                                        </div>
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        zz{{-- Fallback: Show all exam parts if no configurations found --}}
                                                        @foreach($examParts as $examPart)
                                                            @php
                                                                $key = "{$subject->subject_id}_{$examType->id}_{$examPart->id}_{$section->section_id}";
                                                                $distribution = $distributions[$key] ?? null;
                                                                $teacherName = null;
                                                                if ($distribution) {
                                                                    $teacher = $distribution->teacher ?? $distribution->user ?? null;
                                                                    $teacherName = $teacher ? ($teacher->name ?? 'Unknown Teacher') : 'No Teacher Assigned';
                                                                }
                                                            @endphp

                                                            <div class="relative">
                                                                @if($distribution)
                                                                    <div class="bg-green-50 border border-green-300 rounded p-2">
                                                                        <div class="text-xs font-medium text-green-800">{{ $examPart->name }}</div>
                                                                        <div class="text-xs text-green-900 truncate" title="{{ $teacherName }}">{{ $teacherName }}</div>
                                                                        <div class="text-xs text-orange-600 mt-1">
                                                                            ⚠️ Not configured in Class Exam Subject
                                                                        </div>
                                                                        <div class="flex mt-1 space-x-1">
                                                                            <button wire:click="openModal({{ $subject->subject_id }}, {{ $examType->id }}, {{ $examPart->id }}, {{ $section->section_id }})"
                                                                                class="text-xs bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Edit</button>
                                                                            <button wire:click="removeAssignment({{ $subject->subject_id }}, {{ $examType->id }}, {{ $examPart->id }}, {{ $section->section_id }})"
                                                                                onclick="return confirm('Remove teacher?')"
                                                                                class="text-xs bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">×</button>
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <button wire:click="openModal({{ $subject->subject_id }}, {{ $examType->id }}, {{ $examPart->id }}, {{ $section->section_id }})"
                                                                        class="w-full bg-orange-50 border border-orange-300 rounded p-2 hover:bg-orange-100">
                                                                        <div class="text-xs font-medium text-orange-600">{{ $examPart->name }}</div>
                                                                        <div class="text-xs text-orange-400">Not Configured</div>
                                                                        <div class="text-xs text-orange-500 mt-1">
                                                                            Configure in Class Exam Subject first
                                                                        </div>
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif($selectedClassId && $selectedExamNameId)
        <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
            <div class="text-lg font-medium mb-2">No subjects or sections found</div>
            <div class="text-sm">Please ensure this class has subjects and sections configured.</div>
        </div>
    @elseif($selectedClassId)
        <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
            <div class="text-lg font-medium mb-2">Select an exam to configure distributions</div>
            <div class="text-sm">Choose an exam from the options above to assign teachers.</div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
            <div class="text-lg font-medium mb-2">Select a class to configure answer script distribution</div>
            <div class="text-sm">Choose a class from the tabs above to get started.</div>
        </div>
    @endif

    <!-- Teacher Assignment Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" wire:click="closeModal">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white"
                wire:click.stop>
                <!-- Modal Header -->
                <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        @if($selectedTeacherId) Edit Teacher Assignment @else Assign Teacher @endif
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="py-4">
                    <!-- Assignment Details -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-md">
                        <h4 class="text-sm font-medium text-gray-900 mb-2">Assignment Details</h4>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="font-medium text-gray-700">Subject:</span>
                                <span class="text-gray-900">
                                    {{ $classSubjects->where('subject_id', $modalSubjectId)->first()->subject->name ?? 'Unknown' }}
                                </span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">Exam Type:</span>
                                <span class="text-gray-900">
                                    {{ $examTypes->where('id', $modalExamTypeId)->first()->name ?? 'Unknown' }}
                                </span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">Exam Part:</span>
                                <span class="text-gray-900">
                                    {{ $examParts->where('id', $modalExamPartId)->first()->name ?? 'Unknown' }}
                                </span>
                            </div>
                            <div>
                                <span class="font-medium text-gray-700">Section:</span>
                                <span class="text-gray-900">
                                    {{ $classSections->where('section_id', $modalSectionId)->first()->name ?? 'Unknown' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Teacher Selection -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Teacher</label>
                        <select wire:model="selectedTeacherId"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">-- Select a Teacher --</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                        @if(count($teachers) == 0)
                            <p class="mt-2 text-sm text-red-600">No teachers available. Please add teachers first.</p>
                        @endif
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex items-center justify-end pt-4 border-t border-gray-200 space-x-2">
                    <button wire:click="assignTeacher"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium"
                        @if(!$selectedTeacherId || count($teachers) == 0) disabled @endif>
                        @if($selectedTeacherId) Update Teacher @else Assign Teacher @endif
                    </button>
                    <button wire:click="closeModal"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-md text-sm font-medium">
                        Cancel
                    </button>
                </div>
                @if (session()->has('error'))
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md">
            {{ session('error') }}
        </div>
    @endif
            </div>
        </div>
    @endif
</div>