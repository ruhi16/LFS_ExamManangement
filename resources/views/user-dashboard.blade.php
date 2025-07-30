
<x-app-layout>
    
    {{-- <x-slot name="header"> --}}
        @section('header')
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                
                {{ 'Dashboard: ' . __(auth()->user()->role->name . ': ' . __(auth()->user()->name)) }}
            </h2>
        @endsection
    {{-- </x-slot> --}}

    <livewire:user-account-component>
        
</x-app-layout>