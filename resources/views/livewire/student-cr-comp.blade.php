<div class="flex-1 p-6 overflow-y-auto max-w-full mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Student Class Records</h1>
                <p class="mt-1 text-sm text-gray-600">View and manage class-wise student information from student database</p>
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

    <!-- Debug Panel -->
    @if($debugMode)
        <div class="mb-4 p-4 bg-yellow-50 border border-yellow-200 rounded-md">
            <h4 class="text-sm font-medium text-yellow-800 mb-2">Debug Panel</h4>
            <div class="flex space-x-2 mb-2">
                <button wire:click="checkDatabaseConnection" class="bg-blue-500 text-white px-3 py-1 rounded text-xs">
                    Test DB Connection
                </button>
                <button wire:click="testDataLoad" class="bg-green-500 text-white px-3 py-1 rounded text-xs">
                    Test Data Load
                </button>
                <button wire:click="refreshData" class="bg-purple-500 text-white px-3 py-1 rounded text-xs">
                    Refresh Data
                </button>
                <button wire:click="testStudentRecords" class="bg-orange-500 text-white px-3 py-1 rounded text-xs">
                    Test Records
                </button>
                <button wire:click="loadAllStudents" class="bg-pink-500 text-white px-3 py-1 rounded text-xs">
                    Load All Students
                </button>
            </div>
            <div class="text-xs text-yellow-700">
                Selected Class: {{ $selectedClassId ?? 'None' }} | 
                Selected Section: {{ $selectedSectionId ?? 'None' }} | 
                Student Records: {{ count($studentRecords) }} | 
                Students DB: {{ count($students) }}
            </div>
        </div>
    @endif

    <!-- Debug Toggle Button -->
    <div class="mb-4">
        <button wire:click="toggleDebugMode" class="bg-gray-500 text-white px-3 py-1 rounded text-xs">
            {{ $debugMode ? 'Hide Debug' : 'Show Debug' }}
        </button>
    </div>

    <!-- Class Selection -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8">
            @if($classes && count($classes) > 0)
                @foreach($classes as $class)
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

    <!-- Section Selection -->
    @if($selectedClassId)
        @if($classSections && count($classSections) > 0)
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Select Section</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($classSections as $section)
                        <button wire:click="selectSection({{ $section->id }})"
                            class="@if($selectedSectionId == $section->id) bg-indigo-600 text-white @else bg-gray-200 text-gray-700 hover:bg-gray-300 @endif px-4 py-2 rounded-md text-sm font-medium">
                            {{ $section->name }}
                        </button>
                    @endforeach
                </div>
            </div>
        @else
            <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-md">
                <p class="text-sm text-yellow-700">No sections found for this class. Showing all students in the class.</p>
            </div>
        @endif
    @endif

    <!-- Student Records Display -->
    @if($selectedClassId && ($selectedSectionId || count($classSections) == 0))
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">
                    Student Records for 
                    <span class="text-indigo-600 font-semibold">
                        @if($classes && $selectedClassId)
                            {{ $classes->firstWhere('id', $selectedClassId)->name ?? 'Unknown Class' }}
                        @endif
                        @if($classSections && $selectedSectionId)
                            - {{ $classSections->firstWhere('id', $selectedSectionId)->name ?? 'Unknown Section' }}
                        @endif
                    </span>
                </h3>
            </div>

            @if(count($studentRecords) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Roll No.
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Student Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Student ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Class
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Section
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($studentRecords as $record)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $record['roll_number'] ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $record['studentdb']['name'] ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $record['studentdb_id'] ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $record['myclass']['name'] ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $record['myclass_section']['name'] ?? $record['section']['name'] ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($record['is_active'])
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button class="text-indigo-600 hover:text-indigo-900 mr-3">
                                            View
                                        </button>
                                        <button class="text-green-600 hover:text-green-900 mr-3">
                                            Edit
                                        </button>
                                        <button class="text-red-600 hover:text-red-900">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Summary -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-600">
                            Total Students: <strong>{{ count($studentRecords) }}</strong>
                        </div>
                        <div class="text-sm text-gray-600">
                            Active: <strong>{{ collect($studentRecords)->where('is_active', true)->count() }}</strong> | 
                            Inactive: <strong>{{ collect($studentRecords)->where('is_active', false)->count() }}</strong>
                        </div>
                    </div>
                </div>
            @else
                <div class="p-6 text-center text-gray-500">
                    <div class="text-lg font-medium mb-2">No student records found</div>
                    <div class="text-sm">No students are assigned to this class and section yet.</div>
                </div>
            @endif
        </div>
    @elseif($selectedClassId)
        <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
            <div class="text-lg font-medium mb-2">Select a section to view student records</div>
            <div class="text-sm">Choose a section from the options above to see student information.</div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-6 text-center text-gray-500">
            <div class="text-lg font-medium mb-2">Select a class to view student records</div>
            <div class="text-sm">Choose a class from the tabs above to see available sections and students.</div>
        </div>
    @endif
</div>