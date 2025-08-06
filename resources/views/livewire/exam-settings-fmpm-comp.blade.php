<div class="flex-1 p-6 overflow-y-auto max-w-full mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Exam Marks & Time Configuration</h1>
                <p class="mt-1 text-sm text-gray-600">Configure full marks, pass marks, and time allotted for each
                    subject by exam terms and parts</p>
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

    <!-- Debug Panel (remove in production) -->
    <div class="mb-4 p-4 bg-yellow-50 border border-yellow-200 rounded-md">
        <h4 class="text-sm font-medium text-yellow-800 mb-2">Debug Panel</h4>
        <div class="flex space-x-2">
            <button wire:click="checkDatabaseConnection" class="bg-blue-500 text-white px-3 py-1 rounded text-xs">
                Test DB Connection
            </button>
            <button wire:click="testSave" class="bg-green-500 text-white px-3 py-1 rounded text-xs">
                Test Save
            </button>
            <button wire:click="refreshData" class="bg-purple-500 text-white px-3 py-1 rounded text-xs">
                Refresh Data
            </button>
            <button wire:click="debugSave(1, 1, 1, 1)" class="bg-orange-500 text-white px-3 py-1 rounded text-xs">
                Debug Save
            </button>
            <button wire:click="testClick" class="bg-red-500 text-white px-3 py-1 rounded text-xs">
                Test Click
            </button>
            <button wire:click="testDataLoad" class="bg-yellow-500 text-white px-3 py-1 rounded text-xs">
                Test Data Load
            </button>
        </div>
        <div class="mt-2 text-xs text-yellow-700">
            Selected Class: {{ $selectedClassId ?? 'None' }} |
            Configurations: {{ is_array($examConfigurations) ? count($examConfigurations) : 0 }} |
            Classes: {{ $this->classes ? count($this->classes) : 0 }}
        </div>
    </div>

    <!-- Class Tabs -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8">
            @if($this->classes && count($this->classes) > 0)
                @foreach($this->classes as $class)
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

    <!-- Exam Configuration Panel -->
    @if($selectedClassId)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">
                    Exam Configuration for
                    <span class="text-indigo-600 font-semibold">
                        @if($this->classes && $selectedClassId)
                            {{ $this->classes->firstWhere('id', $selectedClassId)->name ?? 'Unknown Class' }}
                        @else
                            Selected Class
                        @endif
                    </span>
                </h3>
            </div>

            @if(is_array($examConfigurations) && count($examConfigurations) > 0)
                <!-- Debug Info (remove in production) -->
                {{-- <div class="p-2 bg-yellow-50 text-xs text-gray-600 mb-4">
                    Debug: {{ is_array($examConfigurations) ? count($examConfigurations) : 0 }} subjects, {{
                    is_array($activeExamConfigs) ? count($activeExamConfigs) : 0 }} active exam configs
                </div> --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-48 sticky left-0 bg-gray-50 z-10">
                                    Subject
                                </th>
                                @foreach($examNames as $examName)
                                    <th scope="col"
                                        class="px-2 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-l border-gray-300">
                                        <div class="min-w-0">{{ $examName->name }}</div>
                                        <div class="grid grid-cols-{{ count($examTypes) }} gap-0 mt-1">
                                            @foreach($examTypes as $examType)
                                                <div class="text-center border-r border-gray-200 last:border-r-0">
                                                    <div class="text-xs font-medium text-gray-600 mb-1">{{ $examType->name }}</div>
                                                    <div class="grid grid-cols-{{ count($examParts) }} gap-0">
                                                        @foreach($examParts as $examPart)
                                                            <div
                                                                class="text-xs text-gray-500 px-1 border-r border-gray-100 last:border-r-0">
                                                                {{ $examPart->name }}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if(is_array($examConfigurations))
                                @foreach($examConfigurations as $subjectId => $subjectData)
                                    <tr class="hover:bg-gray-50">
                                        <td
                                            class="px-4 py-3 text-sm font-medium text-gray-900 sticky left-0 bg-white z-10 border-r border-gray-200">
                                            <div class="flex flex-col">
                                                <span class="font-semibold">{{ $subjectData['subject_name'] }}</span>
                                                <span class="text-xs text-gray-500">{{ $subjectData['class_subject_name'] }}</span>
                                            </div>
                                        </td>
                                        @foreach($examNames as $examName)
                                            <td class="px-2 py-3 text-sm text-gray-500 border-l border-gray-300">
                                                <div class="grid grid-cols-{{ count($examTypes) }} gap-1">
                                                    @foreach($examTypes as $examType)
                                                        <div class="border-r border-gray-200 last:border-r-0 pr-1">
                                                            <div class="grid grid-cols-{{ count($examParts) }} gap-1">
                                                                @foreach($examParts as $examPart)
                                                                    @php
                                                                        $flatKey = "{$subjectId}_{$examName->id}_{$examType->id}_{$examPart->id}";
                                                                        $configKey = "{$examName->id}_{$examType->id}_{$examPart->id}";
                                                                        $isEnabled = isset($activeExamConfigs[$configKey]);
                                                                        $fullMarksValue = $fullMarks[$flatKey] ?? '';
                                                                        $passMarksValue = $passMarks[$flatKey] ?? '';
                                                                        $timeValue = $timeInMinutes[$flatKey] ?? '';
                                                                        $configId = $configIds[$flatKey] ?? null;
                                                                    @endphp
                                                                    <div
                                                                        class="border border-gray-100 p-1 min-w-0 {{ $isEnabled ? 'bg-white' : 'bg-gray-50' }}">
                                                                        @if($isEnabled)
                                                                            <!-- Full Marks -->
                                                                            <input wire:model="fullMarks.{{ $flatKey }}" type="number" placeholder="FM"
                                                                                min="1" max="1000" value="{{ $fullMarksValue }}"
                                                                                class="w-full text-xs border-gray-300 rounded px-1 py-0.5 mb-1 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">

                                                                            <!-- Pass Marks -->
                                                                            <input wire:model="passMarks.{{ $flatKey }}" type="number" placeholder="PM"
                                                                                min="1" max="1000" value="{{ $passMarksValue }}"
                                                                                class="w-full text-xs border-gray-300 rounded px-1 py-0.5 mb-1 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">

                                                                            <!-- Time in Minutes -->
                                                                            <input wire:model="timeInMinutes.{{ $flatKey }}" type="number"
                                                                                placeholder="Time" min="1" max="600" value="{{ $timeValue }}"
                                                                                class="w-full text-xs border-gray-300 rounded px-1 py-0.5 mb-1 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">

                                                                            <!-- Save Button at bottom of input fields -->
                                                                            @if($this->hasData($subjectId, $examName->id, $examType->id, $examPart->id))
                                                                                <!-- Debug info -->
                                                                                <div class="text-xs text-gray-500 mb-1">
                                                                                    Params:
                                                                                    {{ $subjectId }}-{{ $examName->id }}-{{ $examType->id }}-{{ $examPart->id }}
                                                                                </div>
                                                                                <button
                                                                                    wire:click="saveConfiguration({{ $subjectId }}, {{ $examName->id }}, {{ $examType->id }}, {{ $examPart->id }})"
                                                                                    type="button"
                                                                                    class="w-full bg-green-600 hover:bg-green-700 text-white px-1 py-0.5 rounded text-xs mb-1">
                                                                                    {{ $configId ? 'Update' : 'Save' }}
                                                                                </button>
                                                                                <!-- Test button with hardcoded values -->
                                                                                <button wire:click="saveConfiguration(1, 1, 1, 1)" type="button"
                                                                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white px-1 py-0.5 rounded text-xs mb-1">
                                                                                    Test Save
                                                                                </button>
                                                                            @else
                                                                                <button type="button" disabled
                                                                                    class="w-full bg-gray-300 text-gray-500 px-1 py-0.5 rounded text-xs mb-1 cursor-not-allowed">
                                                                                    Enter Data
                                                                                </button>
                                                                            @endif

                                                                            <!-- Delete Button (if config exists) -->
                                                                            @if($configId)
                                                                                <button
                                                                                    wire:click="deleteConfiguration({{ $subjectId }}, {{ $examName->id }}, {{ $examType->id }}, {{ $examPart->id }})"
                                                                                    onclick="return confirm('Delete this configuration?')"
                                                                                    class="w-full bg-red-600 hover:bg-red-700 text-white px-1 py-0.5 rounded text-xs">
                                                                                    Delete
                                                                                </button>
                                                                            @endif
                                                                        @else
                                                                            <!-- Disabled state -->
                                                                            <div class="w-full text-xs text-gray-400 text-center py-2">
                                                                                <div class="text-xs">Not</div>
                                                                                <div class="text-xs">Configured</div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-6 text-center text-gray-500">
                    <div class="text-lg font-medium mb-2">No subjects found</div>
                    <div class="text-sm">No subjects are assigned to this class yet.</div>
                </div>
            @endif
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
            <div class="text-lg font-medium mb-2">Select a class to configure exam settings</div>
            <div class="text-sm">Choose a class from the tabs above to configure exam subject settings.</div>
        </div>
    @endif
</div>