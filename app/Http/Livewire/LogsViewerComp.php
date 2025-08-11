<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class LogsViewerComp extends Component
{

    public $selectedLogFile = '';
    public $logFiles = [];
    public $logEntries = [];
    public $filterLevel = '';
    public $filterDate = '';
    public $searchTerm = '';
    public $showStackTrace = [];
    public $perPage = 50;
    public $sortOrder = 'desc'; // desc = newest first, asc = oldest first
    public $page = 1;

    // Log levels with colors and icons
    protected $logLevels = [
        'emergency' => ['color' => 'red', 'bg' => 'bg-red-100', 'text' => 'text-red-800', 'icon' => '🚨'],
        'alert' => ['color' => 'red', 'bg' => 'bg-red-100', 'text' => 'text-red-700', 'icon' => '🔥'],
        'critical' => ['color' => 'red', 'bg' => 'bg-red-100', 'text' => 'text-red-700', 'icon' => '💥'],
        'error' => ['color' => 'red', 'bg' => 'bg-red-50', 'text' => 'text-red-600', 'icon' => '❌'],
        'warning' => ['color' => 'yellow', 'bg' => 'bg-yellow-50', 'text' => 'text-yellow-700', 'icon' => '⚠️'],
        'notice' => ['color' => 'blue', 'bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'icon' => '📢'],
        'info' => ['color' => 'green', 'bg' => 'bg-green-50', 'text' => 'text-green-600', 'icon' => 'ℹ️'],
        'debug' => ['color' => 'gray', 'bg' => 'bg-gray-50', 'text' => 'text-gray-600', 'icon' => '🐛'],
    ];

    public function mount()
    {
        try {
            $this->loadLogFiles();
            if (!empty($this->logFiles)) {
                $this->selectedLogFile = $this->logFiles[0]['name'];
                $this->loadLogEntries();
            }
        } catch (\Exception $e) {
            Log::error('Error in LogsViewerComp mount: ' . $e->getMessage());
            session()->flash('error', 'Error loading logs: ' . $e->getMessage());
        }
    }

    protected function loadLogFiles()
    {
        try {
            $logPath = storage_path('logs');
            $files = File::files($logPath);

            $this->logFiles = [];
            foreach ($files as $file) {
                if ($file->getExtension() === 'log') {
                    $this->logFiles[] = [
                        'name' => $file->getFilename(),
                        'path' => $file->getPathname(),
                        'size' => $this->formatBytes($file->getSize()),
                        'modified' => Carbon::createFromTimestamp($file->getMTime())->format('Y-m-d H:i:s'),
                        'age' => Carbon::createFromTimestamp($file->getMTime())->diffForHumans(),
                    ];
                }
            }

            // Sort by modification time (newest first)
            usort($this->logFiles, function ($a, $b) {
                return strcmp($b['modified'], $a['modified']);
            });
        } catch (\Exception $e) {
            Log::error('Error loading log files: ' . $e->getMessage());
            $this->logFiles = [];
        }
    }

    protected function loadLogEntries()
    {
        try {
            if (empty($this->selectedLogFile)) {
                $this->logEntries = [];
                return;
            }

            $logPath = storage_path('logs/' . $this->selectedLogFile);
            if (!File::exists($logPath)) {
                $this->logEntries = [];
                return;
            }

            $content = File::get($logPath);
            $this->logEntries = $this->parseLogContent($content);

            // Apply filters
            $this->applyFilters();
        } catch (\Exception $e) {
            Log::error('Error loading log entries: ' . $e->getMessage());
            $this->logEntries = [];
            session()->flash('error', 'Error reading log file: ' . $e->getMessage());
        }
    }

    protected function parseLogContent($content)
    {
        $entries = [];
        $lines = explode("\n", $content);
        $currentEntry = null;

        foreach ($lines as $line) {
            // Check if line starts with a log pattern [YYYY-MM-DD HH:MM:SS]
            if (preg_match('/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\].*?\.(\w+): (.*)$/', $line, $matches)) {
                // Save previous entry if exists
                if ($currentEntry) {
                    $entries[] = $currentEntry;
                }

                // Start new entry
                $currentEntry = [
                    'id' => uniqid(),
                    'timestamp' => $matches[1],
                    'level' => strtolower($matches[2]),
                    'message' => $matches[3],
                    'context' => '',
                    'stack_trace' => '',
                    'formatted_time' => Carbon::parse($matches[1])->format('M d, Y H:i:s'),
                    'relative_time' => Carbon::parse($matches[1])->diffForHumans(),
                ];
            } elseif ($currentEntry && !empty(trim($line))) {
                // This is a continuation line (context or stack trace)
                if (strpos($line, 'Stack trace:') !== false || strpos($line, '#') === 0) {
                    $currentEntry['stack_trace'] .= $line . "\n";
                } else {
                    $currentEntry['context'] .= $line . "\n";
                }
            }
        }

        // Add the last entry
        if ($currentEntry) {
            $entries[] = $currentEntry;
        }

        return $entries;
    }

    protected function applyFilters()
    {
        $filtered = $this->logEntries;

        // Filter by level
        if (!empty($this->filterLevel)) {
            $filtered = array_filter($filtered, function ($entry) {
                return $entry['level'] === $this->filterLevel;
            });
        }

        // Filter by date
        if (!empty($this->filterDate)) {
            $filtered = array_filter($filtered, function ($entry) {
                return strpos($entry['timestamp'], $this->filterDate) === 0;
            });
        }

        // Filter by search term
        if (!empty($this->searchTerm)) {
            $searchTerm = strtolower($this->searchTerm);
            $filtered = array_filter($filtered, function ($entry) use ($searchTerm) {
                return strpos(strtolower($entry['message']), $searchTerm) !== false ||
                    strpos(strtolower($entry['context']), $searchTerm) !== false;
            });
        }

        // Sort entries
        if ($this->sortOrder === 'desc') {
            $filtered = array_reverse($filtered);
        }

        $this->logEntries = array_values($filtered);
    }

    public function selectLogFile($filename)
    {
        $this->selectedLogFile = $filename;
        $this->page = 1;
        $this->loadLogEntries();
    }

    public function updatedFilterLevel()
    {
        $this->page = 1;
        $this->loadLogEntries();
    }

    public function updatedFilterDate()
    {
        $this->page = 1;
        $this->loadLogEntries();
    }

    public function updatedSearchTerm()
    {
        $this->page = 1;
        $this->loadLogEntries();
    }

    public function resetPage()
    {
        $this->page = 1;
    }

    public function nextPage()
    {
        $totalPages = ceil(count($this->logEntries) / $this->perPage);
        if ($this->page < $totalPages) {
            $this->page++;
        }
    }

    public function previousPage()
    {
        if ($this->page > 1) {
            $this->page--;
        }
    }

    public function gotoPage($page)
    {
        $totalPages = ceil(count($this->logEntries) / $this->perPage);
        if ($page >= 1 && $page <= $totalPages) {
            $this->page = $page;
        }
    }

    public function toggleSortOrder()
    {
        $this->sortOrder = $this->sortOrder === 'desc' ? 'asc' : 'desc';
        $this->loadLogEntries();
    }

    public function toggleStackTrace($entryId)
    {
        if (isset($this->showStackTrace[$entryId])) {
            unset($this->showStackTrace[$entryId]);
        } else {
            $this->showStackTrace[$entryId] = true;
        }
    }

    public function clearLogs()
    {
        try {
            if (!empty($this->selectedLogFile)) {
                $logPath = storage_path('logs/' . $this->selectedLogFile);
                File::put($logPath, '');
                $this->loadLogEntries();
                session()->flash('message', 'Log file cleared successfully!');
            }
        } catch (\Exception $e) {
            Log::error('Error clearing logs: ' . $e->getMessage());
            session()->flash('error', 'Error clearing log file: ' . $e->getMessage());
        }
    }

    public function downloadLog()
    {
        try {
            if (!empty($this->selectedLogFile)) {
                $logPath = storage_path('logs/' . $this->selectedLogFile);
                return response()->download($logPath);
            }
        } catch (\Exception $e) {
            Log::error('Error downloading log: ' . $e->getMessage());
            session()->flash('error', 'Error downloading log file: ' . $e->getMessage());
        }
    }

    public function refreshLogs()
    {
        $this->loadLogFiles();
        $this->loadLogEntries();
        session()->flash('message', 'Logs refreshed successfully!');
    }

    protected function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');
        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }

    public function getLogLevelStyle($level)
    {
        return $this->logLevels[$level] ?? $this->logLevels['debug'];
    }

    public function render()
    {
        $currentPage = $this->page ?? 1;
        $paginatedEntries = collect($this->logEntries)
            ->forPage($currentPage, $this->perPage)
            ->values()
            ->toArray();

        return view('livewire.logs-viewer-comp', [
            'paginatedEntries' => $paginatedEntries,
            'totalEntries' => count($this->logEntries),
            'logLevels' => array_keys($this->logLevels),
        ]);
    }
}
