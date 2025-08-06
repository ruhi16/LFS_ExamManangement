<div class="flex-1 p-6 overflow-y-auto max-w-full mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Exam Marks & Time Configuration (Simple)</h1>
        <p class="mt-1 text-sm text-gray-600">Configure full marks, pass marks, and time allotted for each subject</p>
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
                <button wire:click="selectClass({{ $class->id }})"
                    class="@if($selectedClassId == $class->id) border-indigo-500 text-indigo-600 @else border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 @endif whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    {{ $class->name }}
                </button>
            @endforeach
        </nav>
    </div>

    <!-- Configuration Panel -->
    @if($selectedClassId && count($subjects) > 0)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">
                    Configure Marks & Time for {{ $classes->firstWhere('id', $selectedClassId)->name }}
                </h3>
            </div>

            <div class="p-6">
                @foreach($subjects as $subject)
                    <div class="mb-8 border-b border-gray-200 pb-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">{{ $subject->subject->name }}</h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($examNames as $examName)
                                @foreach($examTypes as $examType)
                                    @foreach($examParts as $examPart)
                                        @php
                                            $flatKey = "{$subject->subject_id}_{$examName->id}_{$examType->id}_{$examPart->id}";
                                        @endphp
                                        <div class="border border-gray-200 rounded-lg p-4">
                                            <h5 class="font-medium text-sm text-gray-900 mb-3">
                                                {{ $examName->name }} - {{ $examType->name }} - {{ $examPart->name }}
                                            </h5>

                                            <div class="space-y-3">
                                                <!-- Full Marks -->
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-700 mb-1">Full Marks</label>
                                                    <input wire:model.defer="fullMarks.{{ $flatKey }}" type="number" placeholder="100"
                                                        min="1" max="1000"
                                                        class="w-full text-sm border-gray-300 rounded px-3 py-2 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                                </div>

                                                <!-- Pass Marks -->
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-700 mb-1">Pass Marks</label>
                                                    <input wire:model.defer="passMarks.{{ $flatKey }}" type="number" placeholder="40"
                                                        min="1" max="1000"
                                                        class="w-full text-sm border-gray-300 rounded px-3 py-2 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                                </div>

                                                <!-- Time in Minutes -->
                                                <div>
                                                    <label class="block text-xs font-medium text-gray-700 mb-1">Time (Minutes)</label>
                                                    <input wire:model.defer="timeInMinutes.{{ $flatKey }}" type="number" placeholder="60"
                                                        min="1" max="600"
                                                        class="w-full text-sm border-gray-300 rounded px-3 py-2 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
                                                </div>

                                                <!-- Save Button -->
                                                <button
                                                    wire:click="saveConfiguration({{ $subject->subject_id }}, {{ $examName->id }}, {{ $examType->id }}, {{ $examPart->id }})"
                                                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded text-sm font-medium">
                                                    Save Configuration
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @elseif($selectedClassId)
        <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
            <div class="text-lg font-medium mb-2">No subjects found</div>
            <div class="text-sm">No subjects are assigned to this class yet.</div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
            <div class="text-lg font-medium mb-2">Select a class to configure exam settings</div>
            <div class="text-sm">Choose a class from the tabs above to configure exam subject settings.</div>
        </div>
    @endif
</div>