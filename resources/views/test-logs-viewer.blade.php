<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Logs Viewer Component</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100">
    <div class="min-h-screen">
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <h1 class="text-2xl font-bold text-gray-900">Test Logs Viewer Component</h1>
                    <a href="/" class="text-indigo-600 hover:text-indigo-500">← Back to Home</a>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto py-6">
            @livewire('logs-viewer-comp')
        </div>
    </div>

    @livewireScripts
</body>

</html>