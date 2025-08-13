<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Session;
use App\Models\School;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class SessionComp extends Component
{
    // Modal properties
    public $showModal = false;
    public $editMode = false;
    public $sessionId = null;

    // Form properties
    public $name;
    public $details;
    public $stdate;
    public $entdate;
    public $status = 'active';
    public $remark;
    public $prev_session_id;
    public $next_session_id;
    public $school_id = 1; // Default school

    // Display properties
    public $activeSession = null;
    public $sessions;
    public $showWidget = false; // For dashboard widget mode

    protected $rules = [
        'name' => 'required|string|max:255',
        'details' => 'nullable|string|max:500',
        'stdate' => 'required|date',
        'entdate' => 'required|date|after:stdate',
        'status' => 'required|in:active,inactive,completed,upcoming',
        'remark' => 'nullable|string|max:500',
        'prev_session_id' => 'nullable|exists:sessions,id',
        'next_session_id' => 'nullable|exists:sessions,id',
        'school_id' => 'required|integer',
    ];

    protected $messages = [
        'name.required' => 'Session name is required.',
        'stdate.required' => 'Start date is required.',
        'entdate.required' => 'End date is required.',
        'entdate.after' => 'End date must be after start date.',
        'status.required' => 'Status is required.',
    ];

    public function mount($widget = false)
    {
        $this->showWidget = $widget;
        $this->sessions = collect(); // Initialize as empty collection
        $this->loadSessions();
        $this->loadActiveSession();
    }

    public function loadSessions()
    {
        try {
            $this->sessions = Session::orderBy('stdate', 'desc')->get();
            Log::info('Loaded ' . $this->sessions->count() . ' sessions');
        } catch (\Exception $e) {
            Log::error('Error loading sessions: ' . $e->getMessage());
            $this->sessions = collect();
        }
    }

    public function loadActiveSession()
    {
        try {
            $this->activeSession = Session::where('status', 'active')->first();
            if (!$this->activeSession) {
                // If no active session, get the most recent one
                $this->activeSession = Session::orderBy('stdate', 'desc')->first();
            }
        } catch (\Exception $e) {
            Log::error('Error loading active session: ' . $e->getMessage());
            $this->activeSession = null;
        }
    }

    public function openModal($sessionId = null)
    {
        try {
            $this->resetForm();

            if ($sessionId) {
                Log::info('Opening modal for edit session: ' . $sessionId);
                $this->editMode = true;
                $this->sessionId = $sessionId;
                $this->loadSessionData($sessionId);
            } else {
                Log::info('Opening modal for new session');
                $this->editMode = false;
                $this->sessionId = null;
                // Set default dates for new session
                $this->stdate = now()->format('Y-m-d');
                $this->entdate = now()->addYear()->format('Y-m-d');
            }

            $this->showModal = true;
            Log::info('Modal opened successfully. Edit mode: ' . ($this->editMode ? 'true' : 'false'));
        } catch (\Exception $e) {
            Log::error('Error opening modal: ' . $e->getMessage());
            session()->flash('error', 'Error opening modal: ' . $e->getMessage());
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'details',
            'stdate',
            'entdate',
            'status',
            'remark',
            'prev_session_id',
            'next_session_id'
        ]);
        $this->school_id = 1;
        $this->editMode = false;
        $this->sessionId = null;
    }

    private function loadSessionData($sessionId)
    {
        try {
            $session = Session::findOrFail($sessionId);

            $this->name = $session->name;
            $this->details = $session->details;
            $this->stdate = $session->stdate;
            $this->entdate = $session->entdate;
            $this->status = $session->status ?? 'active';
            $this->remark = $session->remark;
            $this->prev_session_id = $session->prev_session_id;
            $this->next_session_id = $session->next_session_id;
            $this->school_id = $session->school_id ?? 1;
        } catch (\Exception $e) {
            Log::error('Error loading session data: ' . $e->getMessage());
            session()->flash('error', 'Error loading session data.');
        }
    }

    public function save()
    {
        try {
            $this->validate();
        } catch (\Exception $e) {
            Log::error('Validation error: ' . $e->getMessage());
            session()->flash('error', 'Validation failed: ' . $e->getMessage());
            return;
        }

        try {
            $data = [
                'name' => $this->name,
                'details' => $this->details,
                'stdate' => $this->stdate,
                'entdate' => $this->entdate,
                'status' => $this->status,
                'remark' => $this->remark,
                'prev_session_id' => $this->prev_session_id ?: null,
                'next_session_id' => $this->next_session_id ?: null,
                'school_id' => $this->school_id ?: 1,
            ];

            Log::info('Attempting to save session with data: ', $data);

            if ($this->editMode && $this->sessionId) {
                $session = Session::findOrFail($this->sessionId);
                $session->update($data);
                Log::info('Session updated successfully: ' . $session->id);
                session()->flash('message', 'Session updated successfully!');
            } else {
                $session = Session::create($data);
                Log::info('Session created successfully: ' . $session->id);
                session()->flash('message', 'Session created successfully!');
            }

            $this->loadSessions();
            $this->loadActiveSession();
            $this->closeModal();
        } catch (\Exception $e) {
            Log::error('Error saving session: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            session()->flash('error', 'Error saving session: ' . $e->getMessage());
        }
    }

    public function delete($sessionId)
    {
        try {
            $session = Session::findOrFail($sessionId);

            // Check if session has related data
            $hasRelatedData = $session->studentdbs()->exists() ||
                $session->studentcrs()->exists() ||
                $session->myclasses()->exists();

            if ($hasRelatedData) {
                session()->flash('error', 'Cannot delete session with related data. Please remove related records first.');
                return;
            }

            $session->delete();
            session()->flash('message', 'Session deleted successfully!');

            $this->loadSessions();
            $this->loadActiveSession();
        } catch (\Exception $e) {
            Log::error('Error deleting session: ' . $e->getMessage());
            session()->flash('error', 'Error deleting session: ' . $e->getMessage());
        }
    }

    public function setActiveSession($sessionId)
    {
        try {
            // Set all sessions to inactive
            Session::query()->update(['status' => 'inactive']);

            // Set selected session as active
            $session = Session::findOrFail($sessionId);
            $session->update(['status' => 'active']);

            $this->loadSessions();
            $this->loadActiveSession();

            session()->flash('message', "Session '{$session->name}' is now active!");
        } catch (\Exception $e) {
            Log::error('Error setting active session: ' . $e->getMessage());
            session()->flash('error', 'Error setting active session: ' . $e->getMessage());
        }
    }

    public function getSessionStatusColor($status)
    {
        switch ($status) {
            case 'active':
                return 'bg-green-100 text-green-800';
            case 'inactive':
                return 'bg-gray-100 text-gray-800';
            case 'completed':
                return 'bg-blue-100 text-blue-800';
            case 'upcoming':
                return 'bg-yellow-100 text-yellow-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    }

    public function getSessionDuration($session)
    {
        try {
            $start = Carbon::parse($session->stdate);
            $end = Carbon::parse($session->entdate);
            return $start->format('M Y') . ' - ' . $end->format('M Y');
        } catch (\Exception $e) {
            return 'Invalid dates';
        }
    }

    public function isSessionCurrent($session)
    {
        try {
            $now = Carbon::now();
            $start = Carbon::parse($session->stdate);
            $end = Carbon::parse($session->entdate);
            return $now->between($start, $end);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function refreshData()
    {
        $this->loadSessions();
        $this->loadActiveSession();
        session()->flash('message', 'Session data refreshed successfully!');
    }

    public function testConnection()
    {
        try {
            $count = Session::count();
            session()->flash('message', "Database connection successful. Found {$count} sessions.");
            Log::info("Test connection successful. Sessions count: {$count}");
        } catch (\Exception $e) {
            session()->flash('error', 'Database connection failed: ' . $e->getMessage());
            Log::error('Test connection failed: ' . $e->getMessage());
        }
    }

    public function render()
    {
        // Ensure sessions is always a collection
        if (!$this->sessions instanceof \Illuminate\Support\Collection) {
            $this->sessions = collect();
        }

        return view('livewire.session-comp', [
            'availableSessions' => $this->sessions->where('id', '!=', $this->sessionId ?? 0),
        ]);
    }
}
