<!DOCTYPE html>
<html>

<head>
    <title>Test User Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Test User Dashboard</h1>

        @if(Auth::check())
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
            <p><strong>User:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Role ID:</strong> {{ Auth::user()->role_id }}</p>
            <p><strong>Student DB ID:</strong> {{ Auth::user()->studentdb_id }}</p>
            <p><strong>Should see verification:</strong> {{ (Auth::user()->role_id == 0 && Auth::user()->studentdb_id ==
                0) ? 'Yes' : 'No' }}</p>
        </div>

        @if(Auth::user()->role_id == 0 && Auth::user()->studentdb_id == 0)
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h3 class="text-lg font-semibold text-yellow-800">Account Verification Required</h3>
                    <p class="text-yellow-600">Please verify your identity to access all features</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <!-- Student Verification Button -->
                    <button onclick="alert('Student Verification clicked!')"
                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md font-medium transition-colors flex items-center justify-center">
                        <i class="fas fa-user-graduate mr-2"></i>Student Verification
                    </button>

                    <!-- Teacher Request Button -->
                    <button onclick="alert('Teacher Request clicked!')"
                        class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-md font-medium transition-colors flex items-center justify-center">
                        <i class="fas fa-chalkboard-teacher mr-2"></i>Request to be a Teacher
                    </button>
                </div>
            </div>
        </div>
        @else
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            <p>User is already verified (role_id != 0 or studentdb_id != 0)</p>
        </div>
        @endif
        @else
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <p>User not authenticated</p>
        </div>
        @endif
    </div>
</body>

</html>