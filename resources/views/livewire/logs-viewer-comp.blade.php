<div class="flex-1 p-6 overflow-y-auto max-w-full mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">System Logs Viewer</h1>
                <p class="mt-1 text-sm text-gray-600">Monitor and analyze application logs for debugging and system
                    health</p>
            </div>
            <div class="flex space-x-2">
                <button wire:click="refreshLogs"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                    🔄 Refresh
                </button>
                @if(!empty($selectedLogFile))
                    <button wire:click="downloadLog"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                        📥 Download
                    </button>
                    <button wire:click="clearLogs" onclick="return confirm('Are you sure you want to clear this log file?')"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium">
                        🗑️ Clear
                    </button>
                @endif
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

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Sidebar - Log Files -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">Log Files</h3>
                    <p class="text-sm text-gray-600 mt-1">{{ count($logFiles) }} files found</p>
                </div>
                <div class="max-h-96 overflow-y-auto">
                    @forelse($logFiles as $file)
                        <div wire:click="selectLogFile('{{ $file['name'] }}')"
                            class="p-3 border-b border-gray-100 cursor-pointer hover:bg-gray-50 {{ $selectedLogFile === $file['name'] ? 'bg-blue-50 border-l-4 border-l-blue-500' : '' }}">
                            <div class="font-medium text-sm text-gray-900">{{ $file['name'] }}</div>
                            <div class="text-xs text-gray-500 mt-1">
                                <div>Size: {{ $file['size'] }}</div>
                                <div>Modified: {{ $file['age'] }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center text-gray-500">
                            <div class="text-sm">No log files found</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Main Content - Log Entries -->
        <div class="lg:col-span-3">
            @if(!empty($selectedLogFile))
                <!-- Filters -->
                <div class="bg-white rounded-lg shadow p-4 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Log Level Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Log Level</label>
                            <select wire:model="filterLevel"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                                <option value="">All Levels</option>
                                @foreach($logLevels as $level)
                                    <option value="{{ $level }}">{{ ucfirst($level) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                            <input type="date" wire:model="filterDate"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                        </div>

                        <!-- Search -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                            <input type="text" wire:model.debounce.300ms="searchTerm" placeholder="Search in messages..."
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                        </div>

                        <!-- Sort Order -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sort</label>
                            <button wire:click="toggleSortOrder"
                                class="w-full bg-gray-100 hover:bg-gray-200 border border-gray-300 rounded-md px-3 py-2 text-sm font-medium">
                                {{ $sortOrder === 'desc' ? '🔽 Newest First' : '🔼 Oldest First' }}
                            </button>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex justify-between items-center text-sm text-gray-600">
                            <div>Showing {{ count($paginatedEntries) }} of {{ $totalEntries }} entries</div>
                            <div>File: <span class="font-medium">{{ $selectedLogFile }}</span></div>
                        </div>
                    </div>
                </div>

                <!-- Log Entries -->
                <div class="space-y-3">
                    @forelse($paginatedEntries as $entry)
                        @php
                            $levelStyle = $this->getLogLevelStyle($entry['level']);
                        @endphp
                        <div
                            class="bg-white rounded-lg shadow border-l-4 border-l-{{ $levelStyle['color'] }}-500 overflow-hidden">
                            <div class="p-4">
                                <!-- Header -->
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center space-x-3">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $levelStyle['bg'] }} {{ $levelStyle['text'] }}">
                                            {{ $levelStyle['icon'] }} {{ strtoupper($entry['level']) }}
                                        </span>
                                        <div class="text-sm text-gray-500">
                                            <div>{{ $entry['formatted_time'] }}</div>
                                            <div class="text-xs">{{ $entry['relative_time'] }}</div>
                                        </div>
                                    </div>

                                    @if(!empty($entry['stack_trace']))
                                        <button wire:click="toggleStackTrace('{{ $entry['id'] }}')"
                                            class="text-xs bg-gray-100 hover:bg-gray-200 px-2 py-1 rounded">
                                            {{ isset($showStackTrace[$entry['id']]) ? 'Hide' : 'Show' }} Stack Trace
                                        </button>
                                    @endif
                                </div>

                                <!-- Message -->
                                <div class="mt-3">
                                    <div class="text-sm text-gray-900 font-medium">{{ $entry['message'] }}</div>

                                    @if(!empty($entry['context']))
                                        <div
                                            class="mt-2 p-3 bg-gray-50 rounded text-xs text-gray-700 font-mono whitespace-pre-wrap">
                                            {{ trim($entry['context']) }}
                                        </div>
                                    @endif
                                </div>

                                <!-- Stack Trace -->
                                @if(!empty($entry['stack_trace']) && isset($showStackTrace[$entry['id']]))
                                    <div class="mt-3 p-3 bg-red-50 border border-red-200 rounded">
                                        <div class="text-xs font-medium text-red-800 mb-2">Stack Trace:</div>
                                        <pre
                                            class="text-xs text-red-700 whitespace-pre-wrap overflow-x-auto">{{ trim($entry['stack_trace']) }}</pre>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-lg shadow p-8 text-center">
                            <div class="text-gray-500">
                                <div class="text-lg font-medium mb-2">No log entries found</div>
                                <div class="text-sm">
                                    @if(!empty($filterLevel) || !empty($filterDate) || !empty($searchTerm))
                                        Try adjusting your filters or search terms.
                                    @else
                                        The selected log file appears to be empty.
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Custom Pagination -->
                @if($totalEntries > $perPage)
                    @php
                        $totalPages = ceil($totalEntries / $perPage);
                        $currentPage = $page;
                    @endphp
                    <div class="mt-6 flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <button wire:click="previousPage" @if($currentPage <= 1) disabled @endif
                                class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                Previous
                            </button>

                            <div class="flex items-center space-x-1">
                                @for($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++)
                                    <button wire:click="gotoPage({{ $i }})"
                                        class="px-3 py-2 text-sm font-medium {{ $i === $currentPage ? 'text-indigo-600 bg-indigo-50 border-indigo-500' : 'text-gray-500 bg-white hover:bg-gray-50' }} border border-gray-300 rounded-md">
                                        {{ $i }}
                                    </button>
                                @endfor
                            </div>

                            <button wire:click="nextPage" @if($currentPage >= $totalPages) disabled @endif
                                class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                Next
                            </button>
                        </div>

                        <div class="text-sm text-gray-700">
                            Page {{ $currentPage }} of {{ $totalPages }} ({{ $totalEntries }} total entries)
                        </div>
                    </div>
                @endif
            @else
                <div class="bg-white rounded-lg shadow p-8 text-center">
                    <div class="text-gray-500">
                        <div class="text-lg font-medium mb-2">Select a log file</div>
                        <div class="text-sm">Choose a log file from the sidebar to view its contents.</div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>