{{-- <x-app-layout>
    <x-slot name="header">
        
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            {{ 'About: ' . __(auth()->user()->name . ': ' . __(auth()->user()->teacher->name)) }}
            
        </h2>
    </x-slot>

    ABOUT Page
    <livewire:s-a-side-bar-component />
    <livewire:footer-component />

</x-app-layout> --}}
<div>
{{-- <x-app-layout> --}}
    @section('header')
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ 'About: ' . __(auth()->user()->name . ': ' . __(auth()->user()->teacher->name)) }}
            </h2>            
            
    @endsection
    <h1>About Component</h1>
{{-- </x-app-layout> --}}

</div>
