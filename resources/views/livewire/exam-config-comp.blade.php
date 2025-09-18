<div>
    <div class="flex-1 p-6 overflow-y-auto max-w-full mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">Exam Configuration</h1>
                    <p class="mt-1 text-sm text-gray-600">Define which exams, types, parts, and modes are active for each class.</p>
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
                @foreach($classes as $class)
                    <button wire:key="class-tab-{{ $class->id }}"
                        wire:click="selectClass({{ $class->id }})"
                        class="@if($selectedClassId == $class->id) border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm"
                    >
                        {{ $class->name }}
                    </button>
                @endforeach
            </nav>
        </div>

        <!-- Exam Configuration Panel -->
        @if($selectedClassId)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Configuration for <span class="text-indigo-600 font-semibold">{{ $classes->firstWhere('id', $selectedClassId)->name }}</span></h3>
                    <div class="flex space-x-2">
                        @foreach($examNames as $examName)
                            <button wire:key="save-btn-{{ $examName->id }}" wire:click="saveExamConfiguration({{ $selectedClassId }}, {{ $examName->id }})"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-sm transition-colors">
                                Save {{ $examName->name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead>
                            <!-- Header Row 1: Exam Names with Checkboxes -->
                            <tr class="bg-gray-50">
                                @foreach($examNames as $examName)
                                    <th wire:key="th-exam-name-{{ $examName->id }}" colspan="{{ count($examTypes) }}" class="border border-gray-300 px-4 py-3 text-center text-sm font-medium text-gray-900">
                                        <label class="flex items-center justify-center space-x-2">
                                            <input type="checkbox"
                                                   wire:model="selectedExamNames.{{ $selectedClassId }}.{{ $examName->id }}"
                                                   class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                            <span class="font-semibold">{{ $examName->name }}</span>
                                        </label>
                                    </th>
                                @endforeach
                            </tr>
                            
                            <!-- Header Row 2: Exam Types with Checkboxes -->
                            <tr class="bg-gray-100">
                                @foreach($examNames as $examName)
                                    @foreach($examTypes as $examType)
                                        <th wire:key="th-exam-type-{{ $examName->id }}-{{ $examType->id }}" class="border border-gray-300 px-2 py-2 text-center text-xs font-medium text-gray-700 min-w-32">
                                            @if(isset($selectedExamNames[$selectedClassId][$examName->id]) && $selectedExamNames[$selectedClassId][$examName->id])
                                                <label class="flex items-center justify-center space-x-1">
                                                    <input type="checkbox"
                                                           wire:model="selectedExamTypes.{{ $selectedClassId }}.{{ $examName->id }}.{{ $examType->id }}"
                                                           class="h-3 w-3 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                                    <span class="text-xs font-medium">{{ $examType->name }}</span>
                                                </label>
                                            @else
                                                <span class="text-xs text-gray-400">{{ $examType->name }}</span>
                                            @endif
                                        </th>
                                    @endforeach
                                @endforeach
                            </tr>
                        </thead>

                        <tbody class="bg-white">
                            @foreach($examParts as $examPart)
                                <tr wire:key="part-row-{{ $examPart->id }}" class="hover:bg-gray-50">
                                    @foreach($examNames as $examName)
                                        @foreach($examTypes as $examType)
                                            <td wire:key="cell-{{ $examPart->id }}-{{ $examName->id }}-{{ $examType->id }}" class="border border-gray-300 px-1 py-2 text-center align-top min-w-40">
                                                @if(isset($selectedExamNames[$selectedClassId][$examName->id]) && $selectedExamNames[$selectedClassId][$examName->id] &&
                                                    isset($selectedExamTypes[$selectedClassId][$examName->id][$examType->id]) && $selectedExamTypes[$selectedClassId][$examName->id][$examType->id])

                                                    <div class="w-full p-2 flex flex-col items-center">
                                                        <!-- Part Name with Checkbox - Center Aligned -->
                                                        <div class="flex items-center justify-center mb-3">
                                                            <label class="flex items-center space-x-2 bg-blue-50 px-3 py-1 rounded-md border border-blue-200">
                                                                <input type="checkbox"
                                                                       id="part-{{ $selectedClassId }}-{{ $examName->id }}-{{ $examType->id }}-{{ $examPart->id }}"
                                                                       wire:model="selectedExamParts.{{ $selectedClassId }}.{{ $examName->id }}.{{ $examType->id }}.{{ $examPart->id }}"
                                                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                                                <span class="text-sm font-semibold text-blue-800">{{ $examPart->name }}</span>
                                                            </label>
                                                        </div>
                                                        
                                                        <!-- Mode Radio Buttons - Center Aligned with Different Styling -->
                                                        @if(isset($selectedExamParts[$selectedClassId][$examName->id][$examType->id][$examPart->id]) && $selectedExamParts[$selectedClassId][$examName->id][$examType->id][$examPart->id])
                                                            <div class="flex justify-center">
                                                                <div class="bg-green-50 border border-green-200 rounded-md p-2 space-y-1">
                                                                    <div class="text-xs text-green-700 font-medium text-center mb-1">Select Mode:</div>
                                                                    @foreach($examModes as $examMode)
                                                                        <label wire:key="mode-label-{{ $examPart->id }}-{{ $examName->id }}-{{ $examType->id }}-{{ $examMode->id }}" class="flex items-center justify-center space-x-2 text-xs hover:bg-green-100 p-1 rounded">
                                                                            <input type="radio"
                                                                                   name="examMode_{{ $selectedClassId }}_{{ $examName->id }}_{{ $examType->id }}_{{ $examPart->id }}"
                                                                                   wire:click="selectExamMode({{ $selectedClassId }}, {{ $examName->id }}, {{ $examType->id }}, {{ $examPart->id }}, {{ $examMode->id }})"
                                                                                   @if(isset($selectedExamModes[$selectedClassId][$examName->id][$examType->id][$examPart->id][$examMode->id]) && $selectedExamModes[$selectedClassId][$examName->id][$examType->id][$examPart->id][$examMode->id]) checked @endif
                                                                                   class="h-3 w-3 text-green-600 focus:ring-green-500 border-gray-300">
                                                                            <span class="text-green-800 font-medium">{{ $examMode->name }}</span>
                                                                        </label>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        @endif

                                                        <!-- Subject Selection -->
                                                        @if(isset($selectedExamParts[$selectedClassId][$examName->id][$examType->id][$examPart->id]) && $selectedExamParts[$selectedClassId][$examName->id][$examType->id][$examPart->id])
                                                            <div class="mt-4 w-full border-t border-gray-200 pt-2">
                                                                <div class="text-xs text-gray-600 font-medium mb-2 text-center">Select Subjects:</div>
                                                                @if(!empty($subjectsGrouped))
                                                                    @foreach($subjectsGrouped as $subjectTypeName => $myclassSubjects)
                                                                        <div wire:key="subject-group-{{ \Illuminate\Support\Str::slug($subjectTypeName ?: 'uncategorized') }}" class="mb-2 text-left">
                                                                            <div class="font-semibold text-xs text-gray-700 bg-gray-100 p-1 rounded">{{ $subjectTypeName ?: 'Uncategorized' }}</div>
                                                                            <div class="pl-2 mt-1 space-y-1">
                                                                                @foreach($myclassSubjects as $myclassSubject)
                                                                                    @if($myclassSubject->subject)
                                                                                        <label wire:key="subject-label-{{ $myclassSubject->id }}-{{ $examPart->id }}-{{ $examName->id }}-{{ $examType->id }}" class="flex items-center space-x-2 text-xs">
                                                                                            <input type="checkbox"
                                                                                                   wire:model.defer="selectedSubjects.{{ $selectedClassId }}.{{ $examName->id }}.{{ $examType->id }}.{{ $examPart->id }}.{{ $myclassSubject->subject->id }}"
                                                                                                   class="h-3 w-3 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                                                                            <span class="text-gray-800">{{ $myclassSubject->subject->name }}</span>
                                                                                        </label>
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @endif

                                                                
                                                            </div>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="w-full p-2 flex justify-center">
                                                        <!-- Disabled Part Name - Center Aligned -->
                                                        <span class="text-sm text-gray-400 bg-gray-100 px-3 py-1 rounded-md border border-gray-200">{{ $examPart->name }}</span>
                                                    </div>
                                                @endif
                                            </td>
                                        @endforeach
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Legend -->
                <div class="p-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-gray-600">
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" checked class="h-3 w-3" disabled>
                            <span>Enable Part</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="radio" checked class="h-3 w-3" disabled>
                            <span>Select Mode</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" checked class="h-3 w-3 text-purple-600" disabled>
                            <span>Select Subject</span>
                        </div>
                        <div class="text-xs text-gray-500">
                            Click part checkbox to enable, then select mode from radio buttons below
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
                <div class="text-lg font-medium mb-2">Select a class to begin</div>
                <p class="text-sm">Choose a class from the tabs above to configure its exam settings.</p>
            </div>
        @endif
    </div>
</div>