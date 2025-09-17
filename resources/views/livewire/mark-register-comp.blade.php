<div class="flex-1 p-6 overflow-y-auto max-w-full mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Mark Register</h1>
                <p class="mt-1 text-sm text-gray-600">View class-wise student marks grouped by Summative and Formative
                    exam types</p>
            </div>
            <div class="flex space-x-2">
                <button wire:click="refreshData"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                    Refresh Data
                </button>
                <button wire:click="exportData"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                    Export
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

    <!-- Mark Register Table -->
    @if($selectedClassId)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">
                    Mark Register for
                    <span class="text-indigo-600 font-semibold">
                        {{ $classes->firstWhere('id', $selectedClassId)->name ?? 'Selected Class' }}
                    </span>
                </h3>
                <p class="text-sm text-gray-600 mt-1">
                    Students: {{ count($students) }} |
                    Subjects: {{ count($subjectsData) }} |
                    <span class="text-green-600">Pass</span> |
                    <span class="text-red-500">Fail</span> |
                    <span class="text-red-600 font-semibold">AB (Absent)</span>
                </p>
            </div>

            @if(count($students) > 0 && count($subjectsData) > 0 && count($examNames) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-xs">
                        <thead class="bg-gray-50">
                            <!-- Main Header Row -->
                            <tr>
                                <!-- Student Info Columns -->
                                <th rowspan="3"
                                    class="px-2 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky left-0 bg-gray-50 z-20 border-r border-gray-300">
                                    Roll
                                </th>
                                <th rowspan="3"
                                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky left-12 bg-gray-50 z-20 border-r border-gray-300">
                                    Student Name
                                </th>
                                <th rowspan="3"
                                    class="px-2 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider sticky left-32 bg-gray-50 z-20 border-r border-gray-300">
                                    Exam Name
                                </th>

                                <!-- Subject Headers with Exam Type Groups -->
                                @foreach($subjectsData as $subjectId => $subject)
                                    @php
                                        $summativeCount = 0;
                                        $formativeCount = 0;
                                        foreach ($subject['exam_types'] as $examType) {
                                            if (strtolower($examType['name']) === 'summative') {
                                                $summativeCount += count($examType['parts']);
                                            } else {
                                                $formativeCount += count($examType['parts']);
                                            }
                                        }
                                        $totalCols = $summativeCount + $formativeCount + 2; // +2 for Total and Grade
                                    @endphp
                                    <th colspan="{{ $totalCols }}"
                                        class="px-1 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-l border-gray-300">
                                        {{ $subject['name'] }}
                                    </th>
                                @endforeach
                            </tr>

                            <!-- Exam Type Header Row -->
                            <tr>
                                @foreach($subjectsData as $subjectId => $subject)
                                    @foreach($subject['exam_types'] as $examTypeId => $examType)
                                        <th colspan="{{ count($examType['parts']) }}"
                                            class="px-1 py-1 text-center text-xs font-medium text-gray-600 border-l border-gray-200 {{ strtolower($examType['name']) === 'summative' ? 'bg-blue-50' : 'bg-green-50' }}">
                                            {{ $examType['name'] }}
                                        </th>
                                    @endforeach
                                    <th rowspan="2"
                                        class="px-1 py-1 text-center text-xs font-medium text-gray-600 border-l border-gray-200 bg-yellow-50">
                                        Total
                                    </th>
                                    <th rowspan="2"
                                        class="px-1 py-1 text-center text-xs font-medium text-gray-600 border-l border-gray-200 bg-orange-50">
                                        Grade
                                    </th>
                                @endforeach
                            </tr>

                            <!-- Exam Part Header Row with Full/Pass Marks -->
                            <tr>
                                @foreach($subjectsData as $subjectId => $subject)
                                    @foreach($subject['exam_types'] as $examTypeId => $examType)
                                        @foreach($examType['parts'] as $examPartId => $examPart)
                                            <th class="px-1 py-1 text-center text-xs font-medium text-gray-400 border-l border-gray-100">
                                                <div>{{ $examPart['name'] }}</div>
                                                <div class="text-xs text-blue-600">FM: {{ $examPart['full_marks'] }}</div>
                                                <div class="text-xs text-red-600">PM: {{ $examPart['pass_marks'] }}</div>
                                            </th>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($students as $student)
                                @foreach($examNames as $examIndex => $examName)
                                    <tr class="hover:bg-gray-50 {{ $examIndex > 0 ? 'border-t-2 border-gray-300' : '' }}">
                                        <!-- Student Info (only show for first exam) -->
                                        @if($examIndex === 0)
                                            <td rowspan="{{ count($examNames) + 2 }}"
                                                class="px-2 py-2 text-sm font-medium text-gray-900 sticky left-0 bg-white z-10 border-r border-gray-200 align-top">
                                                {{ $student['roll_number'] }}
                                            </td>
                                            <td rowspan="{{ count($examNames) + 2 }}"
                                                class="px-3 py-2 text-sm text-gray-900 sticky left-12 bg-white z-10 border-r border-gray-200 align-top">
                                                <div class="font-medium">{{ $student['name'] }}</div>
                                                <div class="text-xs text-gray-500">{{ $student['admission_number'] }}</div>
                                            </td>
                                        @endif

                                        <!-- Exam Name -->
                                        <td
                                            class="px-2 py-2 text-sm font-medium text-gray-700 sticky left-32 bg-white z-10 border-r border-gray-200">
                                            {{ $examName['name'] }}
                                        </td>

                                        <!-- Marks for each subject -->
                                        @foreach($subjectsData as $subjectId => $subject)
                                            @foreach($subject['exam_types'] as $examTypeId => $examType)
                                                @foreach($examType['parts'] as $examPartId => $examPart)
                                                    <td class="px-1 py-2 text-center border-l border-gray-100">
                                                        <span
                                                            class="{{ $this->getMarkClass($student['id'], $subjectId, $examName['id'], $examTypeId, $examPartId) }}">
                                                            {{ $this->getStudentMark($student['id'], $subjectId, $examName['id'], $examTypeId, $examPartId) }}
                                                        </span>
                                                    </td>
                                                @endforeach
                                            @endforeach

                                            <!-- Total and Grade (only show for first exam) -->
                                            @if($examIndex === 0)
                                                <td rowspan="{{ count($examNames) }}"
                                                    class="px-1 py-2 text-center font-semibold text-blue-700 border-l border-gray-200 bg-yellow-50 align-middle">
                                                    {{ $this->getTotalMarks($student['id'], $subjectId) }}
                                                </td>
                                                <td rowspan="{{ count($examNames) }}"
                                                    class="px-1 py-2 text-center font-bold text-purple-700 border-l border-gray-200 bg-orange-50 align-middle">
                                                    {{ $this->getGrade($student['id'], $subjectId) }}
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach

                                <!-- Total Marks Row -->
                                <tr class="bg-blue-50 border-t-2 border-blue-300">
                                    <td
                                        class="px-2 py-2 text-sm font-bold text-blue-800 sticky left-32 bg-blue-50 z-10 border-r border-gray-200">
                                        TOTAL MARKS
                                    </td>
                                    @foreach($subjectsData as $subjectId => $subject)
                                        @foreach($subject['exam_types'] as $examTypeId => $examType)
                                            @foreach($examType['parts'] as $examPartId => $examPart)
                                                <td class="px-1 py-2 text-center font-semibold text-blue-700 border-l border-gray-100">
                                                    @php
                                                        $totalForPart = 0;
                                                        $hasMarks = false;
                                                        foreach ($examNames as $examName) {
                                                            $mark = $this->getStudentMark($student['id'], $subjectId, $examName['id'], $examTypeId, $examPartId);
                                                            if ($mark !== '-' && $mark !== 'AB') {
                                                                $totalForPart += $mark;
                                                                $hasMarks = true;
                                                            }
                                                        }
                                                        echo $hasMarks ? $totalForPart : '-';
                                                    @endphp
                                                </td>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </tr>

                                <!-- Grade Row -->
                                <tr class="bg-green-50 border-b-4 border-gray-400">
                                    <td
                                        class="px-2 py-2 text-sm font-bold text-green-800 sticky left-32 bg-green-50 z-10 border-r border-gray-200">
                                        GRADE
                                    </td>
                                    @foreach($subjectsData as $subjectId => $subject)
                                        @foreach($subject['exam_types'] as $examTypeId => $examType)
                                            @foreach($examType['parts'] as $examPartId => $examPart)
                                                <td class="px-1 py-2 text-center font-bold text-green-700 border-l border-gray-100">
                                                    @php
                                                        $totalForPart = 0;
                                                        $hasMarks = false;
                                                        foreach ($examNames as $examName) {
                                                            $mark = $this->getStudentMark($student['id'], $subjectId, $examName['id'], $examTypeId, $examPartId);
                                                            if ($mark !== '-' && $mark !== 'AB') {
                                                                $totalForPart += $mark;
                                                                $hasMarks = true;
                                                            }
                                                        }
                                                        if ($hasMarks && $examPart['full_marks'] =! 0) {
                                                            $percentage = ($totalForPart / ($examPart['full_marks'] * count($examNames))) * 100;
                                                            if ($percentage >= 90)
                                                                echo 'A+';
                                                            elseif ($percentage >= 80)
                                                                echo 'A';
                                                            elseif ($percentage >= 70)
                                                                echo 'B+';
                                                            elseif ($percentage >= 60)
                                                                echo 'B';
                                                            elseif ($percentage >= 50)
                                                                echo 'C+';
                                                            elseif ($percentage >= 40)
                                                                echo 'C';
                                                            elseif ($percentage >= 30)
                                                                echo 'D';
                                                            else
                                                                echo 'F';
                                                        } else {
                                                            echo '-';
                                                        }
                                                    @endphp
                                                </td>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-6 text-center text-gray-500">
                    @if(count($students) == 0)
                        <div class="text-lg font-medium mb-2">No students found</div>
                        <div class="text-sm">No students are enrolled in this class.</div>
                    @elseif(count($subjectsData) == 0)
                        <div class="text-lg font-medium mb-2">No subjects configured</div>
                        <div class="text-sm">No subjects have been configured for exams in this class.</div>
                    @elseif(count($examNames) == 0)
                        <div class="text-lg font-medium mb-2">No exam names found</div>
                        <div class="text-sm">No active exam configurations found for this class.</div>
                    @endif
                </div>
            @endif
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
            <div class="text-lg font-medium mb-2">Select a class to view mark register</div>
            <div class="text-sm">Choose a class from the tabs above to view student marks.</div>
        </div>
    @endif
</div>