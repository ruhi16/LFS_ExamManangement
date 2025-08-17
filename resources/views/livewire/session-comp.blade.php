@if($showWidget)
    <!-- Dashboard Widget Mode -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-sm font-medium text-gray-900">Active Session</h3>
            <button wire:click="refreshData" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-sync-alt text-sm"></i>
            </button>
        </div>

        @if($activeSession)
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-lg font-semibold text-gray-900">{{ $activeSession->name }}</span>
                    <span
                        class="px-2 py-1 text-xs font-medium rounded-full {{ $this->getSessionStatusColor($activeSession->status) }}">
                        {{ ucfirst($activeSession->status) }}
                    </span>
                </div>

                <div class="text-sm text-gray-600">
                    <div class="flex items-center">
                        <i class="fas fa-calendar-alt w-4 mr-2"></i>
                        {{ $this->getSessionDuration($activeSession) }}
                    </div>
                    @if($this->isSessionCurrent($activeSession))
                        <div class="flex items-center mt-1 text-green-600">
                            <i class="fas fa-check-circle w-4 mr-2"></i>
                            Current Session
                        </div>
                    @endif
                </div>

                @if($activeSession->details)
                    <p class="text-xs text-gray-500 truncate" title="{{ $activeSession->details }}">
                        {{ $activeSession->details }}
                    </p>
                @endif
            </div>

            <!-- Quick Session Switcher -->
            @php 
            // $sessions->where('status', '!=', 'active')->count()
                $activeSessionCount = count(array_filter($sessions, function ($session) {
                    return $session['status'] !== 'active';
                }));
                $sessions = collect($sessions)->map(function ($item) {
                    return new Session($item);
                });
            @endphp
            @if($activeSessionCount > 0)
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <div class="relative">
                        <select wire:change="setActiveSession($event.target.value)"
                            class="w-full text-xs border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Switch Session...</option>
                            {{-- @foreach($sessions->where('status', '!=', 'active') as $session)
                                <option value="{{ $session->id }}">{{ $session->name }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>
            @endif
        @else
            <div class="text-center py-4">
                <div class="text-gray-400 mb-2">
                    <i class="fas fa-calendar-times text-2xl"></i>
                </div>
                <p class="text-sm text-gray-500">No active session</p>
                <button wire:click="openModal" class="mt-2 text-xs bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                    Create Session
                </button>
            </div>
        @endif
    </div>
@else

    <div class="flex-1 p-6 overflow-y-auto max-w-full mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">Sessions Management</h1>
                    <p class="mt-1 text-sm text-gray-600">Manage academic sessions and their configurations</p>
                </div>
                <div class="flex space-x-2">
                    <button wire:click="refreshData"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Refresh Data
                    </button>
                    <button wire:click="showAddModal"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Add Session
                    </button>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        @if (session()->has('message'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md">
            {{ session('message') }}
        </div>
        @endif

        @if (session()->has('error'))
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md">
            {{ session('error') }}
        </div>
        @endif

        <!-- Sessions Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">All Sessions</h3>
                <p class="text-sm text-gray-600 mt-1">
                    Total Sessions: {{ count($sessions) }} |
                    Active: {{ count(array_filter($sessions, fn($s) => $s['status'] === 'Active')) }} |
                    Inactive: {{ count(array_filter($sessions, fn($s) => $s['status'] === 'Inactive')) }}
                </p>
            </div>

            @if(count($sessions) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Session
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Duration
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                School
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Related Data
                            </th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($sessions as $session)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-gray-900">
                                <div class="font-medium">{{ $session['name'] }}</div>
                                @if($session['details'])
                                <div class="text-xs text-gray-500 mt-1">{{ $session['details'] }}</div>
                                @endif
                                @if($session['remark'])
                                <div class="text-xs text-gray-400 mt-1">{{ $session['remark'] }}</div>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                <div class="text-xs text-gray-400">to</div>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                {{ $session['school_name'] }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <span
                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $session['status'] === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $session['status'] }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-500">
                                <div class="grid grid-cols-2 gap-1 text-xs">
                                    <div>Classes: {{ $session['myclasses_count'] }}</div>
                                    <div>Sections: {{ $session['sections_count'] }}</div>
                                    <div>Subjects: {{ $session['subjects_count'] }}</div>
                                    <div>Students: {{ $session['studentdbs_count'] }}</div>
                                    <div>Records: {{ $session['studentcrs_count'] }}</div>
                                    <div>Exams: {{ $session['exams_count'] }}</div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                <div class="flex justify-center space-x-2">
                                    <button wire:click="editSession({{ $session['id'] }})"
                                        class="text-blue-600 hover:text-blue-900">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button wire:click="toggleStatus({{ $session['id'] }})"
                                        class="text-yellow-600 hover:text-yellow-900">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                            </path>
                                        </svg>
                                    </button>
                                    <button wire:click="deleteSession({{ $session['id'] }})"
                                        class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Are you sure you want to delete this session?')">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No sessions</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by creating a new session.</p>
                <div class="mt-6">
                    <button wire:click="showAddModal"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                        <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Session
                    </button>
                </div>
            </div>
            @endif
        </div>

        <!-- Modal -->
        @if($showModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" id="modal">
            <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ $editingId ? 'Edit Session' : 'Add New Session' }}
                        </h3>
                        <button wire:click="hideModal" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form wire:submit.prevent="saveSession">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Session Name -->
                            <div class="col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Session Name *</label>
                                <input type="text" wire:model="name" id="name"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Details -->
                            <div class="col-span-2">
                                <label for="details" class="block text-sm font-medium text-gray-700">Details</label>
                                <textarea wire:model="details" id="details" rows="2"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                                @error('details') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Start Date -->
                            <div>
                                <label for="stdate" class="block text-sm font-medium text-gray-700">Start Date *</label>
                                <input type="date" wire:model="stdate" id="stdate"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('stdate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- End Date -->
                            <div>
                                <label for="entdate" class="block text-sm font-medium text-gray-700">End Date *</label>
                                <input type="date" wire:model="entdate" id="entdate"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('entdate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                                <select wire:model="status" id="status"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                                @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- School -->
                            <div>
                                <label for="schoolId" class="block text-sm font-medium text-gray-700">School</label>
                                <select wire:model="schoolId" id="schoolId"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Select School</option>
                                    @foreach($schools as $school)
                                    <option value="{{ $school['id'] }}">{{ $school['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('schoolId') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Previous Session -->
                            <div>
                                <label for="prevSessionId" class="block text-sm font-medium text-gray-700">Previous
                                    Session</label>
                                <select wire:model="prevSessionId" id="prevSessionId"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Select Previous Session</option>
                                    @foreach($sessions as $session)
                                    @if($session['id'] != $editingId)
                                    <option value="{{ $session['id'] }}">{{ $session['name'] }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('prevSessionId') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Next Session -->
                            <div>
                                <label for="nextSessionId" class="block text-sm font-medium text-gray-700">Next
                                    Session</label>
                                <select wire:model="nextSessionId" id="nextSessionId"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Select Next Session</option>
                                    @foreach($sessions as $session)
                                    @if($session['id'] != $editingId)
                                    <option value="{{ $session['id'] }}">{{ $session['name'] }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('nextSessionId') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Remark -->
                            <div class="col-span-2">
                                <label for="remark" class="block text-sm font-medium text-gray-700">Remark</label>
                                <input type="text" wire:model="remark" id="remark"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @error('remark') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3 mt-6">
                            <button type="button" wire:click="hideModal"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
                                Cancel
                            </button>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                {{ $editingId ? 'Update' : 'Create' }} Session
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>

@endif