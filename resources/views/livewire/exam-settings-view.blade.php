<div class="flex-1 p-6 overflow-y-auto max-w-6xl mx-auto">
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

    <!-- Exam Configuration View Panel -->
    @if($selectedClassId)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">
                        Exam Configurations for
                        <span
                            class="text-indigo-600 font-semibold">{{ $classes->firstWhere('id', $selectedClassId)->name }}</span>
                    </h3>
                    @php
                        $summary = $this->getConfigurationSummary($selectedClassId);
                    @endphp
                    @if($summary)
                        <div class="flex space-x-4 text-sm">
                            <div class="flex items-center">
                                <span class="w-3 h-3 bg-blue-500 rounded-full mr-2"></span>
                                <span class="text-gray-600">{{ $summary['total'] }} Total</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                                <span class="text-gray-600">{{ $summary['finalized'] }} Finalized</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></span>
                                <span class="text-gray-600">{{ $summary['exam_names'] }} Exam Names</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if(count($examConfigurations) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4">
                                    Exam Name
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Configuration Details
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">
                                    Created By
                                </th>
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">
                                    Created At
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($examConfigurations as $examNameId => $configurations)
                                @php
                                    $firstConfig = $configurations->first();
                                    $examName = $firstConfig->examName;
                                @endphp
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <div class="flex items-center">
                                            {{ $examName->name ?? 'N/A' }}
                                            <span
                                                class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $configurations->count() }} config{{ $configurations->count() > 1 ? 's' : '' }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="px-4 py-3 text-sm text-gray-500">
                                        <div class="space-y-2">
                                            
                                            {{-- @foreach($configurations as $config)
                                                <div class="border-l-2 border-gray-200 pl-3">
                                                    <div class="flex flex-wrap gap-2 text-xs">
                                                        @if($config)
                                                            @if($config->examType)
                                                                <span
                                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                                                    Type: {{ $config->examType ? $config->examType->name : 'X' }}
                                                                </span>
                                                            @endif
                                                            @if($config->examPart)
                                                                <span
                                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                                    Part: {{ $config->examPart ? $config->examPart->name : 'X' }}
                                                                </span>
                                                            @endif
                                                            @if($config->examMode)
                                                                <span
                                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                                                    Mode: {{ $config->examMode ? $config->examMode->name : 'X' }}
                                                                </span>
                                                            @endif
                                                        @endif
                                                    </div>
                                                    @if($config->description)
                                                        <div class="text-xs text-gray-400 mt-1">{{ $config->description }}</div>
                                                    @endif
                                                </div>
                                            @endforeach --}}
                                        </div>
                                    </td>
                                    {{-- <td class="px-4 py-3 whitespace-nowrap">
                                        @if($firstConfig->is_finalized)
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Finalized
                                            </span>
                                        @elseif($firstConfig->is_active)
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Active
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                        {{ $firstConfig->user->name ?? 'System' }}
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                                        {{ $firstConfig->created_at }}
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-6 text-center text-gray-500">
                    <div class="text-lg font-medium mb-2">No exam configurations found</div>
                    <div class="text-sm">No exam configurations have been set up for this class yet.</div>
                </div>
            @endif
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
            <div class="text-lg font-medium mb-2">Select a class to view configurations</div>
            <div class="text-sm">Choose a class from the tabs above to see its exam configurations.</div>
        </div>
    @endif
</div>