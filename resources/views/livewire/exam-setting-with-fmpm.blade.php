<div class="p-6 bg-gray-50 min-h-screen">
    {{-- Header Section --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-900">Exam Setting with Full Marks, Pass Marks & Time</h1>
            <p class="text-sm text-gray-600 mt-1">Configure exam subjects with marks and time allocation</p>
        </div>

        {{-- Class Selection Section --}}
        <div class="p-6">
            <div class="mb-4">
                <label for="class-select" class="block text-sm font-medium text-gray-700 mb-2">
                    Select Class
                </label>
                <select id="class-select" wire:model="selectedClassId"
                    class="w-full md:w-1/3 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Choose a class...</option>
                    @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- Success/Error Messages --}}
    @if (session()->has('success'))
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd"></path>
            </svg>
            {{ session('success') }}
        </div>
    </div>
    @endif

    @if (session()->has('error'))
    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 002 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
            {{ session('error') }}
        </div>
    </div>
    @endif

    {{-- Main Content Section --}}
    @if($selectedClassId && count($examDetails) > 0)
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Exam Configuration Matrix</h2>
                    <p class="text-sm text-gray-600 mt-1">
                        Configure subjects for each exam type
                        @if($isFinalized)
                        <span
                            class="inline-flex items-center px-2 py-1 ml-2 bg-red-100 border border-red-300 rounded-md">
                            <svg class="w-4 h-4 mr-1 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-red-800 text-xs font-medium">FINALIZED - Data Locked</span>
                        </span>
                        @endif
                    </p>
                </div>

                @if(!$isFinalized)
                <div class="flex items-center space-x-3">
                    <div class="text-sm text-gray-600">
                        @if($this->canFinalize())
                        <span
                            class="inline-flex items-center px-2 py-1 bg-green-100 border border-green-300 rounded-md">
                            <svg class="w-4 h-4 mr-1 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-green-800 text-xs font-medium">Ready to Finalize</span>
                        </span>
                        @else
                        <span
                            class="inline-flex items-center px-2 py-1 bg-yellow-100 border border-yellow-300 rounded-md">
                            <svg class="w-4 h-4 mr-1 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-yellow-800 text-xs font-medium">Complete All Data to Finalize</span>
                        </span>
                        @endif
                    </div>

                    <button wire:click="finalizeClass" @if(!$this->canFinalize()) disabled @endif
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 disabled:bg-gray-300
                        disabled:cursor-not-allowed text-white text-sm font-medium rounded-md transition-colors
                        duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Finalize Class
                    </button>
                </div>
                @endif
            </div>
        </div>

        <div class="p-6">
            {{-- Exam Matrix Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300">
                    <thead>
                        {{-- Exam Names Row --}}
                        <tr class="bg-blue-50">
                            <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold text-gray-900">
                                Subject Types / Exams
                            </th>
                            @foreach($examNames as $examName)
                            @php
                            $examDetailsForName = $examDetails->where('exam_name_id', $examName->id);
                            $examTypesForName = $examDetailsForName->groupBy('exam_type_id');
                            $totalPartsForName = 0;
                            foreach($examTypesForName as $examTypeGroup) {
                            $totalPartsForName += $examTypeGroup->count();
                            }
                            @endphp
                            <th class="border border-gray-300 px-4 py-3 text-center text-sm font-semibold text-gray-900"
                                colspan="{{ $totalPartsForName }}">
                                {{ $examName->name }}
                            </th>
                            @endforeach
                        </tr>

                        {{-- Exam Types Row --}}
                        <tr class="bg-blue-100">
                            <th class="border border-gray-300 px-4 py-2 text-left text-xs font-medium text-gray-700">
                                Subjects
                            </th>
                            @foreach($examNames as $examName)
                            @php
                            $examDetailsForName = $examDetails->where('exam_name_id', $examName->id);
                            $examTypesForName = $examDetailsForName->groupBy('exam_type_id');
                            @endphp
                            @foreach($examTypesForName as $examTypeId => $examTypeGroup)
                            @php
                            $examType = $examTypeGroup->first()->examType;
                            $partsCount = $examTypeGroup->count();
                            @endphp
                            <th class="border border-gray-300 px-2 py-2 text-center text-xs font-medium text-gray-700"
                                colspan="{{ $partsCount }}">
                                {{ $examType->name }}
                            </th>
                            @endforeach
                            @endforeach
                        </tr>

                        {{-- Exam Parts Row with ExamMode --}}
                        <tr class="bg-blue-25">
                            <th class="border border-gray-300 px-4 py-1 text-left text-xs font-medium text-gray-600">
                                Parts (Mode)
                            </th>
                            @foreach($examNames as $examName)
                            @php
                            $examDetailsForName = $examDetails->where('exam_name_id', $examName->id);
                            $examTypesForName = $examDetailsForName->groupBy('exam_type_id');
                            @endphp
                            @foreach($examTypesForName as $examTypeId => $examTypeGroup)
                            @foreach($examTypeGroup as $examDetail)
                            <th class="border border-gray-300 px-1 py-1 text-center text-xs font-medium text-gray-600">
                                @if($examDetail->examPart && $examDetail->examMode)
                                {{ $examDetail->examPart->name }}<br><span class="text-xs text-gray-500">({{
                                    $examDetail->examMode->name }})</span>
                                @else
                                {{ $examDetail->examPart ? $examDetail->examPart->name : 'N/A' }}
                                @endif
                            </th>
                            @endforeach
                            @endforeach
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subjectTypes as $subjectType)
                        @php
                        $subjectsOfType = $this->getSubjectsByType($subjectType->id);
                        @endphp
                        @if($subjectsOfType->count() > 0)
                        {{-- Subject Type Header --}}
                        <tr class="bg-gray-100">
                            @php
                            $totalCols = 1; // Start with 1 for the subject name column
                            foreach($examNames as $examName) {
                            $examDetailsForName = $examDetails->where('exam_name_id', $examName->id);
                            $examTypesForName = $examDetailsForName->groupBy('exam_type_id');
                            foreach($examTypesForName as $examTypeGroup) {
                            $totalCols += $examTypeGroup->count();
                            }
                            }
                            @endphp
                            <td class="border border-gray-300 px-4 py-2 font-semibold text-gray-800"
                                colspan="{{ $totalCols }}">
                                {{ $subjectType->name }}
                            </td>
                        </tr>

                        {{-- Subjects Rows --}}
                        @foreach($subjectsOfType as $myclassSubject)
                        @if($myclassSubject->subject) {{-- Add null check --}}
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2 text-sm text-gray-700">
                                {{ $myclassSubject->subject->name }}
                            </td>

                            @foreach($examNames as $examName)
                            @php
                            $examDetailsForName = $examDetails->where('exam_name_id', $examName->id);
                            $examTypesForName = $examDetailsForName->groupBy('exam_type_id');
                            @endphp
                            @foreach($examTypesForName as $examTypeId => $examTypeGroup)
                            @foreach($examTypeGroup as $examDetail)
                            @php
                            $key = $examDetail->id . '_' . $myclassSubject->subject_id;
                            $isSelected = isset($selectedSubjects[$key]) && $selectedSubjects[$key];
                            // Check if this subject type is enabled for this exam detail
                            $isEnabled = $this->isSubjectTypeEnabledForExam($subjectType->id, $examDetail);
                            @endphp
                            <td
                                class="border border-gray-300 px-2 py-2 text-center {{ !$isEnabled ? 'bg-gray-100' : '' }} {{ $isFinalized ? 'bg-gray-50' : '' }}">
                                @if($isEnabled)
                                <div class="space-y-2">
                                    {{-- Checkbox --}}
                                    @if(!$isFinalized)
                                    <div>
                                        <input type="checkbox"
                                            wire:click="toggleSubject({{ $examDetail->id }}, {{ $myclassSubject->subject_id }})"
                                            {{ $isSelected ? 'checked' : '' }}
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    </div>
                                    @else
                                    <div>
                                        <input type="checkbox" {{ $isSelected ? 'checked' : '' }} disabled
                                            class="h-4 w-4 text-gray-400 border-gray-300 rounded cursor-not-allowed">
                                    </div>
                                    @endif

                                    {{-- Input Fields --}}
                                    @if($isSelected)
                                    <div class="space-y-1">
                                        {{-- Full Marks --}}
                                        <input type="number" wire:model.lazy="fullMarks.{{ $key }}"
                                            placeholder="Full Marks" {{ $isFinalized ? 'disabled' : '' }}
                                            class="w-full text-xs px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 {{ $isFinalized ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                            min="0">

                                        {{-- Pass Marks --}}
                                        <input type="number" wire:model.lazy="passMarks.{{ $key }}"
                                            placeholder="Pass Marks" {{ $isFinalized ? 'disabled' : '' }}
                                            class="w-full text-xs px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 {{ $isFinalized ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                            min="0">

                                        {{-- Time Allotted --}}
                                        <input type="number" wire:model.lazy="timeAllotted.{{ $key }}"
                                            placeholder="Time (min)" {{ $isFinalized ? 'disabled' : '' }}
                                            class="w-full text-xs px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500 {{ $isFinalized ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                            min="0">
                                    </div>
                                    @endif
                                </div>
                                @else
                                <div class="text-xs text-gray-400 py-2">
                                    <span class="inline-block px-2 py-1 bg-gray-200 rounded text-gray-600">Not
                                        Available</span>
                                </div>
                                @endif
                            </td>
                            @endforeach
                            @endforeach
                            @endforeach
                        </tr>
                        @endif {{-- End null check for subject --}}
                        @endforeach
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @elseif($selectedClassId)
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6 text-center">
            <div class="text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No Exam Details Found</h3>
                <p class="mt-1 text-sm text-gray-500">
                    No exam details are configured for the selected class. Please configure exam details first.
                </p>
            </div>
        </div>
    </div>
    @else
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6 text-center">
            <div class="text-gray-500">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Select a Class</h3>
                <p class="mt-1 text-sm text-gray-500">
                    Please select a class from the dropdown above to configure exam settings.
                </p>
            </div>
        </div>
    </div>
    @endif

    {{-- Success Message --}}
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('saved', message => {
                // Simple notification - you can replace with a more sophisticated notification system
                const notification = document.createElement('div');
                notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
                notification.textContent = message;
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.remove();
                }, 3000);
            });
        });
    </script>
</div>