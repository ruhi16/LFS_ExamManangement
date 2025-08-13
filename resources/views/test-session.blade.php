<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Session Component</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen">
        <div class="container mx-auto py-8">
            <h1 class="text-2xl font-bold mb-4">Session Component Test</h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Widget Mode -->
                <div>
                    <h2 class="text-lg font-semibold mb-2">Widget Mode (Dashboard)</h2>
                    @livewire('session-comp', ['widget' => true])
                </div>

                <!-- Full Mode -->
                <div class="lg:col-span-2">
                    <h2 class="text-lg font-semibold mb-2">Full Mode (Settings)</h2>
                    @livewire('session-comp')
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
</body>

</html>