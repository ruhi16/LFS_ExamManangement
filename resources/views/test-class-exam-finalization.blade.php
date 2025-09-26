<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Exam Subject Configuration Test</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-900">Class Exam Subject Configuration Test</h1>
                <p class="text-gray-600">Testing the finalization feature and exam name sorting</p>
            </div>

            @livewire('class-exam-subject-comp')
        </div>
    </div>

    @livewireScripts
</body>

</html>