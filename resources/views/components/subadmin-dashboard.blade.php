<x-app-layout>
    {{-- <x-slot name="header"> --}}
    @section('header')
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{-- {{ 'Dashboard: ' . __(auth()->user()->role->name) . ': ' . __(auth()->user()->teacher->id).'-' . __(auth()->user()->teacher->name).' (User Name: '.__(auth()->user()->name).')' }} --}}
            {{ 'Dashboard: ' . __('Role-').__(auth()->user()->role->description) . ': ' . __(auth()->user()->teacher->id).'-' . __(auth()->user()->teacher->name) }}
        </h2>
    @endsection
    {{-- </x-slot> --}}

    <div class="h-fit min-w-full mx-auto">
        <div class="min-w-fit mx-auto bg-purple-300 text-center text-4xl font-bold my-4">
            Teacher Dashboard
        </div>
        {{-- <livewire:users-profile-detais-component > --}}
            {{-- {{auth()->user()->teacher->id}} --}}
        {{-- <livewire:admin-teacher-wise-marks-entry-links-component :teacher_id="auth()->user()->teacher->id" > --}}
        {{-- <livewire:admin-teacher-wise-marks-entry-links-component> --}}

        {{-- <livewire: user-change-password-component >123 --}}

        
    </div>
    






    {{-- <livewire:users-profile-detais-component > --}}
    {{-- <livewire:footer-component /> --}}

</x-app-layout>
