
<x-app-layout>
    {{-- <x-slot name="header"> --}}
        {{-- @section('header') --}}
            {{-- <h2 class="font-semibold text-2xl text-gray-800 leading-tight"> --}}
                {{-- {{ 'Dashboard: ' . __(auth()->user()->role->name) . ': ' . __(auth()->user()->teacher->id).'-' . __(auth()->user()->teacher->name).' (User Name: '.__(auth()->user()->name).')' }} --}}
                {{-- {{ 'Admin Dashboard: ' . __('Role-').__(auth()->user()->role->description) . ': ' . __(auth()->user()->id).'-' . __(auth()->user()->name) }} --}}
            {{-- </h2>             --}}
            {{-- {{ $slot  }} --}}
            {{-- @yield('component_name')  --}}
        {{-- @endsection --}}
    {{-- </x-slot> --}}
    
    @livewire('home')
    {{-- @livewire('wcui.welcome-banner-comp') --}}


    {{-- <livewire:footer-component/> --}}

</x-app-layout>