@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Class Section Tasks Test</h1>

        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Class Section Tasks Component</h2>
            <p class="text-gray-600 mb-4">
                This page demonstrates the Class Section Tasks component with the provided parameters.
            </p>
        </div>

        <!-- Class Section Tasks Component -->
        @if(isset($examDetailId) && isset($subjectId))
        <livewire:class-section-tasks-comp :exam-detail-id="$examDetailId" :subject-id="$subjectId" />
        @else
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <h3 class="text-lg font-medium text-yellow-800 mb-2">Missing Parameters</h3>
            <p class="text-gray-600">
                Please provide valid examDetailId and subjectId parameters to view the component.
            </p>
        </div>
        @endif
    </div>
</div>
@endsection