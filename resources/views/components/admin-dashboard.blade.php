
<x-app-layout>
    {{-- <x-slot name="header"> --}}
        @section('header')
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{-- {{ 'Dashboard: ' . __(auth()->user()->role->name) . ': ' . __(auth()->user()->teacher->id).'-' . __(auth()->user()->teacher->name).' (User Name: '.__(auth()->user()->name).')' }} --}}
                {{ 'Dashboard: ' . __('Role-').__(auth()->user()->role->description) . ': ' . __(auth()->user()->teacher->id).'-' . __(auth()->user()->teacher->name) }}
            </h2>
            
            {{-- {{ $slot  }} --}}            
            

            @yield('component_name') 
        @endsection
    {{-- </x-slot> --}}


    <livewire:footer-component/>

</x-app-layout>