<x-app-layout>
    {{-- @section('header')
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
        {{ 'Admin Dashboard: ' . __('Role-').__(auth()->user()->role->description) . ': ' . __(auth()->user()->id).'-' .
        __(auth()->user()->name) }}
    </h2>
    @endsection --}}

    {{-- <div class="h-fit min-w-full mx-auto">
        <div class="min-w-fit mx-auto bg-blue-300 text-center text-4xl font-bold my-4">
            Admin Dashboard
        </div>
    </div> --}}
    {{-- @section('content') --}}
    
    
    <div class="p-6">
        @livewire('dashboard-comp')
        {{-- @livewire('livewire.home') --}}
    </div>
    
    {{-- @endsection --}}
    {{--
    <livewire:footer-component /> --}}

</x-app-layout>