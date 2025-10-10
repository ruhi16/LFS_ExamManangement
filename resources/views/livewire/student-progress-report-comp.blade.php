<div class="p-6">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Student Progress Report</h2>
        <p class="text-gray-600">View detailed progress report for students organized by class, section, and exam types.
        </p>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Class Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Class</label>
                <select wire:model.live="selectedClassId"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Select Class</option>
                    @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Section Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
                <select wire:model.live="selectedSectionId"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Select Section</option>
                    @foreach($sections as $section)
                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Student Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Student</label>
                <select wire:model.live="selectedStudentId"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Select Student</option>
                    @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->roll_number }} - {{ $student->studentdb->name ??
                        'N/A' }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Progress Report -->
    @if($selectedStudentId && !empty($progressData))
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Student Info Header -->
        @php
        $selectedStudent = $students->firstWhere('id', $selectedStudentId);
        @endphp
        @if($selectedStudent)
        <div class="bg-gray-50 px-6 py-4 border-b">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">{{ $selectedStudent->studentdb->name ?? 'N/A' }}
                    </h3>
                    <p class="text-gray-600">
                        Class: {{ $selectedStudent->myclass->name ?? 'N/A' }} |
                        Section: {{ $selectedStudent->section->name ?? 'N/A' }} |
                        Roll No: {{ $selectedStudent->roll_number ?? 'N/A' }}
                    </p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Report Generated: {{ now()->format('d M Y') }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Progress Report Table -->
        <div class="p-6">
            @foreach($progressData as $exam)
            <div class="mb-8">
                <h4 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">{{ $exam['name'] }}</h4>

                @foreach($exam['types'] as $type)
                <div class="mb-6">
                    <h5 class="text-md font-medium text-gray-700 mb-3 flex items-center">
                        @if(stripos($type['name'], 'summative') !== false)
                        <span
                            class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-red-100 text-red-800 text-xs font-bold mr-2">S</span>
                        @elseif(stripos($type['name'], 'formative') !== false)
                        <span
                            class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-800 text-xs font-bold mr-2">F</span>
                        @else
                        <span
                            class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-100 text-gray-800 text-xs font-bold mr-2">T</span>
                        @endif
                        {{ $type['name'] }}
                    </h5>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subject</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Full Marks</th>
                                    @foreach($type['subjects'][0]['marks'] ?? [] as $mark)
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ $mark['exam_detail']->examPart->name ?? 'N/A' }}
                                    </th>
                                    @endforeach
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Grade</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($type['subjects'] as $subject)
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{
                                        $subject['name'] }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">{{
                                        $subject['full_marks'] ?? 'N/A' }}</td>

                                    @php
                                    $totalMarks = 0;
                                    $totalFullMarks = 0;
                                    $validMarksCount = 0;
                                    @endphp

                                    @foreach($subject['marks'] as $mark)
                                    @php
                                    $marksValue = $mark['marks_entry'] ? $mark['marks_entry']->exam_marks : null;
                                    $displayMarks = $mark['display_marks'];

                                    if (is_numeric($marksValue)) {
                                    $totalMarks += $marksValue;
                                    $totalFullMarks += $subject['full_marks'] ?? 0;
                                    $validMarksCount++;
                                    }
                                    @endphp
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                        @if($displayMarks === 'AB')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            {{ $displayMarks }}
                                        </span>
                                        @else
                                        {{ $displayMarks }}
                                        @endif
                                    </td>
                                    @endforeach

                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-gray-900">
                                        @if($validMarksCount > 0 && $totalFullMarks > 0)
                                        {{ $totalMarks }}/{{ $totalFullMarks }}
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                        @php
                                        // Calculate grade based on percentage
                                        $percentage = ($totalFullMarks > 0) ? ($totalMarks / $totalFullMarks) * 100 : 0;
                                        $grade = '';
                                        if ($percentage >= 90) $grade = 'A+';
                                        elseif ($percentage >= 80) $grade = 'A';
                                        elseif ($percentage >= 70) $grade = 'B+';
                                        elseif ($percentage >= 60) $grade = 'B';
                                        elseif ($percentage >= 50) $grade = 'C';
                                        elseif ($percentage >= 40) $grade = 'D';
                                        else $grade = 'F';
                                        @endphp
                                        @if($validMarksCount > 0)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                                @if($grade === 'A+' || $grade === 'A') bg-green-100 text-green-800
                                                                @elseif($grade === 'B+' || $grade === 'B') bg-blue-100 text-blue-800
                                                                @elseif($grade === 'C') bg-yellow-100 text-yellow-800
                                                                @else bg-red-100 text-red-800 @endif">
                                            {{ $grade }}
                                        </span>
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
    @elseif($selectedStudentId)
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="text-center py-8">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="mt-2 text-lg font-medium text-gray-900">No Data Available</h3>
            <p class="mt-1 text-gray-500">No progress data found for the selected student.</p>
        </div>
    </div>
    @else
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="text-center py-8">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <h3 class="mt-2 text-lg font-medium text-gray-900">Select a Student</h3>
            <p class="mt-1 text-gray-500">Please select a class, section, and student to view the progress report.</p>
        </div>
    </div>
    @endif
</div>