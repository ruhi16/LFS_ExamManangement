<div class="flex-1 p-6 overflow-y-auto max-w-6xl mx-auto">
    <!-- Class Tabs -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8">
            @foreach($classes as $class)
                <button
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
        <div class="p-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Exam Configuration for <span class="text-indigo-600 font-semibold">{{ $classes->firstWhere('id', $selectedClassId)->name }}</span></h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">Select</div>
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4">
                            <div class="flex items-center">Exam Name</div>
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">Configuration</div>
                        </th>
                        <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider w-24">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($examNames as $examName)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 whitespace-nowrap">
                            <input type="checkbox" 
                                   wire:model="selectedExamNames.{{ $selectedClassId }}.{{ $examName->id }}"
                                   class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                            <div class="flex items-center">
                                {{ $examName->name }}
                                @php
                                    $isSelected = isset($selectedExamNames[$selectedClassId][$examName->id]) && $selectedExamNames[$selectedClassId][$examName->id];
                                    $isComplete = $isSelected && $this->isExamConfigurationComplete($selectedClassId, $examName->id);
                                @endphp
                                @if($isSelected)
                                    @if($isComplete)
                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Complete
                                        </span>
                                    @else
                                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Incomplete
                                        </span>
                                    @endif
                                @endif
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">
                            @if(isset($selectedExamNames[$selectedClassId][$examName->id]) && $selectedExamNames[$selectedClassId][$examName->id])
                                <div class="space-y-3 ml-4">
                                    @foreach($examTypes as $examType)
                                        <div>
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" 
                                                       wire:model="selectedExamTypes.{{ $selectedClassId }}.{{ $examName->id }}.{{ $examType->id }}"
                                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                                <span class="ml-2 font-medium">{{ $examType->name }}</span>
                                            </label>
                                            
                                            @if(isset($selectedExamTypes[$selectedClassId][$examName->id][$examType->id]) && $selectedExamTypes[$selectedClassId][$examName->id][$examType->id])
                                                <div class="space-y-2 ml-6 mt-2">
                                                    @foreach($examParts as $examPart)
                                                        <div>
                                                            <label class="inline-flex items-center">
                                                                <input type="checkbox" 
                                                                       wire:model="selectedExamParts.{{ $selectedClassId }}.{{ $examName->id }}.{{ $examType->id }}.{{ $examPart->id }}"
                                                                       class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                                                <span class="ml-2">{{ $examPart->name }}</span>
                                                            </label>
                                                            
                                                            @if(isset($selectedExamParts[$selectedClassId][$examName->id][$examType->id][$examPart->id]) && $selectedExamParts[$selectedClassId][$examName->id][$examType->id][$examPart->id])
                                                                <div class="space-y-2 ml-8 mt-2">
                                                                    <div class="text-xs text-gray-600 mb-1">Select one mode:</div>
                                                                    @foreach($examModes as $examMode)
                                                                        <label class="inline-flex items-center">
                                                                            <input type="radio" 
                                                                                   name="examMode_{{ $selectedClassId }}_{{ $examName->id }}_{{ $examType->id }}_{{ $examPart->id }}"
                                                                                   wire:click="selectExamMode({{ $selectedClassId }}, {{ $examName->id }}, {{ $examType->id }}, {{ $examPart->id }}, {{ $examMode->id }})"
                                                                                   @if(isset($selectedExamModes[$selectedClassId][$examName->id][$examType->id][$examPart->id][$examMode->id]) && $selectedExamModes[$selectedClassId][$examName->id][$examType->id][$examPart->id][$examMode->id]) checked @endif
                                                                                   class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                                                            <span class="ml-2 text-sm">{{ $examMode->name }}</span>
                                                                        </label>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-right text-sm font-medium">
                            @php
                                $isComplete = $this->isExamConfigurationComplete($selectedClassId, $examName->id);
                                $isSelected = isset($selectedExamNames[$selectedClassId][$examName->id]) && $selectedExamNames[$selectedClassId][$examName->id];
                            @endphp
                            <button wire:click="saveExamConfiguration({{ $selectedClassId }}, {{ $examName->id }})"
                                    @if(!$isComplete || !$isSelected) disabled @endif
                                    class="@if($isComplete && $isSelected) bg-indigo-600 hover:bg-indigo-700 @else bg-gray-400 cursor-not-allowed @endif text-white px-3 py-1 rounded text-sm transition-colors">
                                Save
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Bulk Actions -->
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            @php
                $allComplete = $this->areAllExamConfigurationsComplete($selectedClassId);
            @endphp
            <button wire:click="saveAllConfigurations({{ $selectedClassId }})"
                    @if(!$allComplete) disabled @endif
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white @if($allComplete) bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 @else bg-gray-400 cursor-not-allowed @endif transition-colors">
                Save All for {{ $classes->firstWhere('id', $selectedClassId)->name }}
            </button>
        </div>
    </div>
    @else
    <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
        Select a class to configure exam settings
    </div>
    @endif
</div>