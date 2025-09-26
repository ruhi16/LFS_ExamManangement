<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Subject Grouping</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-4">Subject Grouping Test</h1>

            <div class="space-y-4">
                <div>
                    <h3 class="text-lg font-semibold">Subject Types:</h3>
                    <ul class="list-disc pl-6">
                        @foreach(App\Models\SubjectType::all() as $type)
                        <li>{{ $type->id }} - {{ $type->name }}</li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold">Subjects with Types:</h3>
                    <ul class="list-disc pl-6">
                        @foreach(App\Models\Subject::with('subjectType')->get() as $subject)
                        <li>{{ $subject->id }} - {{ $subject->name }} ({{ $subject->subjectType->name ?? 'No Type' }})
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold">Class Subjects (with relationships):</h3>
                    @if(App\Models\Myclass::first())
                    @php $firstClass = App\Models\Myclass::first(); @endphp
                    <p class="text-sm text-gray-600 mb-2">Showing subjects for class: {{ $firstClass->name }}</p>
                    <ul class="list-disc pl-6">
                        @foreach(App\Models\MyclassSubject::with(['subject.subjectType'])->where('myclass_id',
                        $firstClass->id)->where('is_active', true)->get() as $classSubject)
                        <li>
                            Subject ID: {{ $classSubject->subject->id ?? 'N/A' }} -
                            {{ $classSubject->subject->name ?? 'Unknown' }}
                            (Type: {{ $classSubject->subject->subjectType->name ?? 'No Type' }})
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p class="text-gray-500">No classes found</p>
                    @endif
                </div>
            </div>

            <div class="mt-8">
                <a href="/test-class-exam-finalization"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                    Test the Component
                </a>
            </div>
        </div>
    </div>

    @livewireScripts
</body>

</html>