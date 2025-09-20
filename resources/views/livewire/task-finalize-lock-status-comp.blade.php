<div class="p-6 bg-gray-50 min-h-screen">
    {{-- Header Section --}}
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
        <div class="p-6 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-900">Task Finalization & Lock Status</h1>
            <p class="text-sm text-gray-600 mt-1">Manage finalization status for exam configuration tasks</p>
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
    @if($selectedClassId && !empty($finalizationData))
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Finalization Status</h2>
            
            {{-- Exam Configuration Hierarchy --}}
            <div class="space-y-6">
                @foreach($finalizationData as $nameData)
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    {{-- Exam Name Level --}}
                    <div class="bg-blue-50 px-4 py-3 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <h3 class="font-semibold text-gray-900">Exam: {{ $nameData['exam_name']->name }}</h3>
                            <button wire:click="toggleFinalization('exam_name', {{ $nameData['exam_name']->id }})"
                                class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-md transition-colors duration-200 {{ $nameData['is_finalized'] ? 'bg-red-100 text-red-800 hover:bg-red-200' : 'bg-green-100 text-green-800 hover:bg-green-200' }}">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    @if($nameData['is_finalized'])
                                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    @else
                                        <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V7a1 1 0 112 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    @endif
                                </svg>
                                {{ $nameData['is_finalized'] ? 'Unfinalize' : 'Finalize' }}
                            </button>
                        </div>
                    </div>
                    
                    {{-- Exam Types --}}
                    @if(isset($nameData['exam_types']) && !empty($nameData['exam_types']))
                    @foreach($nameData['exam_types'] as $typeData)
                    <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 ml-4">
                        <div class="flex items-center justify-between">
                            <h4 class="font-medium text-gray-800">Type: {{ $typeData['exam_type']->name }}</h4>
                            <button wire:click="toggleFinalization('exam_type', {{ $typeData['exam_type']->id }})"
                                class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-md transition-colors duration-200 {{ $typeData['is_finalized'] ? 'bg-red-100 text-red-800 hover:bg-red-200' : 'bg-green-100 text-green-800 hover:bg-green-200' }}">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    @if($typeData['is_finalized'])
                                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    @else
                                        <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V7a1 1 0 112 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    @endif
                                </svg>
                                {{ $typeData['is_finalized'] ? 'Unfinalize' : 'Finalize' }}
                            </button>
                        </div>
                    </div>
                    
                    {{-- Exam Parts --}}
                    @if(isset($typeData['exam_parts']) && !empty($typeData['exam_parts']))
                    @foreach($typeData['exam_parts'] as $partData)
                    <div class="bg-white px-4 py-2 border-b border-gray-200 ml-8">
                        <div class="flex items-center justify-between">
                            <h5 class="font-medium text-gray-700">Part: {{ $partData['exam_part']->name }}</h5>
                            <button wire:click="toggleFinalization('exam_part', {{ $partData['exam_part']->id }})"
                                class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-md transition-colors duration-200 {{ $partData['is_finalized'] ? 'bg-red-100 text-red-800 hover:bg-red-200' : 'bg-green-100 text-green-800 hover:bg-green-200' }}">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    @if($partData['is_finalized'])
                                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    @else
                                        <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V7a1 1 0 112 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    @endif
                                </svg>
                                {{ $partData['is_finalized'] ? 'Unfinalize' : 'Finalize' }}
                            </button>
                        </div>
                    </div>
                    
                    {{-- Exam Modes --}}
                    @if(isset($partData['exam_modes']) && !empty($partData['exam_modes']))
                    @foreach($partData['exam_modes'] as $modeData)
                    <div class="bg-gray-50 px-4 py-2 border-b border-gray-200 ml-12">
                        <div class="flex items-center justify-between">
                            <h6 class="font-medium text-gray-600">Mode: {{ $modeData['exam_mode']->name }}</h6>
                            <button wire:click="toggleFinalization('exam_mode', {{ $modeData['exam_mode']->id }})"
                                class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-md transition-colors duration-200 {{ $modeData['is_finalized'] ? 'bg-red-100 text-red-800 hover:bg-red-200' : 'bg-green-100 text-green-800 hover:bg-green-200' }}">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    @if($modeData['is_finalized'])
                                        <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    @else
                                        <path fill-rule="evenodd" d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V7a1 1 0 112 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    @endif
                                </svg>
                                {{ $modeData['is_finalized'] ? 'Unfinalize' : 'Finalize' }}
                            </button>
                        </div>
                    </div>
                    
                    {{-- Dependencies --}}
                    @if(isset($modeData['has_dependencies']) && $modeData['has_dependencies'])
                    <div class="bg-white border-b border-gray-200 ml-16">
                        <div class="px-4 py-3">
                            <h6 class="text-sm font-medium text-gray-700 mb-2">Dependencies:</h6>
                            <div class="space-y-2">
                                @if(isset($modeData['dependencies']) && !empty($modeData['dependencies']))
                                @foreach($modeData['dependencies'] as $dep)
                                <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                                    <span class="text-sm font-medium text-gray-800">{{ $dep['name'] }} ({{ $dep['count'] }})</span>
                                    @if($dep['locked'])
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Locked
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Ready
                                        </span>
                                    @endif
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endif
                    @endforeach
                    @endif
                    @endforeach
                    @endif
                </div>
                @endforeach
            </div>
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
                <h3 class="mt-2 text-sm font-medium text-gray-900">No Configuration Found</h3>
                <p class="mt-1 text-sm text-gray-500">
                    No exam configuration is available for the selected class.
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
                    Please select a class from the dropdown above to view finalization status.
                </p>
            </div>
        </div>
    </div>
    @endif

</div>
