<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Session;
use App\Models\School;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SessionComp extends Component
{
    public $sessions = [];
    public $schools = [];

    public $showWidget = false;
    public $activeSession = null;


    // Modal properties
    public $showModal = false;
    public $editingId = null;
    public $name = '';
    public $details = '';
    public $stdate = '';
    public $entdate = '';
    public $status = 'Active';
    public $remark = '';
    public $prevSessionId = null;
    public $nextSessionId = null;
    public $schoolId = null;

    protected $rules = [
        'name' => 'required|string|max:255',
        'details' => 'nullable|string|max:500',
        'stdate' => 'required|date',
        'entdate' => 'required|date|after:stdate',
        'status' => 'required|in:Active,Inactive',
        'remark' => 'nullable|string|max:255',
        'prevSessionId' => 'nullable|exists:sessions,id',
        'nextSessionId' => 'nullable|exists:sessions,id',
        'schoolId' => 'nullable|exists:schools,id'
    ];

    protected $messages = [
        'name.required' => 'Session name is required.',
        'name.max' => 'Session name cannot exceed 255 characters.',
        'stdate.required' => 'Start date is required.',
        'entdate.required' => 'End date is required.',
        'entdate.after' => 'End date must be after start date.',
        'status.in' => 'Status must be either Active or Inactive.',
        'prevSessionId.exists' => 'Selected previous session is invalid.',
        'nextSessionId.exists' => 'Selected next session is invalid.',
        'schoolId.exists' => 'Selected school is invalid.'
    ];

    public function mount($widget = false)
    {
        $this->showWidget = $widget;


        $this->loadSessions();
        // $this->loadSchools();
        $this->loadActiveSession();
    }

    protected function loadSessions()
    {
        $this->sessions = Session::with(['school', 'previousSession', 'nextSession'])
            ->withCount(['myclasses', 'sections', 'subjects', 'studentdbs', 'studentcrs', 'exams'])
            ->orderBy('stdate', 'desc')
            ->get()
            ->map(function ($session) {
                return [
                    'id' => $session->id,
                    'name' => $session->name,
                    'details' => $session->details,
                    'stdate' => $session->stdate,
                    'entdate' => $session->entdate,
                    'status' => $session->status,
                    'remark' => $session->remark,
                    'prev_session_id' => $session->prev_session_id,
                    'next_session_id' => $session->next_session_id,
                    'school_id' => $session->school_id,
                    'school_name' => $session->school->name ?? 'No School',
                    'prev_session_name' => $session->previousSession->name ?? 'None',
                    'next_session_name' => $session->nextSession->name ?? 'None',
                    'myclasses_count' => $session->myclasses_count,
                    'sections_count' => $session->sections_count,
                    'subjects_count' => $session->subjects_count,
                    'studentdbs_count' => $session->studentdbs_count,
                    'studentcrs_count' => $session->studentcrs_count,
                    'exams_count' => $session->exams_count,
                    'created_at' => $session->created_at,
                    'updated_at' => $session->updated_at
                ];
            })
            ->toArray();
    }

    protected function loadSchools()
    {
        $this->schools = School::where('is_active', true)
            ->orderBy('name')
            ->get()
            ->toArray();
    }

    public function loadActiveSession()
    {
        try {
            // First try to get active session
            $this->activeSession = Session::where('status', 'active')->first();

            if (!$this->activeSession) {
                // If no active session, get the most recent one using query builder
                $this->activeSession = Session::query()->orderBy('stdate', 'desc')->first();
            }

            Log::info('Active session loaded: ' . ($this->activeSession ? $this->activeSession->name : 'None'));
        } catch (\Exception $e) {
            Log::error('Error loading active session: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            $this->activeSession = null;
        }
    }

    public function showAddModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function hideModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function editSession($id)
    {
        $session = collect($this->sessions)->firstWhere('id', $id);

        if (!$session) {
            session()->flash('error', 'Session not found.');
            return;
        }

        $this->editingId = $id;
        $this->name = $session['name'];
        $this->details = $session['details'];
        $this->stdate = $session['stdate'];
        $this->entdate = $session['entdate'];
        $this->status = $session['status'];
        $this->remark = $session['remark'];
        $this->prevSessionId = $session['prev_session_id'];
        $this->nextSessionId = $session['next_session_id'];
        $this->schoolId = $session['school_id'];
        $this->showModal = true;
    }


    public function saveSession()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $data = [
                'name' => $this->name,
                'details' => $this->details,
                'stdate' => $this->stdate,
                'entdate' => $this->entdate,
                'status' => $this->status,
                'remark' => $this->remark,
                'prev_session_id' => $this->prevSessionId,
                'next_session_id' => $this->nextSessionId,
                'school_id' => $this->schoolId,
            ];

            if ($this->editingId) {
                // Update existing
                $session = Session::findOrFail($this->editingId);
                $session->update($data);
                session()->flash('message', 'Session updated successfully!');
            } else {
                // Create new
                Session::create($data);
                session()->flash('message', 'Session created successfully!');
            }

            DB::commit();

            $this->loadSessions();
            $this->hideModal();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving session: ' . $e->getMessage());
            session()->flash('error', 'Error saving session: ' . $e->getMessage());
        }
    }

    public function deleteSession($id)
    {
        try {
            DB::beginTransaction();

            $session = Session::findOrFail($id);

            // Check if session has related data
            if ($session->myclasses()->count() > 0 || 
                $session->sections()->count() > 0 || 
                $session->subjects()->count() > 0 || 
                $session->studentdbs()->count() > 0 || 
                $session->studentcrs()->count() > 0 || 
                $session->exams()->count() > 0) {
                session()->flash('error', 'Cannot delete session with existing related data.');
                return;
            }

            $session->delete();

            DB::commit();

            session()->flash('message', 'Session deleted successfully!');
            $this->loadSessions();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting session: ' . $e->getMessage());
            session()->flash('error', 'Error deleting session: ' . $e->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        try {
            $session = Session::findOrFail($id);
            $newStatus = $session->status === 'Active' ? 'Inactive' : 'Active';
            $session->update(['status' => $newStatus]);

            session()->flash('message', 'Status updated successfully!');
            $this->loadSessions();
        } catch (\Exception $e) {
            Log::error('Error toggling status: ' . $e->getMessage());
            session()->flash('error', 'Error updating status: ' . $e->getMessage());
        }
    }

    protected function resetForm()
    {
        $this->editingId = null;
        $this->name = '';
        $this->details = '';
        $this->stdate = '';
        $this->entdate = '';
        $this->status = 'Active';
        $this->remark = '';
        $this->prevSessionId = null;
        $this->nextSessionId = null;
        $this->schoolId = null;
        $this->resetErrorBag();
    }

    public function refreshData()
    {
        try {
            $this->loadSessions();
            $this->loadSchools();
            session()->flash('message', 'Data refreshed successfully!');
        } catch (\Exception $e) {
            Log::error('Error refreshing data: ' . $e->getMessage());
            session()->flash('error', 'Error refreshing data: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.session-comp');
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
            $start = \Carbon\Carbon::parse($session->stdate);
            $end = \Carbon\Carbon::parse($session->entdate);
            return $start->format('M Y') . ' - ' . $end->format('M Y');
        } catch (\Exception $e) {
            return 'Invalid dates';
        }
    }

    public function isSessionCurrent($session)
    {
        try {
            $now = \Carbon\Carbon::now();
            $start = \Carbon\Carbon::parse($session->stdate);
            $end = \Carbon\Carbon::parse($session->entdate);
            return $now->between($start, $end);
        } catch (\Exception $e) {
            return false;
        }
    }

} 