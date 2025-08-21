<x-app-layout>
    {{-- <x-slot name="header"> --}}
    @section('header')
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{-- {{ 'Dashboard: ' . __(auth()->user()->role->name) . ': ' . __(auth()->user()->teacher->id).'-' . __(auth()->user()->teacher->name).' (User Name: '.__(auth()->user()->name).')' }} --}}
            {{ 'Sub-Admin Dashboard: '. __('Role-').__(auth()->user()->role->description) . ': ' . __(auth()->user()->id).'-' . __(auth()->user()->name)}}
        </h2>
    @endsection
    {{-- </x-slot> --}}

    <div class="h-fit min-w-full mx-auto">
        <div class="min-w-fit mx-auto bg-purple-300 text-center text-4xl font-bold my-4">
            Sub-Admin or Teacher Dashboard
        </div>
        
    </div>
    
    {{-- {{ auth()->user()->teacher->name ?? 'XX' }} --}}
    @livewire('sub-admin-dashboard-comp', ['user' => auth()->user()])





    {{-- <livewire:users-profile-detais-component > --}}
    {{-- <livewire:footer-component /> --}}

</x-app-layout>
