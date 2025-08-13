<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Subject Type Component</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100">
    <div class="min-h-screen">
        <div class="bg-white shadow-sm border-b border-gray-200 p-4">
            <h1 class="text-2xl font-bold text-gray-900">Test Subject Type Component</h1>
            <p class="text-gray-600">Testing the SubjectTypeComp Livewire component</p>
        </div>

        <div class="container mx-auto">
            @livewire('subject-type-comp')
        </div>
    </div>

    @livewireScripts
</body>

</html>