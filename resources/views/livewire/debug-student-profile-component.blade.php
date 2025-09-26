<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-red-600 px-6 py-4">
            <h1 class="text-xl font-bold text-white">DEBUG: Student Profile Component</h1>
        </div>

        <div class="p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Debug Information</h2>

            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <pre
                    class="text-sm text-gray-700 overflow-x-auto">{{ json_encode($debugInfo, JSON_PRETTY_PRINT) }}</pre>
            </div>

            @if($studentdb)
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Student Data</h2>
            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <pre
                    class="text-sm text-gray-700 overflow-x-auto">{{ json_encode($studentdb->toArray(), JSON_PRETTY_PRINT) }}</pre>
            </div>
            @endif

            @if($studentcr)
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Current Record Data</h2>
            <div class="bg-gray-50 rounded-lg p-4">
                <pre
                    class="text-sm text-gray-700 overflow-x-auto">{{ json_encode($studentcr->toArray(), JSON_PRETTY_PRINT) }}</pre>
            </div>
            @endif
        </div>
    </div>
</div>