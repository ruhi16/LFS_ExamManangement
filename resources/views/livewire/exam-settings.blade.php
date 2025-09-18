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
            <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-md">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-4 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <!-- Class Tabs -->
        <div class="border-b border-gray-200 mb-6">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                @foreach($classes as $class)
                    <button wire:key="class-tab-{{ $class->id }}"
                        wire:click="selectClass({{ $class->id }})"
                        class="{{ $selectedClassId == $class->id ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        {{ $class->name }}
                    </button>
                @endforeach
            </nav>
        </div>

        <!-- Exam Configuration Panel -->
        @if($selectedClassId)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Configuration for <span class="text-indigo-600 font-semibold">{{ $classes->firstWhere('id', $selectedClassId)->name }}</span></h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                @foreach($examNames as $examName)
                                    <th colspan="{{ count($examTypes) }}" class="border border-gray-300 px-4 py-3 text-center text-sm font-medium text-gray-900">
                                        <label class="flex items-center justify-center space-x-2">
                                            <input type="checkbox" wire:model="selectedExamNames.{{ $selectedClassId }}.{{ $examName->id }}" @if($this->isFinalized($selectedClassId, $examName->id)) disabled @endif class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                            <span class="font-semibold">{{ $examName->name }}</span>
                                        </label>
                                    </th>
                                @endforeach
                            </tr>
                            <tr class="bg-gray-100">
                                @foreach($examNames as $examName)
                                    @foreach($examTypes as $examType)
                                        <th class="border border-gray-300 px-2 py-2 text-center text-xs font-medium text-gray-700 min-w-32">
                                            @if(isset($selectedExamNames[$selectedClassId][$examName->id]) && $selectedExamNames[$selectedClassId][$examName->id])
                                                <label class="flex items-center justify-center space-x-1">
                                                    <input type="checkbox" wire:model="selectedExamTypes.{{ $selectedClassId }}.{{ $examName->id }}.{{ $examType->id }}" @if($this->isFinalized($selectedClassId, $examName->id)) disabled @endif class="h-3 w-3 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
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
                                <tr>
                                    @foreach($examNames as $examName)
                                        @foreach($examTypes as $examType)
                                            <td class="border border-gray-300 px-2 py-2 text-center align-top min-w-40">
                                                @if(isset($selectedExamNames[$selectedClassId][$examName->id]) && $selectedExamNames[$selectedClassId][$examName->id] && isset($selectedExamTypes[$selectedClassId][$examName->id][$examType->id]) && $selectedExamTypes[$selectedClassId][$examName->id][$examType->id])
                                                    @if($this->isFinalized($selectedClassId, $examName->id))
                                                        {{-- Elegant Read-only view for finalized exams --}}
                                                        @if(isset($selectedExamParts[$selectedClassId][$examName->id][$examType->id][$examPart->id]) && $selectedExamParts[$selectedClassId][$examName->id][$examType->id][$examPart->id])
                                                            <div class="p-3 bg-slate-50 rounded-lg border border-slate-200 shadow-sm text-center h-full flex flex-col justify-center">
                                                                <div class="flex items-center justify-center">
                                                                    <svg class="h-5 w-5 text-slate-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M7 3.5A1.5 1.5 0 018.5 2h3.879a1.5 1.5 0 011.06.44l3.122 3.121A1.5 1.5 0 0117 6.621V16.5a1.5 1.5 0 01-1.5 1.5h-11A1.5 1.5 0 013 16.5v-13A1.5 1.5 0 014.5 2H6a1.5 1.5 0 011 1.5v1zM8.5 5a.5.5 0 000 1h3a.5.5 0 000-1h-3zM6 9.5A.5.5 0 016.5 9h7a.5.5 0 010 1h-7a.5.5 0 01-.5-.5zm0 2A.5.5 0 016.5 11h7a.5.5 0 010 1h-7a.5.5 0 01-.5-.5zm0 2A.5.5 0 016.5 13h7a.5.5 0 010 1h-7a.5.5 0 01-.5-.5z" /></svg>
                                                                    <p class="font-bold text-md text-slate-700">{{ $examPart->name }}</p>
                                                                </div>
                                                                @php
                                                                    $selectedModeId = null;
                                                                    if(isset($selectedExamModes[$selectedClassId][$examName->id][$examType->id][$examPart->id])) {
                                                                        $selectedModeId = array_search(true, $selectedExamModes[$selectedClassId][$examName->id][$examType->id][$examPart->id], true);
                                                                    }
                                                                    $modeName = $selectedModeId ? ($examModes->firstWhere('id', $selectedModeId)->name ?? 'N/A') : 'N/A';
                                                                @endphp
                                                                @if($selectedModeId)
                                                                    <div class="mt-3 inline-flex items-center bg-teal-100 text-teal-800 text-xs font-semibold px-3 py-1 rounded-full">
                                                                        <svg class="h-4 w-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                                        {{ $modeName }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    @else
                                                        {{-- Editable configuration UI --}}
                                                        <div class="w-full p-2 flex flex-col items-center">
                                                            <label class="flex items-center space-x-2 bg-blue-50 px-3 py-1 rounded-md border border-blue-200 mb-3">
                                                                <input type="checkbox" wire:model="selectedExamParts.{{ $selectedClassId }}.{{ $examName->id }}.{{ $examType->id }}.{{ $examPart->id }}" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                                                <span class="text-sm font-semibold text-blue-800">{{ $examPart->name }}</span>
                                                            </label>
                                                            @if(isset($selectedExamParts[$selectedClassId][$examName->id][$examType->id][$examPart->id]) && $selectedExamParts[$selectedClassId][$examName->id][$examType->id][$examPart->id])
                                                                <div class="bg-green-50 border border-green-200 rounded-md p-2 space-y-1">
                                                                    <div class="text-xs text-green-700 font-medium text-center mb-1">Select Mode:</div>
                                                                    @foreach($examModes as $examMode)
                                                                        <label class="flex items-center justify-center space-x-2 text-xs hover:bg-green-100 p-1 rounded">
                                                                            <input type="radio" name="examMode_{{ $selectedClassId }}_{{ $examName->id }}_{{ $examType->id }}_{{ $examPart->id }}" wire:click="selectExamMode({{ $selectedClassId }}, {{ $examName->id }}, {{ $examType->id }}, {{ $examPart->id }}, {{ $examMode->id }})" @if(isset($selectedExamModes[$selectedClassId][$examName->id][$examType->id][$examPart->id][$examMode->id]) && $selectedExamModes[$selectedClassId][$examName->id][$examType->id][$examPart->id][$examMode->id]) checked @endif class="h-3 w-3 text-green-600 focus:ring-green-500 border-gray-300">
                                                                            <span class="text-green-800 font-medium">{{ $examMode->name }}</span>
                                                                        </label>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @else
                                                    <div class="w-full p-2 flex justify-center">
                                                        <span class="text-sm text-gray-400 bg-gray-100 px-3 py-1 rounded-md border border-gray-200">{{ $examPart->name }}</span>
                                                    </div>
                                                @endif
                                            </td>
                                        @endforeach
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50 border-t-2 border-gray-300">
                            <tr>
                                @foreach($examNames as $examName)
                                    <td colspan="{{ count($examTypes) }}" class="px-4 py-3 text-center">
                                        @if($this->isFinalized($selectedClassId, $examName->id))
                                            <span class="text-green-600 font-semibold p-2 bg-green-100 border border-green-200 rounded-md">Structure Finalized</span>
                                        @else
                                            <div class="flex justify-center space-x-2">
                                                <button wire:key="save-btn-{{ $examName->id }}" wire:click="saveExamConfiguration({{ $selectedClassId }}, {{ $examName->id }})" @if($this->isSaveDisabled($selectedClassId, $examName->id)) disabled @endif class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-sm transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed">
                                                    Save
                                                </button>
                                                <button wire:click="finalizeConfiguration({{ $selectedClassId }}, {{ $examName->id }})" wire:confirm="Are you sure? This will lock the exam structure." @if($this->isSaveDisabled($selectedClassId, $examName->id)) disabled @endif class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed">
                                                    Finalize
                                                </button>
                                            </div>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
                <p class="text-lg font-medium">Select a class to begin configuring exams.</p>
            </div>
        @endif
    </div>
</div>
