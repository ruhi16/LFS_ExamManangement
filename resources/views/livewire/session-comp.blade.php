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
            @if($sessions->where('status', '!=', 'active')->count() > 0)
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <div class="relative">
                        <select wire:change="setActiveSession($event.target.value)"
                            class="w-full text-xs border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Switch Session...</option>
                            @foreach($sessions->where('status', '!=', 'active') as $session)
                                <option value="{{ $session->id }}">{{ $session->name }}</option>
                            @endforeach
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
    <!-- Full Settings Page Mode -->
    <div class="p-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Session Management</h1>
                <p class="text-gray-600 mt-1">Manage academic sessions and set active session</p>
            </div>
            <div class="flex space-x-3">
                <button wire:click="testConnection"
                    class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                    <i class="fas fa-database mr-2"></i>Test DB
                </button>
                <button wire:click="refreshData"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                    <i class="fas fa-sync-alt mr-2"></i>Refresh
                </button>
                <button wire:click="openModal"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>Add Session
                </button>
            </div>
        </div>

        <!-- Flash Messages -->
        @if (session()->has('message'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md">
                <div class="flex">
                    <i class="fas fa-check-circle mr-2 mt-0.5"></i>
                    {{ session('message') }}
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md">
                <div class="flex">
                    <i class="fas fa-exclamation-circle mr-2 mt-0.5"></i>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- Debug Info -->
        <div class="mb-4 bg-yellow-50 border border-yellow-200 text-yellow-700 px-4 py-3 rounded-md text-sm">
            <strong>Debug:</strong>
            Sessions: {{ $sessions ? $sessions->count() : 'null' }} |
            Active Session: {{ $activeSession ? $activeSession->name : 'none' }} |
            Widget Mode: {{ $showWidget ? 'yes' : 'no' }}
        </div>

        <!-- Active Session Card -->
        @if($activeSession)
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg text-white p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold">{{ $activeSession->name }}</h2>
                        <p class="text-blue-100 mt-1">{{ $this->getSessionDuration($activeSession) }}</p>
                        @if($activeSession->details)
                            <p class="text-blue-100 text-sm mt-2">{{ $activeSession->details }}</p>
                        @endif
                    </div>
                    <div class="text-right">
                        <div class="bg-blue-400 bg-opacity-30 rounded-full p-3 mb-2">
                            <i class="fas fa-calendar-check text-2xl"></i>
                        </div>
                        <span class="text-sm font-medium">Active Session</span>
                    </div>
                </div>
            </div>
        @endif

        <!-- Sessions Table -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">All Sessions
                    <span class="text-sm text-gray-500">
                        ({{ $sessions ? $sessions->count() : 0 }} found)
                    </span>
                </h3>
            </div>

            @if($sessions && $sessions->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Session Details
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Duration
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($sessions as $session)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 flex items-center">
                                                {{ $session->name }}
                                                @if($session->status === 'active')
                                                    <i class="fas fa-star text-yellow-500 ml-2" title="Active Session"></i>
                                                @endif
                                                @if($this->isSessionCurrent($session))
                                                    <i class="fas fa-clock text-green-500 ml-2" title="Current Period"></i>
                                                @endif
                                            </div>
                                            @if($session->details)
                                                <div class="text-sm text-gray-500">{{ $session->details }}</div>
                                            @endif
                                            @if($session->remark)
                                                <div class="text-xs text-gray-400 mt-1">{{ $session->remark }}</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            <div>{{ \Carbon\Carbon::parse($session->stdate)->format('d M Y') }}</div>
                                            <div class="text-gray-500">to
                                                {{ \Carbon\Carbon::parse($session->entdate)->format('d M Y') }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $this->getSessionStatusColor($session->status) }}">
                                            {{ ucfirst($session->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            @if($session->status !== 'active')
                                                <button wire:click="setActiveSession({{ $session->id }})"
                                                    class="text-green-600 hover:text-green-900 transition-colors" title="Set as Active">
                                                    <i class="fas fa-check-circle"></i>
                                                </button>
                                            @endif
                                            <button wire:click="openModal({{ $session->id }})"
                                                class="text-blue-600 hover:text-blue-900 transition-colors" title="Edit Session">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button wire:click="delete({{ $session->id }})"
                                                onclick="return confirm('Are you sure you want to delete this session?')"
                                                class="text-red-600 hover:text-red-900 transition-colors" title="Delete Session">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <div class="text-gray-400 mb-4">
                        <i class="fas fa-calendar-times text-6xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Sessions Found</h3>
                    <p class="text-gray-600 mb-4">Get started by creating your first academic session.</p>
                    <button wire:click="openModal"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Create Session
                    </button>
                </div>
            @endif
        </div>
    </div>
@endif

<!-- Modal -->
@if($showModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900">
                    {{ $editMode ? 'Edit Session' : 'Create New Session' }}
                </h3>
                <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Session Name -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Session Name *</label>
                        <input type="text" wire:model="name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="e.g., Academic Year 2024-25">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Start Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Start Date *</label>
                        <input type="date" wire:model="stdate"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('stdate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- End Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">End Date *</label>
                        <input type="date" wire:model="entdate"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('entdate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                        <select wire:model="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="completed">Completed</option>
                            <option value="upcoming">Upcoming</option>
                        </select>
                        @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Previous Session -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Previous Session</label>
                        <select wire:model="prev_session_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Previous Session</option>
                            @foreach($availableSessions as $session)
                                <option value="{{ $session->id }}">{{ $session->name }}</option>
                            @endforeach
                        </select>
                        @error('prev_session_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Details -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Details</label>
                        <textarea wire:model="details" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Session description or additional details..."></textarea>
                        @error('details') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Remarks -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Remarks</label>
                        <textarea wire:model="remark" rows="2"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Any additional remarks..."></textarea>
                        @error('remark') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end items-center p-6 border-t border-gray-200 space-x-3">
                <button wire:click="closeModal"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                    Cancel
                </button>
                <button wire:click="save"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-save mr-2"></i>{{ $editMode ? 'Update' : 'Create' }} Session
                </button>
            </div>
        </div>
    </div>
@endif