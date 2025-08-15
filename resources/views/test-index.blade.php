<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LFS Test Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-blue-900 to-purple-900 min-h-screen flex items-center justify-center">
    <div class="text-center">
        <div class="bg-white rounded-2xl shadow-2xl p-12 max-w-md mx-auto">
            <div class="mb-8">
                <i class="fas fa-flask text-6xl text-blue-500 mb-4"></i>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">LFS Test Center</h1>
                <p class="text-gray-600">Development & Testing Dashboard</p>
            </div>

            <div class="space-y-4">
                <a href="{{ route('test.dashboard.main') }}"
                    class="block w-full px-6 py-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors font-semibold">
                    <i class="fas fa-rocket mr-2"></i>
                    Launch Test Dashboard
                </a>

                <div class="grid grid-cols-2 gap-3">
                    <a href="/dashboard"
                        class="px-4 py-3 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors text-sm">
                        <i class="fas fa-home mr-1"></i>
                        Main App
                    </a>
                    <a href="/admin/home"
                        class="px-4 py-3 bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition-colors text-sm">
                        <i class="fas fa-user-shield mr-1"></i>
                        Admin
                    </a>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-xs text-gray-500">
                    <i class="fas fa-exclamation-triangle mr-1"></i>
                    For development use only
                </p>
            </div>
        </div>
    </div>
</body>

</html>