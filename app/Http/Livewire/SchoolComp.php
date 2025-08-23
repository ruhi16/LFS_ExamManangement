<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\School;
use App\Models\Session;
use Illuminate\Support\Facades\Log;

class SchoolComp extends Component
{
    use WithPagination;

    // Modal properties
    public $showModal = false;
    public $editMode = false;
    public $schoolId = null;

    // Form properties (from migration)
    public $session_id;
    public $name;
    public $code;
    public $details;
    public $vill;
    public $po;
    public $ps;
    public $pin;
    public $dist;
    public $index;
    public $hscode;
    public $disecode;
    public $estd;
    public $status = 'active';
    public $remark;

    // UI state
    public $searchTerm = '';
    protected $schools;

    protected $rules = [
        'name' => 'required|string|max:255',
        'session_id' => 'required|integer',
        'code' => 'nullable|string|max:255',
        'details' => 'nullable|string|max:1000',
        'vill' => 'nullable|string|max:255',
        'po' => 'nullable|string|max:255',
        'ps' => 'nullable|string|max:255',
        'pin' => 'nullable|string|max:20',
        'dist' => 'nullable|string|max:255',
        'index' => 'nullable|string|max:255',
        'hscode' => 'nullable|string|max:255',
        'disecode' => 'nullable|string|max:255',
        'estd' => 'nullable|string|max:255',
        'status' => 'nullable|string|max:50',
        'remark' => 'nullable|string|max:500',
    ];

    protected $messages = [
        'name.required' => 'School name is required.',
        'session_id.required' => 'Session is required.',
    ];

    public function mount()
    {
        try {
            $this->initializeDefaults();
            $this->loadSchools();
        } catch (\Exception $e) {
            Log::error('Error in SchoolComp mount: ' . $e->getMessage());
            session()->flash('error', 'Error loading component: ' . $e->getMessage());
            $this->schools = new \Illuminate\Pagination\LengthAwarePaginator(
                collect(),
                0,
                10,
                1,
                ['path' => request()->url()]
            );
        }
    }

    private function initializeDefaults(): void
    {
        // Set current active session id if available
        $currentSession = Session::currentlyActive()->first();
        $this->session_id = $currentSession ? $currentSession->id : ($this->session_id ?? 1);
    }

    public function loadSchools(): void
    {
        try {
            $query = School::with(['session']);

            if ($this->searchTerm) {
                $term = trim($this->searchTerm);
                $query->where(function ($q) use ($term) {
                    $q->where('name', 'like', "%{$term}%")
                      ->orWhere('code', 'like', "%{$term}%")
                      ->orWhere('vill', 'like', "%{$term}%")
                      ->orWhere('po', 'like', "%{$term}%")
                      ->orWhere('ps', 'like', "%{$term}%")
                      ->orWhere('dist', 'like', "%{$term}%");
                });
            }

            $this->schools = $query->orderBy('id')->paginate(10);
        } catch (\Exception $e) {
            Log::error('Error loading schools: ' . $e->getMessage());
            $this->schools = new \Illuminate\Pagination\LengthAwarePaginator(
                collect(),
                0,
                10,
                1,
                ['path' => request()->url()]
            );
        }
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
        $this->loadSchools();
    }

    public function openModal($schoolId = null): void
    {
        $this->resetForm();

        if ($schoolId) {
            $this->editMode = true;
            $this->schoolId = $schoolId;
            $this->loadSchoolData($schoolId);
        } else {
            $this->editMode = false;
            $this->schoolId = null;
        }

        $this->showModal = true;
    }

    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->reset([
            'name', 'code', 'details', 'vill', 'po', 'ps', 'pin', 'dist', 'index', 'hscode', 'disecode', 'estd', 'remark'
        ]);
        $this->status = 'active';
        // Keep session_id default to current
        $this->session_id = $this->session_id ?: optional(Session::currentlyActive()->first())->id;
        $this->editMode = false;
        $this->schoolId = null;
    }

    private function loadSchoolData($schoolId): void
    {
        try {
            $school = School::findOrFail($schoolId);
            $this->session_id = $school->session_id;
            $this->name = $school->name;
            $this->code = $school->code;
            $this->details = $school->details;
            $this->vill = $school->vill;
            $this->po = $school->po;
            $this->ps = $school->ps;
            $this->pin = $school->pin;
            $this->dist = $school->dist;
            $this->index = $school->index;
            $this->hscode = $school->hscode;
            $this->disecode = $school->disecode;
            $this->estd = $school->estd;
            $this->status = $school->status ?? 'active';
            $this->remark = $school->remark;
        } catch (\Exception $e) {
            Log::error('Error loading school data: ' . $e->getMessage());
            session()->flash('error', 'Error loading school data.');
        }
    }

    public function save(): void
    {
        $this->validate();

        try {
            $data = [
                'session_id' => Session::currentlyActive()->first()->id ?? $this->session_id,
                'name' => $this->name,
                'code' => $this->code,
                'details' => $this->details,
                'vill' => $this->vill,
                'po' => $this->po,
                'ps' => $this->ps,
                'pin' => $this->pin,
                'dist' => $this->dist,
                'index' => $this->index,
                'hscode' => $this->hscode,
                'disecode' => $this->disecode,
                'estd' => $this->estd,
                'status' => $this->status,
                'remark' => $this->remark,
            ];

            if ($this->editMode && $this->schoolId) {
                $school = School::findOrFail($this->schoolId);
                $school->update($data);
                session()->flash('message', 'School updated successfully!');
            } else {
                School::create($data);
                session()->flash('message', 'School created successfully!');
            }

            $this->loadSchools();
            $this->closeModal();
        } catch (\Exception $e) {
            Log::error('Error saving school: ' . $e->getMessage());
            session()->flash('error', 'Error saving school: ' . $e->getMessage());
        }
    }

    public function toggleStatus($schoolId): void
    {
        try {
            $school = School::findOrFail($schoolId);
            $newStatus = $school->status === 'active' ? 'inactive' : 'active';
            $school->update(['status' => $newStatus]);

            $statusText = $newStatus === 'active' ? 'activated' : 'deactivated';
            session()->flash('message', "School {$statusText} successfully!");
            $this->loadSchools();
        } catch (\Exception $e) {
            Log::error('Error toggling school status: ' . $e->getMessage());
            session()->flash('error', 'Error updating school status: ' . $e->getMessage());
        }
    }

    public function delete($schoolId): void
    {
        try {
            $school = School::findOrFail($schoolId);
            $school->delete();
            session()->flash('message', 'School deleted successfully!');
            $this->loadSchools();
        } catch (\Exception $e) {
            Log::error('Error deleting school: ' . $e->getMessage());
            session()->flash('error', 'Error deleting school: ' . $e->getMessage());
        }
    }

    public function clearFilters(): void
    {
        $this->searchTerm = '';
        $this->resetPage();
        $this->loadSchools();
    }

    public function refreshData(): void
    {
        $this->loadSchools();
        session()->flash('message', 'School data refreshed successfully!');
    }

    public function render()
    {
        if (!$this->schools) {
            $this->loadSchools();
        }

        return view('livewire.school-comp', [
            'schools' => $this->schools ?? collect(),
        ]);
    }
}
