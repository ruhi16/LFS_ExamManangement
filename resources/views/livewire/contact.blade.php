

<div>
{{-- <x-app-layout> --}}
    @section('header')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Contact: ' . __(auth()->user()->name . ': ' . __(auth()->user()->teacher->name)) }}
        </h2>        
    @endsection
    <h1>Contact Component</h1>
{{-- </x-app-layout> --}}
</div>