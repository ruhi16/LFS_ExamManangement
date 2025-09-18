<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Setting with FMPM Test</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <div class="max-w-full mx-auto">
            <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">
                Exam Setting with Full Marks, Pass Marks & Time Test
            </h1>

            @livewire('exam-setting-with-fmpm')
        </div>
    </div>

    @livewireScripts
</body>

</html>