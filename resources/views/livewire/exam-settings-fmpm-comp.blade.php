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

    <!-- Exam Configuration Panel -->
    @if($selectedClassId)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">
                    Exam Configuration for
                    <span
                        class="text-indigo-600 font-semibold">{{ $classes->firstWhere('id', $selectedClassId)->name }}</span>
                </h3>
            </div>

            @if(count($examConfigurations) > 0)
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
                                <th scope="col"
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-24">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($examConfigurations as $subjectId => $subjectData)
                                <tr class="hover:bg-gray-50">
                                    <td
                                        class="px-4 py-3 text-sm font-medium text-gray-900 sticky left-0 bg-white z-10 border-r border-gray-200">
                                        <div class="flex flex-col">
                                            <span class="font-semibold">{{ $subjectData['subject']->name }}</span>
                                            <span class="text-xs text-gray-500">{{ $subjectData['classSubject']->name }}</span>
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
                                                                    $flatKey = $subjectId . '_' . $examName->id . '_' . $examType->id . '_' . $examPart->id;
                                                                    $configKey = $examName->id . '_' . $examType->id . '_' . $examPart->id;
                                                                    $isEnabled = isset($activeExamConfigs[$configKey]);
                                                                @endphp
                                                                <div
                                                                    class="border border-gray-100 p-1 min-w-0 {{ $isEnabled ? 'bg-white' : 'bg-gray-50' }}">
                                                                    @if($isEnabled)
                                                                        <!-- Full Marks -->
                                                                        <input wire:model="fullMarks.{{ $flatKey }}" type="number" placeholder="FM"
                                                                            min="1" max="1000"
                                                                            class="w-full text-xs border-gray-300 rounded px-1 py-0.5 mb-1 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">

                                                                        <!-- Pass Marks -->
                                                                        <input wire:model="passMarks.{{ $flatKey }}" type="number" placeholder="PM"
                                                                            min="1" max="1000"
                                                                            class="w-full text-xs border-gray-300 rounded px-1 py-0.5 mb-1 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">

                                                                        <!-- Time in Minutes -->
                                                                        <input wire:model="timeInMinutes.{{ $flatKey }}" type="number"
                                                                            placeholder="Time" min="1" max="600"
                                                                            class="w-full text-xs border-gray-300 rounded px-1 py-0.5 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500">
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
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex flex-col space-y-1">
                                            @foreach($examNames as $examName)
                                                @foreach($examTypes as $examType)
                                                    @foreach($examParts as $examPart)
                                                        @php
                                                            $flatKey = $subjectId . '_' . $examName->id . '_' . $examType->id . '_' . $examPart->id;
                                                            $configKey = $examName->id . '_' . $examType->id . '_' . $examPart->id;
                                                            $isEnabled = isset($activeExamConfigs[$configKey]);
                                                            $hasData = ($fullMarks[$flatKey] ?? '') || ($passMarks[$flatKey] ?? '') || ($timeInMinutes[$flatKey] ?? '');
                                                        @endphp
                                                        @if($isEnabled && $hasData)
                                                            <div class="flex space-x-1">
                                                                <button
                                                                    wire:click="saveConfiguration({{ $subjectId }}, {{ $examName->id }}, {{ $examType->id }}, {{ $examPart->id }})"
                                                                    class="bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded text-xs">
                                                                    Save
                                                                </button>
                                                                @if($configIds[$flatKey] ?? null)
                                                                    <button
                                                                        wire:click="deleteConfiguration({{ $subjectId }}, {{ $examName->id }}, {{ $examType->id }}, {{ $examPart->id }})"
                                                                        class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-xs">
                                                                        Del
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
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