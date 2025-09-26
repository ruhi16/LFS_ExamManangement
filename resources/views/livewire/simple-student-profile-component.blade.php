<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-blue-600 px-6 py-4">
            <h1 class="text-xl font-bold text-white">Simple Student Profile</h1>
        </div>

        <div class="p-6">
            @if(!$studentdb)
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">No student data found</h3>
                        <div class="mt-2 text-sm text-yellow-700">
                            <p>
                                @if(!Auth::user())
                                Please log in to view your profile.
                                @elseif(!Auth::user()->studentdb_id)
                                Your account is not linked to a student record.
                                @else
                                There was an issue loading your student information.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Basic Information</h2>
                    <div class="space-y-3">
                        <div class="flex">
                            <div class="w-1/3 text-gray-600">Name:</div>
                            <div class="w-2/3 font-medium">{{ $studentdb->name ?? 'N/A' }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-1/3 text-gray-600">Student ID:</div>
                            <div class="w-2/3 font-medium">{{ $studentdb->studentid ?? 'N/A' }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-1/3 text-gray-600">Date of Birth:</div>
                            <div class="w-2/3 font-medium">{{ $studentdb->dob ? date('d M, Y',
                                strtotime($studentdb->dob)) : 'N/A' }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Current Academic Info</h2>
                    @if($studentcr)
                    <div class="space-y-3">
                        <div class="flex">
                            <div class="w-1/3 text-gray-600">Class:</div>
                            <div class="w-2/3 font-medium">{{ $studentcr->myclass->name ?? 'N/A' }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-1/3 text-gray-600">Section:</div>
                            <div class="w-2/3 font-medium">{{ $studentcr->section->name ?? 'N/A' }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-1/3 text-gray-600">Roll No:</div>
                            <div class="w-2/3 font-medium">{{ $studentcr->roll_no ?? 'N/A' }}</div>
                        </div>
                    </div>
                    @else
                    <p class="text-gray-500">No current academic record found.</p>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>