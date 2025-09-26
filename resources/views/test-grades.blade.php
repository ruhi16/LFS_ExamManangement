<!DOCTYPE html>
<html>

<head>
    <title>Test Grades</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Grade Debug Information</h1>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Exam Details</h2>
            <p class="text-gray-600">Exam Detail ID: {{ $examDetail->id ?? 'N/A' }}</p>
            <p class="text-gray-600">Exam Type ID: {{ $examTypeId ?? 'N/A' }}</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Grades Information</h2>
            <p class="text-gray-600 mb-4">Total Grades Found: {{ $grades->count() }}</p>

            @if($grades->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="py-2 px-4 border-b text-left">ID</th>
                            <th class="py-2 px-4 border-b text-left">Name</th>
                            <th class="py-2 px-4 border-b text-left">Min %</th>
                            <th class="py-2 px-4 border-b text-left">Max %</th>
                            <th class="py-2 px-4 border-b text-left">Order Index</th>
                            <th class="py-2 px-4 border-b text-left">Is Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($grades as $grade)
                        <tr class="hover:bg-gray-50">
                            <td class="py-2 px-4 border-b">{{ $grade->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $grade->name }}</td>
                            <td class="py-2 px-4 border-b">{{ $grade->min_mark_percentage }}</td>
                            <td class="py-2 px-4 border-b">{{ $grade->max_mark_percentage }}</td>
                            <td class="py-2 px-4 border-b">{{ $grade->order_index }}</td>
                            <td class="py-2 px-4 border-b">{{ $grade->is_active ? 'Yes' : 'No' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Grade Dropdown Test</h3>
                <select class="w-full px-3 py-2 border border-gray-300 rounded-md">
                    <option value="">Select Grade</option>
                    @foreach($grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                    @endforeach
                    <option value="absent">Absent</option>
                </select>
            </div>
            @else
            <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                <p class="text-red-700">No active grades found for exam type {{ $examTypeId ?? 'N/A' }}</p>
            </div>
            @endif
        </div>
    </div>
</body>

</html>