@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Formative Marks Entry Test</h1>

        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Instructions</h2>
            <p class="text-gray-600 mb-4">
                To test the Formative Marks Entry component, you need to provide valid IDs for:
            </p>
            <ul class="list-disc list-inside text-gray-600 mb-4">
                <li>Exam Detail ID</li>
                <li>Subject ID</li>
                <li>Section ID</li>
            </ul>
            <p class="text-gray-600">
                Use the route: <code
                    class="bg-gray-100 px-2 py-1 rounded">/test-formative-marks-entry/{examDetailId}/{subjectId}/{sectionId}</code>
            </p>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <h3 class="text-lg font-medium text-blue-800 mb-2">Example URLs</h3>
            <p class="text-gray-600 mb-2">Replace the IDs with valid values from your database:</p>
            <ul class="list-disc list-inside text-gray-600">
                <li><a href="/test-formative-marks-entry/1/1/1"
                        class="text-blue-600 hover:underline">/test-formative-marks-entry/2/1</a></li>
                <li><a href="/test-formative-marks-entry/2/3/4"
                        class="text-blue-600 hover:underline">/test-formative-marks-entry/2/1</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection