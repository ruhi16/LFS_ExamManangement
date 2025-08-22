<div class="flex-1 p-6 overflow-y-auto max-w-full mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Marks Entry XX</h1>
                <p class="mt-1 text-sm text-gray-600">Select exam details to enter marks for students</p>
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

    <!-- Debug Panel -->
    @if($debugMode)
        <div class="mb-4 p-4 bg-yellow-50 border border-yellow-200 rounded-md">
            <h4 class="text-sm font-medium text-yellow-800 mb-2">Debug Panel</h4>
            <div class="flex space-x-2 mb-2">
                <button wire:click="checkDatabaseConnection" class="bg-blue-500 text-white px-3 py-1 rounded text-xs">
                    Test DB Connection
                </button>
                <button wire:click="refreshData" class="bg-purple-500 text-white px-3 py-1 rounded text-xs">
                    Refresh Data
                </button>
                <button wire:click="debugExamDetails" class="bg-orange-500 text-white px-3 py-1 rounded text-xs">
                    Debug Exam Details
                </button>
            </div>
            <div class="text-xs text-yellow-700">
                Selected Class: <span class="font-semibold"> {{ $selectedClassId ?? 'None' }} </span>|
                Selected Exam: {{ $selectedExamNameId ?? 'None' }} |
                Sections: {{ count($classSections) }} |
                Subjects: {{ count($classSubjects) }} |
                Exam Details: {{ is_array($examDetails) ? array_sum(array_map('count', $examDetails)) : 0 }}
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
                    Selected: {{ $classes->where('id', $selectedClassId)->first()->name ?? 'Unknown Class' }}
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
            <h3 class="text-lg font-medium text-gray-900 mb-3">Select Exam</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($examNames as $examName)
                    <button wire:click="selectExamName({{ $examName->id }})"
                        class="@if($selectedExamNameId == $examName->id) bg-indigo-600 text-white @else bg-gray-200 text-gray-700 hover:bg-gray-300 @endif px-4 py-2 rounded-md text-sm font-medium">
                        {{ $examName->name }} X
                    </button>
                @endforeach
            </div>
        </div>
    @endif

    <!-- DEBUG INFO -->
    {{-- @if($selectedClassId && $selectedExamNameId)
        <div class="mb-4 p-4 bg-yellow-50 border border-yellow-200 rounded-md">
            <h4 class="text-sm font-medium text-yellow-800 mb-2">DEBUG INFO</h4>
            <div class="text-xs text-yellow-700 space-y-1">
                <div>Selected Class ID: {{ $selectedClassId ?? 'NULL' }}</div>
                <div>Selected Exam ID: {{ $selectedExamNameId ?? 'NULL' }}</div>
                <div>Class Subjects Count: {{ count($classSubjects) }}</div>
                <div>Class Sections Count: {{ count($classSections) }}</div>
                <div>Exam Details Type: {{ gettype($examDetails) }}</div>
                <div>Exam Details Count: {{ is_array($examDetails) ? count($examDetails) : 'NOT_ARRAY' }}</div>
                <div>Exam Types Count: {{ count($examTypes) }}</div>
                @if(is_array($examDetails) && count($examDetails) > 0)
                    <div>Exam Details Keys: {{ implode(', ', array_keys($examDetails)) }}</div>
                @endif
            </div>
        </div>
    @endif --}}
        {{-- {{ dd($examDetails) }} --}}
    <!-- Marks Entry Tables by Exam Type (Summative first, then Formative) -->
    @if($selectedClassId && $selectedExamNameId && count($classSubjects) > 0 && count($classSections) > 0 && is_array($examDetails) && count($examDetails) > 0)
        <div class="space-y-8">
            @foreach($examTypes->sortByDesc('id') as $examType)
                <!-- DEBUG: Checking exam type {{ $examType->id }} -->
                {{-- ExamType: {{ $examType->id }} --}}
                {{-- ExamDetail: {{ isset($examDetails[$examType->id]) ? json_encode($examDetails[$examType->id]) : 'NOT_FOUND' }} --}}
                
                @if(isset($examDetails[$examType->id]))
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-4 border-b border-gray-200 bg-gray-200 sticky top-0 z-10 flex items-center justify-between py-2 px-4">
                            <h3 class="text-lg font-semibold text-gray-900">
                                {{ $examType->name }} - Marks Entry
                                {{-- {{ json_encode($examDetails) }} --}}
                                {{-- @foreach($examDetails as $examDetail) --}}
                                    {{-- {{ json_encode($examDetail) }}<br/><br/> --}}
                                    {{-- @if($examDetail->examtype_id == $examType->id)
                                        @if($examDetail->exammode_id == 1)
                                            - Summative
                                        @elseif($examDetail->exammode_id == 2)
                                            - Formative
                                        @endif
                                    @endif --}}
                                {{-- @endforeach --}}
                            </h3>
                            <p class="text-sm text-gray-600 mt-1">
                                Click on any cell to enter marks for that exam part
                            </p>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-800 uppercase tracking-wider sticky left-0 bg-gray-50 z-10">
                                            Subject
                                        </th>
                                        @foreach($classSections as $classSection)
                                            <th scope="col"
                                                class="px-4 py-3 text-center text-xs font-medium text-gray-800 uppercase tracking-wider border-l border-gray-300">
                                                <div class="font-semibold text-gray-900">{{ $classSection->section->name }} Section
                                                </div>
                                                {{-- <div class="text-xs text-gray-400 mt-1">Section</div> --}}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @php 
                                        $examDetailIds = $examDetails[$examType->id];
                                        // dd($examDetailIds[0]['id']);
                                    @endphp
                                    {{-- {{ dd($classSubjects) }} --}}
                                    @foreach($classSubjects->where('exam_detail_id', $examDetailIds[0]['id']) as $subject)
                                        <tr class="hover:bg-gray-50">
                                            <td
                                                class="px-6 py-4 text-sm font-medium text-gray-900 sticky left-0 bg-white z-10 border-r border-gray-200">
                                                <div class="font-semibold">{{ $subject->subject->name ?? 'Unknown Subject' }}</div>
                                                <div class="text-xs text-gray-500">{{ $subject->name }}</div>
                                            </td>
                                            @foreach($classSections as $section)
                                                <td class="px-4 py-4 text-center border-l border-gray-300">
                                                    <div class="space-y-2">
                                                        <!-- DEBUG: About to loop through exam details for type {{ $examType->id }} -->
                                                        @php
                                                            try {
                                                                $examDetailsForType = $examDetails[$examType->id] ?? [];
                                                                echo "<!-- DEBUG: Found " . count($examDetailsForType) . " details for type " . $examType->id . " -->";
                                                            } catch (\Exception $e) {
                                                                echo "<!-- DEBUG ERROR: " . $e->getMessage() . " -->";
                                                                $examDetailsForType = [];
                                                            }
                                                        @endphp
                                                        @foreach($examDetailsForType as $examDetail)
                                                            <!-- DEBUG: Processing exam detail {{ $examDetail->id ?? 'NO_ID' }} -->
                                                            @php 
                                                                $classSubjectId = $classSubjects
                                                                    ->where('myclass_id', $selectedClassId)
                                                                    ->where('subject_id', $subject->subject_id)
                                                                    ->first()->id;

                                                                $classSectionId = $classSections
                                                                    ->where('myclass_id', $selectedClassId)                                                                    
                                                                    ->where('section_id', $section->section_id)
                                                                    ->first()->id;

                                                                $answerScriptDistribution = $answerScriptDistributions
                                                                    ->where('exam_detail_id', $examDetail->id)
                                                                    ->where('exam_class_subject_id', $classSubjectId)
                                                                    ->where('myclass_section_id', $classSectionId)
                                                                    ->first();                                                               

                                                            @endphp

                                                            {{-- {{dd($answerScriptDistribution)}} --}}
                                                            <div class="relative">
                                                                <button
                                                                    wire:click="openMarksEntry({{ $examDetail->id ?? 0 }}, {{ $subject->subject_id ?? 0 }}, {{ $section->section_id ?? 0 }})"
                                                                    class="w-full {{ $answerScriptDistribution ? 'bg-green-100 border border-green-300' : 'bg-blue-100 border border-blue-300' }}  rounded p-2 hover:bg-blue-200 transition-colors">
                                                                    <div class="text-xs font-medium text-blue-800">
                                                                        {{ $examDetail->examPart->name ?? 'Unknown Part' }}
                                                                    </div>
                                                                    <div class="text-xs text-blue-600">Enter Marks</div>
                                                                    <div class="text-xs text-gray-400 mt-1">
                                                                        {{-- ExDet:{{ $examDetail->id ?? 'NO_ID' }} 
                                                                        Cls:{{ $selectedClassId ?? 'NO_ID' }}
                                                                        Sub:{{ $subject->subject_id ?? 'NO_ID' }} 
                                                                        Sec:{{ $section->section_id ?? 'NO_ID' }} --}}
                                                                        @if($answerScriptDistribution)
                                                                            <div class="text-semibold text-blue-900 mt-1">
                                                                                Teacher: {{ $answerScriptDistribution->teacher->name ?? 'Unknown Teacher' }}
                                                                            </div>      
                                                                        @endif
                                                                    </div>
                                                                </button>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                            @endforeach

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @elseif($selectedClassId && $selectedExamNameId)
        <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
            <div class="text-lg font-medium mb-2">No exam details found</div>
            <div class="text-sm">Please ensure this class and exam have been configured with exam details.</div>
        </div>
    @elseif($selectedClassId)
        <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
            <div class="text-lg font-medium mb-2">Select an exam to view marks entry options</div>
            <div class="text-sm">Choose an exam from the options above to proceed with marks entry.</div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
            <div class="text-lg font-medium mb-2">Select a class to begin marks entry</div>
            <div class="text-sm">Choose a class from the tabs above to get started.</div>
        </div>
    @endif
</div>