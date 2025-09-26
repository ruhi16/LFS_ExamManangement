@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Student Profile Test</h1>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Student Profile Component</h2>

        <!-- Livewire Student Profile Component -->
        @livewire('student-profile-component')
    </div>
</div>
@endsection