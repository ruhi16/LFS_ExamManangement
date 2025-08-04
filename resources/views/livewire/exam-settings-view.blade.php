<div class="flex-1 p-6 overflow-y-auto max-w-6xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Exam Setting Configuration View</h1>
                <p class="mt-1 text-sm text-gray-600">Manage school exam and their configurations view</p>
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
                @php
                    $allExamTypes = $this->getAllExamTypes();
                @endphp
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center">Exam Name</div>
                                </th>
                                @foreach($allExamTypes as $examType)
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <div class="flex items-center">{{ $examType->name }}</div>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($examConfigurations as $examNameId => $examData)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $examData['examName']->name ?? 'N/A' }}
                                    </td>
                                    @foreach($allExamTypes as $examType)
                                        <td class="px-4 py-3 text-sm text-gray-500">
                                            @if(isset($examData['types'][$examType->id]))
                                                @php
                                                    $typeData = $examData['types'][$examType->id];
                                                @endphp
                                                <div class="space-y-1">
                                                    @foreach($typeData['parts'] as $partData)
                                                        <div class="text-sm">
                                                            <span class="font-medium">{{ $partData['examPart']->name ?? 'N/A' }}</span>
                                                            <span class="text-gray-400">-</span>
                                                            <span class="text-indigo-600">{{ $partData['examMode']->name ?? 'N/A' }}</span>
                                                            @if($partData['config']->is_finalized)
                                                                <span class="text-green-600 ml-1">✓</span>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-gray-400 text-sm">-</span>
                                            @endif
                                        </td>
                                    @endforeach
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