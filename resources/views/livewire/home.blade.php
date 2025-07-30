{{-- <x-superadmin-dashboard>
    <x-slot name="sabody">
        <H2>Super Admin Dashboard: Home</H2>
    </x-slot>
</x-superadmin-dashboard> --}}

<div>
{{-- <x-app-layout> --}}
    @section('header')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Home: ' . __(auth()->user()->name . ': ' . __(auth()->user()->teacher->name)) }}
        </h2> 
    @endsection
    
    <h1>Home Component hari</h1>
{{-- </x-app-layout> --}}
</div>