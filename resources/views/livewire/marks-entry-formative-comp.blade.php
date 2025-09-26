<div class="p-6">
    <!-- Debug Information -->
    @if(app()->environment('local'))
    <div class="mb-4 p-4 bg-yellow-100 border border-yellow-300 rounded">
        <h3 class="font-bold text-yellow-800">Debug Information</h3>
        <p>Exam Detail ID: {{ $exam_detail_id ?? 'N/A' }}</p>
        <p>Myclass Section ID: {{ $myclass_section_id ?? 'N/A' }}</p>
        <p>Exam Type ID: {{ $examDetail->exam_type_id ?? 'N/A' }}</p>
        <p>Grades Count: {{ $grades ? (is_array($grades) ? count($grades) : $grades->count()) : 0 }}</p>
        <p>Students Count: {{ count($students ?? []) }}</p>
        <p>Formative Subjects Count: {{ $formativeSubjects ? $formativeSubjects->count() : 0 }}</p>

        @php
        // Count saved marks entries
        $savedMarksCount = 0;
        if (isset($marksData) && is_array($marksData)) {
        foreach ($marksData as $studentData) {
        foreach ($studentData as $subjectData) {
        if (!empty($subjectData['grade_id'])) {
        $savedMarksCount++;
        }
        }
        }
        }
        @endphp
        <p>Saved Marks Entries: {{ $savedMarksCount }}</p>

        @if($formativeSubjects)
        <p>Formative Subjects IDs: {{ $formativeSubjects->pluck('id')->implode(', ') }}</p>
        @foreach($formativeSubjects as $subject)
        <p>Subject ID {{ $subject->id }}: {{ $subject->subject->name ?? 'N/A' }} (Type: {{
            $subject->subject->subjectType->name ?? 'N/A' }})</p>
        @endforeach
        @endif
        @if($grades && (is_array($grades) ? count($grades) > 0 : $grades->count() > 0))
        @php
        $firstGrade = is_array($grades) ? $grades[0] : $grades->first();
        @endphp
        <p>First Grade: {{ $firstGrade->name ?? 'N/A' }} (ID: {{ $firstGrade->id ?? 'N/A' }})</p>
        @endif
        <div class="flex space-x-2 mt-2">
            <button wire:click="loadData" class="px-3 py-1 bg-blue-500 text-white rounded text-sm">Refresh All
                Data</button>
            <button wire:click="refreshMarksData" class="px-3 py-1 bg-green-500 text-white rounded text-sm">Refresh
                Marks Data Only</button>
        </div>
    </div>
    @endif

    <!-- Header -->
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Formative Exam Marks Entry</h1>
                <p class="text-gray-600 mt-1">
                    @if($examDetail && $myclassSection)
                    {{ $examDetail->examName->name ?? 'N/A' }} -
                    {{ $examDetail->examType->name ?? 'N/A' }} -
                    {{ $myclassSection->myclass->name ?? 'N/A' }} -
                    {{ $myclassSection->section->name ?? 'N/A' }}
                    @endif
                </p>
            </div>
            <div class="flex space-x-2">
                <!-- Finalize/Unfinalize Button at the top -->
                @if($isFinalized)
                <button wire:click="unfinalizeMarks"
                    onclick="return confirm('Are you sure you want to unfinalize these marks?')"
                    class="px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg transition-colors">
                    <i class="fas fa-unlock mr-2"></i>Unfinalize Marks
                </button>
                @else
                <button wire:click="finalizeMarks"
                    onclick="return confirm('Are you sure you want to finalize these marks? This action cannot be undone without admin privileges.')"
                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-lock mr-2"></i>Finalize Marks
                </button>
                @endif

                <button wire:click="loadData"
                    class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-colors">
                    <i class="fas fa-sync-alt mr-2"></i>Refresh
                </button>
            </div>
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

    <!-- Finalization Status -->
    <div class="mb-6">
        @if($isFinalized)
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <div class="flex items-center">
                <i class="fas fa-lock text-red-500 mr-2"></i>
                <div>
                    <h3 class="text-lg font-medium text-red-800">Marks Finalized</h3>
                    <p class="text-sm text-red-700">This marks entry has been finalized and cannot be modified.</p>
                </div>
            </div>
        </div>
        @else
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-center">
                <i class="fas fa-edit text-blue-500 mr-2"></i>
                <div>
                    <h3 class="text-lg font-medium text-blue-800">Marks Entry in Progress</h3>
                    <p class="text-sm text-blue-700">Enter grades for each student and formative subject, then save and
                        finalize when complete.</p>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Marks Entry Table -->
    @if($students && $formativeSubjects && $formativeSubjects->count() > 0)
    @if($grades && (is_array($grades) ? count($grades) > 0 : $grades->count() > 0))
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Student Marks Entry</h3>
            <p class="text-sm text-gray-600 mt-1">Select grades for each student and formative subject</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky left-0 bg-gray-50">
                            Student
                        </th>
                        @foreach($formativeSubjects as $subject)
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ $subject->subject->name ?? 'N/A' }}
                        </th>
                        @endforeach
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($students as $student)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap sticky left-0 bg-white">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $student->studentdb->name ?? 'N/A' }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        Roll: {{ $student->roll_no ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        @foreach($formativeSubjects as $subject)
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($isFinalized)
                            <!-- Display finalized marks as numeric values -->
                            @php
                            $marksEntry = $marksData[$student->id][$subject->id] ?? null;
                            $displayValue = 'N/A';
                            if ($marksEntry) {
                            if ($marksEntry['grade_id'] === 'absent') {
                            $displayValue = 'ABSENT';
                            } elseif ($marksEntry['grade_id'] && $marksEntry['marks'] !== null) {
                            // Show the actual marks value
                            $displayValue = $marksEntry['marks'];
                            }
                            }
                            @endphp
                            <span
                                class="text-sm font-medium {{ $displayValue === 'N/A' ? 'text-gray-400' : ($displayValue === 'ABSENT' ? 'text-red-600' : 'text-gray-900') }} {{ $displayValue !== 'N/A' ? 'bg-green-100 px-2 py-1 rounded' : '' }}">
                                {{ $displayValue }}
                            </span>
                            @else
                            <!-- Editable grade selection with Absent as last option -->
                            @php
                            // Get current value for this student and subject
                            $studentSubjectData = $marksData[$student->id][$subject->id] ?? [];
                            $currentGradeId = $studentSubjectData['grade_id'] ?? '';
                            $currentMarks = $studentSubjectData['marks'] ?? 'N/A';
                            $hasSavedData = !empty($currentGradeId);
                            @endphp
                            <div class="{{ $hasSavedData ? 'border-2 border-green-500 rounded p-1 relative' : '' }}">
                                @if($hasSavedData)
                                <div
                                    class="absolute -top-2 -right-2 bg-green-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                                    ✓
                                </div>
                                @endif
                                <select wire:model="marksData.{{ $student->id }}.{{ $subject->id }}.grade_id"
                                    class="w-full px-3 py-1 border border-gray-300 rounded-md text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Select Grade</option>
                                    @foreach($grades as $grade)
                                    <option value="{{ $grade->id }}" {{ (string)$currentGradeId===(string)$grade->id ?
                                        'selected' : '' }}>{{ $grade->name }}</option>
                                    @endforeach
                                    <option value="absent" {{ $currentGradeId==='absent' ? 'selected' : '' }}>Absent
                                    </option>
                                </select>
                                <!-- Debug: Show current value and marks -->
                                @if(app()->environment('local'))
                                <div class="text-xs text-gray-500 mt-1 flex justify-between items-center">
                                    <div>
                                        Grade ID: <span class="font-mono">'{{ $currentGradeId }}'</span>,
                                        Marks: <span class="font-mono">'{{ $currentMarks }}'</span>
                                    </div>
                                    @if($hasSavedData)
                                    <span
                                        class="bg-green-500 text-white px-2 py-0.5 rounded text-xs font-bold flex items-center">
                                        <i class="fas fa-check mr-1"></i> SAVED
                                    </span>
                                    @endif
                                </div>
                                @endif
                            </div>
                            @endif
                        </td>
                        @endforeach
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if(!$isFinalized)
                            @php
                            $isComplete = true;
                            foreach($formativeSubjects as $subject) {
                            if (!isset($marksData[$student->id][$subject->id]) ||
                            empty($marksData[$student->id][$subject->id]['grade_id'])) {
                            $isComplete = false;
                            break;
                            }
                            }
                            @endphp
                            <div class="flex space-x-2">
                                <button wire:click="saveStudentMarks({{ $student->id }})" @if(!$isComplete) disabled
                                    @endif
                                    class="px-3 py-1 text-sm rounded @if($isComplete) bg-blue-600 hover:bg-blue-700 text-white @else bg-gray-300 text-gray-500 cursor-not-allowed @endif">
                                    Save
                                </button>
                                @if(app()->environment('local'))
                                <button wire:click="refreshMarksData"
                                    class="px-3 py-1 text-sm rounded bg-gray-500 hover:bg-gray-600 text-white">
                                    <i class="fas fa-sync"></i>
                                </button>
                                @endif
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Action Buttons -->
        @if(!$isFinalized)
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            <div class="flex justify-end space-x-3">
                <button wire:click="saveMarks"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-save mr-2"></i>Save All Marks
                </button>
                <!-- Refresh button for easier testing -->
                @if(app()->environment('local'))
                <button wire:click="refreshMarksData"
                    class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition-colors">
                    <i class="fas fa-sync-alt mr-2"></i>Refresh Data
                </button>
                @endif
            </div>
        </div>
        @endif
    </div>
    @else
    <div class="bg-red-50 border border-red-200 rounded-lg p-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-red-400 text-xl"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">No Grades Available</h3>
                <div class="mt-2 text-sm text-red-700">
                    <p>No grades found for exam type {{ $examDetail->exam_type_id ?? 'N/A' }}.</p>
                    <p class="mt-2">Please ensure that grades are configured for this exam type in the system.</p>
                </div>
            </div>
        </div>
    </div>
    @endif
    @else
    <div class="text-center py-12">
        <div class="text-gray-400 mb-4">
            <i class="fas fa-table text-6xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No Formative Subjects Found</h3>
        <p class="text-gray-600 mb-4">No formative subjects are configured for this exam.</p>
        <p class="text-gray-500 text-sm">Please ensure that formative subjects are properly set up with the correct
            subject types.</p>

        <!-- Debug Information when no data -->
        @if(app()->environment('local'))
        <div class="mt-4 p-4 bg-red-100 border border-red-300 rounded">
            <h4 class="font-bold text-red-800">Debug Details:</h4>
            <ul class="text-left list-disc list-inside">
                <li>Students: {{ $students ? count($students) : 'null' }}</li>
                <li>Formative Subjects: {{ $formativeSubjects ? $formativeSubjects->count() : 'null' }}</li>
                <li>Grades: {{ $grades ? (is_array($grades) ? count($grades) : $grades->count()) : 'null' }}</li>
            </ul>
            <button wire:click="loadData" class="mt-2 px-3 py-1 bg-blue-500 text-white rounded text-sm">Refresh
                Data</button>
        </div>
        @endif
    </div>
    @endif

    <!-- Grades Legend -->
    @if($grades && (is_array($grades) ? count($grades) > 0 : $grades->count() > 0))
    <div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <h4 class="text-md font-semibold text-gray-900 mb-3">Grades Legend</h4>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-2">
            @foreach($grades as $grade)
            <div class="flex items-center px-3 py-2 bg-gray-50 rounded-md">
                <span
                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 mr-2">
                    {{ $grade->name }}
                </span>
                <span class="text-xs text-gray-600">
                    {{ $grade->min_mark_percentage }}% - {{ $grade->max_mark_percentage }}%
                </span>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>