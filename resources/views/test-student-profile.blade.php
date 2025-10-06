@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Test Student Profile Page</h1>

    @if(Auth::check() && Auth::user()->role_id == 1 && Auth::user()->studentdb_id)
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        <p>User is authenticated as a student. Loading profile...</p>
    </div>

    @livewire('student-profile-component')
    @else
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6">
        <p>
            @if(!Auth::check())
            You are not logged in.
            @elseif(Auth::user()->role_id != 1)
            You are not a student (role_id: {{ Auth::user()->role_id }}).
            @elseif(!Auth::user()->studentdb_id)
            You don't have a student database record linked (studentdb_id: {{ Auth::user()->studentdb_id }}).
            @endif
        </p>
    </div>

    <div class="bg-gray-100 p-6 rounded-lg">
        <h2 class="text-xl font-semibold mb-4">Debug Information</h2>
        @if(Auth::check())
        <ul class="list-disc pl-5 space-y-2">
            <li>User ID: {{ Auth::user()->id }}</li>
            <li>Name: {{ Auth::user()->name }}</li>
            <li>Email: {{ Auth::user()->email }}</li>
            <li>Role ID: {{ Auth::user()->role_id }}</li>
            <li>Student DB ID: {{ Auth::user()->studentdb_id }}</li>
            <li>Is Requested: {{ Auth::user()->is_requested }}</li>
        </ul>
        @else
        <p>Not authenticated</p>
        @endif
    </div>
    @endif
</div>
@endsection