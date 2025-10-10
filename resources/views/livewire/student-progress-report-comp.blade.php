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
                    <option value="{{ is_object($class) ? $class->id : (is_array($class) ? $class['id'] : '') }}">{{ is_object($class) ? $class->name : (is_array($class) ? $class['name'] : 'N/A') }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Section Selection -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
                <select wire:model.live="selectedSectionId"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Select Section</option>
                    @foreach($sections as $sectionId => $section)
                    <option value="{{ $sectionId }}">{{ is_object($section) ? $section->name : (is_array($section) ? $section['name'] : 'N/A') }}</option>
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
                    <option value="{{ is_object($student) ? $student->id : (is_array($student) ? $student['id'] : '') }}">{{ is_object($student) ? $student->roll_number : (is_array($student) ? $student['roll_number'] : 'N/A') }} - {{ is_object($student) && $student->studentdb ? $student->studentdb->name : (is_array($student) && isset($student['studentdb']) ? $student['studentdb']['name'] : 'N/A') }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Progress Report -->
    @if($selectedStudentId && !empty($progressData))
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Student Result Sheet Header -->
        <div class="bg-gray-50 px-6 py-4 border-b">
            <!-- School Information -->
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">SCHOOL NAME</h1>
                <p class="text-gray-600">School Address | Phone: XXX-XXXX-XXXX | Email: info@school.edu</p>
                <div class="border-t border-b border-gray-300 my-4 py-2">
                    <h2 class="text-xl font-semibold text-gray-800">STUDENT PROGRESS REPORT</h2>
                </div>
            </div>
            
            <!-- Student Information (Enhanced) -->
            @php
            $selectedStudent = null;
            if ($students && is_iterable($students)) {
                // Try to find the student using firstWhere
                $selectedStudent = $students->firstWhere('id', $selectedStudentId);
                
                // If that doesn't work, try iterating manually
                if (!$selectedStudent) {
                    foreach ($students as $student) {
                        if ((is_object($student) && isset($student->id) && $student->id == $selectedStudentId) || 
                            (is_array($student) && isset($student['id']) && $student['id'] == $selectedStudentId)) {
                            $selectedStudent = $student;
                            break;
                        }
                    }
                }
            }
            @endphp
            
            @if($selectedStudent && (is_object($selectedStudent) || is_array($selectedStudent)))
            <div class="mb-8 p-6 bg-white border border-gray-300 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Student Information</h3>
                        <table class="w-full">
                            <tr>
                                <td class="font-semibold py-2 pr-4">Name:</td>
                                <td class="py-2">{{ is_object($selectedStudent) && $selectedStudent->studentdb ? $selectedStudent->studentdb->name : (is_array($selectedStudent) && isset($selectedStudent['studentdb']) ? $selectedStudent['studentdb']['name'] : 'N/A') }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold py-2 pr-4">Class:</td>
                                <td class="py-2">{{ is_object($selectedStudent) && $selectedStudent->myclass ? $selectedStudent->myclass->name : (is_array($selectedStudent) && isset($selectedStudent['myclass']) ? $selectedStudent['myclass']['name'] : 'N/A') }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold py-2 pr-4">Section:</td>
                                <td class="py-2">{{ is_object($selectedStudent) && $selectedStudent->section ? $selectedStudent->section->name : (is_array($selectedStudent) && isset($selectedStudent['section']) ? $selectedStudent['section']['name'] : 'N/A') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <table class="w-full">
                            <tr>
                                <td class="font-semibold py-2 pr-4">Roll No:</td>
                                <td class="py-2">{{ is_object($selectedStudent) ? ($selectedStudent->roll_number ?? 'N/A') : (is_array($selectedStudent) ? ($selectedStudent['roll_number'] ?? 'N/A') : 'N/A') }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold py-2 pr-4">Admission No:</td>
                                <td class="py-2">{{ is_object($selectedStudent) ? ($selectedStudent->admission_no ?? 'N/A') : (is_array($selectedStudent) ? ($selectedStudent['admission_no'] ?? 'N/A') : 'N/A') }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold py-2 pr-4">Report Date:</td>
                                <td class="py-2">{{ now()->format('d M Y') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Progress Report Tables -->
        <div class="p-6">
            @php
            // Reorganize data for better presentation
            // Group by exam type first, then by exam name, then by subject
            
            $organizedData = [
                'summative' => [],
                'formative' => [],
                'other' => []
            ];
            
            foreach($progressData as $exam) {
                $examName = is_array($exam) ? ($exam['name'] ?? 'N/A') : (is_object($exam) ? ($exam->name ?? 'N/A') : 'N/A');
                $types = is_array($exam) ? ($exam['types'] ?? []) : (is_object($exam) ? ($exam->types ?? []) : []);
                
                foreach($types as $type) {
                    $typeName = is_array($type) ? ($type['name'] ?? '') : (is_object($type) ? ($type->name ?? '') : '');
                    $subjects = is_array($type) ? ($type['subjects'] ?? []) : (is_object($type) ? ($type->subjects ?? []) : []);
                    
                    // Determine exam type category
                    $category = 'other';
                    if(stripos($typeName, 'summative') !== false) {
                        $category = 'summative';
                    } elseif(stripos($typeName, 'formative') !== false) {
                        $category = 'formative';
                    }
                    
                    // Initialize exam structure if not exists
                    if(!isset($organizedData[$category][$examName])) {
                        $organizedData[$category][$examName] = [
                            'exam_name' => $examName,
                            'subjects' => []
                        ];
                    }
                    
                    // Collect subject data
                    foreach($subjects as $subject) {
                        $subjectName = is_array($subject) ? ($subject['name'] ?? 'N/A') : (is_object($subject) ? ($subject->name ?? 'N/A') : 'N/A');
                        $fullMarks = is_array($subject) ? ($subject['full_marks'] ?? 'N/A') : (is_object($subject) ? ($subject->full_marks ?? 'N/A') : 'N/A');
                        $marks = is_array($subject) ? ($subject['marks'] ?? []) : (is_object($subject) ? ($subject->marks ?? []) : []);
                        
                        // Initialize subject structure if not exists
                        if(!isset($organizedData[$category][$examName]['subjects'][$subjectName])) {
                            $organizedData[$category][$examName]['subjects'][$subjectName] = [
                                'name' => $subjectName,
                                'full_marks' => $fullMarks,
                                'marks_details' => []
                            ];
                        }
                        
                        // Add marks details
                        foreach($marks as $mark) {
                            $examDetail = is_array($mark) ? ($mark['exam_detail'] ?? null) : (is_object($mark) ? ($mark->exam_detail ?? null) : null);
                            $marksEntry = is_array($mark) ? ($mark['marks_entry'] ?? null) : (is_object($mark) ? ($mark->marks_entry ?? null) : null);
                            $displayMarks = is_array($mark) ? ($mark['display_marks'] ?? 'N/A') : (is_object($mark) ? ($mark->display_marks ?? 'N/A') : 'N/A');
                            
                            if($examDetail) {
                                $examDetailName = is_object($examDetail) ? ($examDetail->name ?? 'N/A') : (is_array($examDetail) ? ($examDetail['name'] ?? 'N/A') : 'N/A');
                                
                                $organizedData[$category][$examName]['subjects'][$subjectName]['marks_details'][] = [
                                    'exam_detail_name' => $examDetailName,
                                    'full_marks' => $fullMarks,
                                    'obtained_marks' => $displayMarks,
                                    'marks_entry' => $marksEntry
                                ];
                            }
                        }
                    }
                }
            }
            
            // Get subjects specific to summative exams
            $summativeSubjects = [];
            foreach($organizedData['summative'] as $examName => $examData) {
                foreach($examData['subjects'] as $subjectName => $subjectData) {
                    if(!in_array($subjectName, $summativeSubjects)) {
                        $summativeSubjects[] = $subjectName;
                    }
                }
            }
            
            // Get subjects specific to formative exams
            $formativeSubjects = [];
            foreach($organizedData['formative'] as $examName => $examData) {
                foreach($examData['subjects'] as $subjectName => $subjectData) {
                    if(!in_array($subjectName, $formativeSubjects)) {
                        $formativeSubjects[] = $subjectName;
                    }
                }
            }
            @endphp
            
            <!-- Summative Exams Table -->
            @if(!empty($organizedData['summative']))
            <div class="mb-8">
                <h4 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2 flex items-center">
                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-red-100 text-red-800 text-xs font-bold mr-2">S</span>
                    Summative Exams
                </h4>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Exam Name</th>
                                @foreach($summativeSubjects as $subject)
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $subject }}
                                    <div class="text-xs font-normal text-gray-500">FM/PM</div>
                                </th>
                                @endforeach
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($organizedData['summative'] as $examName => $examData)
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $examName }}</td>
                                
                                @foreach($summativeSubjects as $subject)
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                    @if(isset($examData['subjects'][$subject]))
                                        @php
                                        $subjectData = $examData['subjects'][$subject];
                                        $fullMarks = $subjectData['full_marks'] ?? 'N/A';
                                        $totalObtained = 0;
                                        $hasMarks = false;
                                        $isAbsent = false;
                                        
                                        // Calculate total obtained marks for this subject
                                        foreach($subjectData['marks_details'] as $markDetail) {
                                            $obtained = $markDetail['obtained_marks'] ?? 'N/A';
                                            if($obtained !== 'N/A' && $obtained !== 'AB') {
                                                $totalObtained += is_numeric($obtained) ? $obtained : 0;
                                                $hasMarks = true;
                                            } elseif($obtained === 'AB') {
                                                $isAbsent = true;
                                                break;
                                            }
                                        }
                                        @endphp
                                        
                                        @if($isAbsent)
                                        <div>AB</div>
                                        @elseif($hasMarks)
                                        <div>{{ $totalObtained }}</div>
                                        @else
                                        <div>N/A</div>
                                        @endif
                                        <div class="text-xs text-gray-400">{{ $fullMarks }}/N/A</div>
                                    @else
                                    <div>N/A</div>
                                    <div class="text-xs text-gray-400">N/A/N/A</div>
                                    @endif
                                </td>
                                @endforeach
                                
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-gray-900">
                                    @php
                                    $examTotal = 0;
                                    foreach($summativeSubjects as $subject) {
                                        if(isset($examData['subjects'][$subject])) {
                                            $subjectData = $examData['subjects'][$subject];
                                            $totalObtained = 0;
                                            $hasMarks = false;
                                            $isAbsent = false;
                                            
                                            foreach($subjectData['marks_details'] as $markDetail) {
                                                $obtained = $markDetail['obtained_marks'] ?? 'N/A';
                                                if($obtained !== 'N/A' && $obtained !== 'AB') {
                                                    $totalObtained += is_numeric($obtained) ? $obtained : 0;
                                                    $hasMarks = true;
                                                } elseif($obtained === 'AB') {
                                                    $isAbsent = true;
                                                    break;
                                                }
                                            }
                                            
                                            if(!$isAbsent && $hasMarks) {
                                                $examTotal += $totalObtained;
                                            }
                                        }
                                    }
                                    @endphp
                                    {{ $examTotal }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            
            <!-- Formative Exams Table -->
            @if(!empty($organizedData['formative']))
            <div class="mb-8">
                <h4 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2 flex items-center">
                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 text-blue-800 text-xs font-bold mr-2">F</span>
                    Formative Exams
                </h4>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Exam Name</th>
                                @foreach($formativeSubjects as $subject)
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ $subject }}
                                    <div class="text-xs font-normal text-gray-500">FM/PM</div>
                                </th>
                                @endforeach
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($organizedData['formative'] as $examName => $examData)
                            <tr>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $examName }}</td>
                                
                                @foreach($formativeSubjects as $subject)
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                    @if(isset($examData['subjects'][$subject]))
                                        @php
                                        $subjectData = $examData['subjects'][$subject];
                                        $fullMarks = $subjectData['full_marks'] ?? 'N/A';
                                        $totalObtained = 0;
                                        $hasMarks = false;
                                        $isAbsent = false;
                                        
                                        // Calculate total obtained marks for this subject
                                        foreach($subjectData['marks_details'] as $markDetail) {
                                            $obtained = $markDetail['obtained_marks'] ?? 'N/A';
                                            if($obtained !== 'N/A' && $obtained !== 'AB') {
                                                $totalObtained += is_numeric($obtained) ? $obtained : 0;
                                                $hasMarks = true;
                                            } elseif($obtained === 'AB') {
                                                $isAbsent = true;
                                                break;
                                            }
                                        }
                                        @endphp
                                        
                                        @if($isAbsent)
                                        <div>AB</div>
                                        @elseif($hasMarks)
                                        <div>{{ $totalObtained }}</div>
                                        @else
                                        <div>N/A</div>
                                        @endif
                                        <div class="text-xs text-gray-400">{{ $fullMarks }}/N/A</div>
                                    @else
                                    <div>N/A</div>
                                    <div class="text-xs text-gray-400">N/A/N/A</div>
                                    @endif
                                </td>
                                @endforeach
                                
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-semibold text-gray-900">
                                    @php
                                    $examTotal = 0;
                                    foreach($formativeSubjects as $subject) {
                                        if(isset($examData['subjects'][$subject])) {
                                            $subjectData = $examData['subjects'][$subject];
                                            $totalObtained = 0;
                                            $hasMarks = false;
                                            $isAbsent = false;
                                            
                                            foreach($subjectData['marks_details'] as $markDetail) {
                                                $obtained = $markDetail['obtained_marks'] ?? 'N/A';
                                                if($obtained !== 'N/A' && $obtained !== 'AB') {
                                                    $totalObtained += is_numeric($obtained) ? $obtained : 0;
                                                    $hasMarks = true;
                                                } elseif($obtained === 'AB') {
                                                    $isAbsent = true;
                                                    break;
                                                }
                                            }
                                            
                                            if(!$isAbsent && $hasMarks) {
                                                $examTotal += $totalObtained;
                                            }
                                        }
                                    }
                                    @endphp
                                    {{ $examTotal }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
        
        <!-- Notes and Signatures Section -->
        <div class="p-6 border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Teacher's Notes -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Teacher's Notes</h3>
                    <div class="border border-gray-300 rounded p-4 h-32">
                        <p class="text-gray-500 italic">Remarks about student's performance...</p>
                    </div>
                </div>
                
                <!-- Signatures -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Signatures</h3>
                    <div class="space-y-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="font-medium">Class Teacher</p>
                                <div class="border-t border-gray-300 w-40 mt-8"></div>
                            </div>
                            <div>
                                <p class="font-medium">Parent/Guardian</p>
                                <div class="border-t border-gray-300 w-40 mt-8"></div>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <div class="text-center">
                                <p class="font-medium">Principal</p>
                                <div class="border-t border-gray-300 w-48 mt-8"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 text-center text-sm text-gray-500">
                <p>This is an official document generated by the school management system.</p>
                <p class="mt-1">Report generated on {{ now()->format('d M Y') }} at {{ now()->format('H:i') }}</p>
            </div>
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