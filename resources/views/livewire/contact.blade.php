<div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Exam Data Entry</h2>
    
    <!-- Entry Form -->
    <div class="bg-gray-50 p-4 rounded-lg mb-6">
        <h3 class="text-lg font-medium text-gray-700 mb-4">Add New Entry</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Exam Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Exam Name</label>
                <select wire:model="selectedExamName" 
                        wire:change="updatedSelectedExamName($event.target.value)"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select Exam Name</option>
                    @foreach($examNames as $examName)
                        <option value="{{ $examName->id }}">{{ $examName->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Exam Type (shown when exam name is selected) -->
            @if($selectedExamName)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Exam Type</label>
                <select wire:model="selectedExamType" 
                        wire:change="updatedSelectedExamType($event.target.value)"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select Exam Type</option>
                    @foreach($examTypes as $examType)
                        <option value="{{ $examType->id }}">{{ $examType->name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            
            <!-- Exam Part (shown when exam type is selected) -->
            @if($selectedExamType)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Exam Part</label>
                <select wire:model="selectedExamPart" 
                        wire:change="updatedSelectedExamPart($event.target.value)"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select Exam Part</option>
                    @foreach($examParts as $examPart)
                        <option value="{{ $examPart->id }}">{{ $examPart->name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            
            <!-- Exam Mode (shown when exam part is selected) -->
            @if($selectedExamPart)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Exam Mode</label>
                <select wire:model="newEntry.exam_mode_id"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Select Exam Mode</option>
                    @foreach($examModes as $examMode)
                        <option value="{{ $examMode->id }}">{{ $examMode->name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
        </div>
        
        <!-- Add Entry Button -->
        @if($selectedExamPart)
        <div class="mt-4 flex justify-end">
            <button type="button" wire:click="addEntry" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Add to Table
            </button>
        </div>
        @endif
    </div>
    
    <!-- Entries Table -->
    @if($entries->count() > 0)
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Exam Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Exam Type</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Exam Part</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Exam Mode</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($entries as $index => $entry)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $entry['exam_name'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry['exam_type'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry['exam_part'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $entry['exam_mode'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <button wire:click="removeEntry({{ $index }})" 
                                class="text-red-600 hover:text-red-900">Remove</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <!-- Save All Button -->
        <div class="mt-4 flex justify-end">
            <button type="button" wire:click="saveAll" 
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                Save All Entries
            </button>
        </div>
    </div>
    @endif
    
    <!-- Success Message -->
    @if(session()->has('message'))
    <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ session('message') }}
    </div>
    @endif
</div>