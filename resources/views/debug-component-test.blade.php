@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Debug Component Test</h1>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Authentication Debug Info</h2>
        
        <div class="space-y-4">
            <div>
                <p><span class="font-medium">Authenticated:</span> {{ Auth::check() ? 'Yes' : 'No' }}</p>
            </div>
            
            @if(Auth::check())
            <div>
                <p><span class="font-medium">User ID:</span> {{ Auth::user()->id }}</p>
                <p><span class="font-medium">User Name:</span> {{ Auth::user()->name }}</p>
                <p><span class="font-medium">Role ID:</span> {{ Auth::user()->role_id }}</p>
                <p><span class="font-medium">Student DB ID:</span> {{ Auth::user()->studentdb_id ?? 'NULL' }}</p>
            </div>
            
            @if(Auth::user()->studentdb_id)
            <div>
                <h3 class="text-lg font-medium text-gray-800 mt-4">Student Data</h3>
                @php
                    $student = \App\Models\Studentdb::find(Auth::user()->studentdb_id);
                @endphp
                
                @if($student)
                <div class="mt-2 p-4 bg-green-50 rounded">
                    <p><span class="font-medium">Student ID:</span> {{ $student->id }}</p>
                    <p><span class="font-medium">Student Name:</span> {{ $student->name ?? 'N/A' }}</p>
                    <p><span class="font-medium">Student StudentID:</span> {{ $student->studentid ?? 'N/A' }}</p>
                </div>
                @else
                <div class="mt-2 p-4 bg-red-50 rounded">
                    <p>No student found with ID: {{ Auth::user()->studentdb_id }}</p>
                </div>
                @endif
            </div>
            @endif
            @endif
        </div>
    </div>
</div>
@endsection