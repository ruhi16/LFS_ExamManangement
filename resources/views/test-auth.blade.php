@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Authentication Test</h1>

        <div class="space-y-4">
            <div class="bg-gray-50 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">User Information</h2>
                @if(Auth::check())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p><span class="font-medium">ID:</span> {{ Auth::user()->id }}</p>
                        <p><span class="font-medium">Name:</span> {{ Auth::user()->name }}</p>
                        <p><span class="font-medium">Email:</span> {{ Auth::user()->email }}</p>
                    </div>
                    <div>
                        <p><span class="font-medium">Role ID:</span> {{ Auth::user()->role_id }}</p>
                        <p><span class="font-medium">Student DB ID:</span> {{ Auth::user()->studentdb_id ?? 'NULL' }}
                        </p>
                        <p><span class="font-medium">Status:</span> {{ Auth::user()->status ?? 'NULL' }}</p>
                    </div>
                </div>
                @else
                <p class="text-gray-500">No user is currently authenticated.</p>
                @endif
            </div>

            <div class="bg-gray-50 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Role Information</h2>
                @if(Auth::check() && Auth::user()->role)
                <p><span class="font-medium">Role Name:</span> {{ Auth::user()->role->name }}</p>
                <p><span class="font-medium">Role Description:</span> {{ Auth::user()->role->description ?? 'N/A' }}</p>
                @else
                <p class="text-gray-500">Role information not available.</p>
                @endif
            </div>

            @if(Auth::check() && Auth::user()->studentdb_id)
            <div class="bg-gray-50 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Student Information</h2>
                @php
                $student = App\Models\Studentdb::find(Auth::user()->studentdb_id);
                @endphp
                @if($student)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p><span class="font-medium">Student ID:</span> {{ $student->id }}</p>
                        <p><span class="font-medium">Name:</span> {{ $student->name }}</p>
                        <p><span class="font-medium">Student ID:</span> {{ $student->studentid }}</p>
                    </div>
                    <div>
                        <p><span class="font-medium">Class ID:</span> {{ $student->stclass_id ?? 'N/A' }}</p>
                        <p><span class="font-medium">Section ID:</span> {{ $student->stsection_id ?? 'N/A' }}</p>
                        <p><span class="font-medium">DOB:</span> {{ $student->dob ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="mt-4">
                    <h3 class="font-medium text-gray-700 mb-2">Current Records</h3>
                    @php
                    $currentRecords = App\Models\Studentcr::where('studentdb_id', $student->id)->get();
                    @endphp
                    @if($currentRecords->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Class
                                    </th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Section
                                    </th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Roll No
                                    </th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Session
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($currentRecords as $record)
                                <tr>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">{{ $record->id }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">{{ $record->myclass_id
                                        ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">{{ $record->section_id
                                        ?? 'N/A' }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">{{ $record->roll_no ??
                                        'N/A' }}</td>
                                    <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-500">{{ $record->session_id
                                        ?? 'N/A' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <p class="text-gray-500">No current records found for this student.</p>
                    @endif
                </div>
                @else
                <p class="text-gray-500">Student record not found.</p>
                @endif
            </div>
            @endif

            <div class="bg-gray-50 rounded-lg p-4">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Available Routes</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('test.student.profile') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                        Student Profile
                    </a>
                    <a href="{{ route('simple.student.profile') }}"
                        class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition-colors">
                        Simple Profile
                    </a>
                    <a href="{{ route('debug.student.profile') }}"
                        class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
                        Debug Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection