@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Class Section Tasks Test</h1>

        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Instructions</h2>
            <p class="text-gray-600 mb-4">
                To test the Class Section Tasks component, you need to provide valid IDs for:
            </p>
            <ul class="list-disc list-inside text-gray-600 mb-4">
                <li>Exam Detail ID</li>
                <li>Subject ID</li>
            </ul>
            <p class="text-gray-600">
                Use the component directly in your views with valid parameters.
            </p>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <h3 class="text-lg font-medium text-blue-800 mb-2">Usage Example</h3>
            <p class="text-gray-600 mb-2">In your Blade template:</p>
            <pre class="bg-gray-100 p-4 rounded-lg text-sm overflow-x-auto">
&lt;livewire:class-section-tasks-comp 
    :exam-detail-id="$examDetailId" 
    :subject-id="$subjectId" /&gt;
            </pre>
        </div>

        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <h3 class="text-lg font-medium text-green-800 mb-2">Test with Sample Data</h3>
            <p class="text-gray-600 mb-4">
                To test with sample data, you can use the following route with valid IDs:
            </p>
            <p class="text-gray-600 mb-2">
                Example URL: <code
                    class="bg-gray-100 px-2 py-1 rounded">/test-class-section-tasks?examDetailId=1&subjectId=1</code>
            </p>
            <p class="text-gray-600">
                Replace the IDs with valid values from your database.
            </p>
        </div>
    </div>
</div>
@endsection