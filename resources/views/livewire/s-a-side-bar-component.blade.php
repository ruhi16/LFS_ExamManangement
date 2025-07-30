<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    {{-- <div class="text-center p-7 text-violet-800">Livewire Page </div>
    <div style="text-align: center">
        
        <button wire:click="decrement">Decrement</button>
        <button wire:click="increment">Increment</button>
        
        <button wire:click="sbFlagToggle">Toggle Flag</button>
        
        <h1>{{ $count }} === {{ $sbFlag ? 'True' : 'False' }}</h1> --}}

    <div class="flex">
        <div class="bg-red-400 h-screen p-5 pt-8 {{ $sbFlag ? 'w-72' : 'w-20' }} duration-300 relative">
            {{-- the arrow mark --}}
            <svg class="h-8 w-8 text-red-500 bg-white rounded-full absolute -right-3 top-9 
                    border-2 border-purple-600 cursor-pointer {{ !$sbFlag ? 'rotate-180' : '' }}"
                {{-- id="btn" --}} fill="none" viewBox="0 0 24 24" stroke="currentColor" wire:click="sbFlagToggle">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>

            {{-- Settings & Title --}}
            <div class="inline-flex">
                <svg {{-- class="bg-amber-500 text-4xl rounded cursor-pointer block float-left mr-2"  --}} xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                        clip-rule="evenodd"></path>
                </svg>

                <h2
                    class="text-white origin-left font-medium text-2xl duration-300 
                        {{ !$sbFlag ? 'scale-0' : '' }}">
                    Sup_Admin</h2>
            </div>

            {{-- Search Mentu --}}
            <div
                class="flex items-center rounded-md bg-amber-300 mt-6 py-2 
                            {{ $sbFlag ? 'px-2.5' : 'px-4' }}">

                <div class="text-white text-lg block float-left cursor-pointer {{ !$sbFlag ? 'mr-2' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="search" placeholder="Search"
                    class="text-base bg-transparent w-full text-white focus:outline-none {{ !$sbFlag ? 'hidden' : '' }}" />
            </div>

            <ul class="pt-2 duration-300">
                @foreach ($sidebar_array as $item)
                    {{-- <li>{{$item ? json_encode($item) : '-'}}</li> --}}
                    <li
                        class="text-gray-300 text-sm flex items-center gap-x-4 
                            cursor-pointer p-2 rounded-md hover:bg-slate-600 {{ $item['isSelected'] ? 'bg-slate-700' : '' }}">
                        <span class="text-2xl block float-left ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z"></path>
                                <path fill-rule="evenodd"
                                    d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <span class="text-base font-medium flex-1 duration-200 {{ !$sbFlag ? 'hidden' : '' }}">
                            {{ is_array($item) ? $item['title'] : 'no' }}
                        </span>
                        @if (array_key_exists('submenu', $item))
                            @if ($sbSubMenu)
                                <svg wire:click="sbSubMenuToggle" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            @else
                                <svg wire:click="sbSubMenuToggle" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            @endif
                        @endif
                    </li>

                    {{-- {{ array_key_exists('submenu', $item) ? 'Yes' : 'No'}} --}}
                    @if (array_key_exists('submenu', $item) && $sbSubMenu && $sbFlag)
                        <ul class="pt-2 ">
                            @foreach ($item['submenuItems'] as $it)
                                <li
                                    class="text-gray-300 text-sm flex items-center px-5 gap-x-4 
                                    cursor-pointer p-2 rounded-md hover:bg-slate-600 ">
                                    {{ is_array($it) ? $it['title'] : 'no' }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            </ul>



        </div>

        <div class="p-7">
            Home Page: {{ $sbFlag }} : {{ Auth::user()->name }}: {{ auth()->user()->teacher->name }}
            {{-- <livewire:exam-detail-component /> --}}
            <livewire:about />

            <div>
                {{-- {{ $saslotdata }} --}}
                {{-- <livewire:contact /> --}}
            </div>

        </div>
    </div>
</div>
</div>
