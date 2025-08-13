<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Myclass;
use App\Models\Subject;
use App\Models\MyclassSubject;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MyclassSubjectComp extends Component
{
    public $selectedClassId = null;
    public $classes;
    public $subjects = [];
    public $availableSubjects = [];
    public $classSubjects = [];

    // Form properties
    public $showAddForm = false;
    public $editingId = null;
    public $name = '';
    public $description = '';
    public $selectedSubjectId = null;
    public $orderIndex = 1;
    public $isOptional = false;
    public $status = 'active';
    public $remarks = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'selectedSubjectId' => 'required|exists:subjects,id',
        'orderIndex' => 'required|integer|min:1',
        'isOptional' => 'boolean',
        'status' => 'required|in:active,inactive,pending',
        'remarks' => 'nullable|string|max:255'
    ];

    protected $messages = [
        'name.required' => 'Class subject name is required.',
        'selectedSubjectId.required' => 'Please select a subject.',
        'selectedSubjectId.exists' => 'Selected subject is invalid.',
        'orderIndex.required' => 'Order index is required.',
        'orderIndex.min' => 'Order index must be at least 1.'
    ];

    public function mount()
    {
        $this->classes = Myclass::where('is_active', true)->orderBy('id')->get();
        $this->subjects = Subject::where('is_active', true)->orderBy('name')->get();
    }

    public function selectClass($classId)
    {
        try {
            $this->selectedClassId = $classId;
            $this->loadClassSubjects();
            $this->loadAvailableSubjects();
            $this->resetForm();
        } catch (\Exception $e) {
            Log::error('Error selecting class: ' . $e->getMessage());
            session()->flash('error', 'Error loading class data: ' . $e->getMessage());
        }
    }

    protected function loadClassSubjects()
    {
        if (!$this->selectedClassId) {
            $this->classSubjects = [];
            return;
        }

        $allClassSubjects = MyclassSubject::where('myclass_id', $this->selectedClassId)
            ->with(['subject.subjectType', 'user', 'approvedBy'])
            ->orderBy('order_index')
            ->get()
            ->map(function ($classSubject) {
                return [
                    'id' => $classSubject->id,
                    'name' => $classSubject->name,
                    'description' => $classSubject->description,
                    'subject_name' => $classSubject->subject->name ?? 'Unknown',
                    'subject_code' => $classSubject->subject->code ?? '',
                    'subject_type_name' => $classSubject->subject->subjectType->name ?? 'No Type',
                    'order_index' => $classSubject->order_index,
                    'is_optional' => $classSubject->is_optional,
                    'is_active' => $classSubject->is_active,
                    'is_finalized' => $classSubject->is_finalized,
                    'status' => $classSubject->status,
                    'remarks' => $classSubject->remarks,
                    'created_by' => $classSubject->user->name ?? 'Unknown',
                    'approved_by' => $classSubject->approvedBy->name ?? null,
                    'created_at' => $classSubject->created_at,
                    'subject_id' => $classSubject->subject_id
                ];
            });

        // Group subjects by type: Summative first, then Formative, then others
        $this->classSubjects = [
            'summative' => $allClassSubjects->filter(function ($subject) {
                return strtolower($subject['subject_type_name']) === 'summative';
            })->values()->toArray(),
            'formative' => $allClassSubjects->filter(function ($subject) {
                return strtolower($subject['subject_type_name']) === 'formative';
            })->values()->toArray(),
            'others' => $allClassSubjects->filter(function ($subject) {
                return !in_array(strtolower($subject['subject_type_name']), ['summative', 'formative']);
            })->values()->toArray()
        ];
    }

    protected function loadAvailableSubjects()
    {
        if (!$this->selectedClassId) {
            $this->availableSubjects = [];
            return;
        }

        // Get subjects that are not already assigned to this class
        $assignedSubjectIds = MyclassSubject::where('myclass_id', $this->selectedClassId)
            ->pluck('subject_id')
            ->toArray();

        $this->availableSubjects = Subject::with('subjectType')
            ->where('is_active', true)
            ->whereNotIn('id', $assignedSubjectIds)
            ->orderBy('name')
            ->get()
            ->map(function ($subject) {
                return [
                    'id' => $subject->id,
                    'name' => $subject->name,
                    'code' => $subject->code
                ];
            })
            ->toArray();
    }

    public function showAddForm()
    {
        if (!$this->selectedClassId) {
            session()->flash('error', 'Please select a class first.');
            return;
        }

        $this->resetForm();
        $this->showAddForm = true;
        $totalSubjects = count($this->classSubjects['summative']) + count($this->classSubjects['formative']) + count($this->classSubjects['others']);
        $this->orderIndex = $totalSubjects + 1;
    }

    public function hideAddForm()
    {
        $this->showAddForm = false;
        $this->resetForm();
    }

    public function editClassSubject($id)
    {
        // Find subject across all groups
        $classSubject = null;
        foreach (['summative', 'formative', 'others'] as $group) {
            $found = collect($this->classSubjects[$group])->firstWhere('id', $id);
            if ($found) {
                $classSubject = $found;
                break;
            }
        }

        if (!$classSubject) {
            session()->flash('error', 'Class subject not found.');
            return;
        }

        $this->editingId = $id;
        $this->name = $classSubject['name'];
        $this->description = $classSubject['description'];
        $this->selectedSubjectId = $classSubject['subject_id'];
        $this->orderIndex = $classSubject['order_index'];
        $this->isOptional = $classSubject['is_optional'];
        $this->status = $classSubject['status'];
        $this->remarks = $classSubject['remarks'];
        $this->showAddForm = true;
    }

    public function saveClassSubject()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $data = [
                'name' => $this->name,
                'description' => $this->description,
                'myclass_id' => $this->selectedClassId,
                'subject_id' => $this->selectedSubjectId,
                'order_index' => $this->orderIndex,
                'is_optional' => $this->isOptional,
                'status' => $this->status,
                'remarks' => $this->remarks,
                'is_active' => $this->status === 'active',
                'user_id' => auth()->id(),
                'session_id' => session('current_session_id', 1),
                'school_id' => session('current_school_id', 1),
            ];

            if ($this->editingId) {
                // Update existing
                $classSubject = MyclassSubject::findOrFail($this->editingId);
                $classSubject->update($data);
                session()->flash('message', 'Class subject updated successfully!');
            } else {
                // Check for duplicate subject in the same class
                $exists = MyclassSubject::where('myclass_id', $this->selectedClassId)
                    ->where('subject_id', $this->selectedSubjectId)
                    ->exists();

                if ($exists) {
                    session()->flash('error', 'This subject is already assigned to the selected class.');
                    return;
                }

                // Create new
                MyclassSubject::create($data);
                session()->flash('message', 'Class subject added successfully!');
            }

            DB::commit();

            $this->loadClassSubjects();
            $this->loadAvailableSubjects();
            $this->hideAddForm();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving class subject: ' . $e->getMessage());
            session()->flash('error', 'Error saving class subject: ' . $e->getMessage());
        }
    }

    public function deleteClassSubject($id)
    {
        try {
            DB::beginTransaction();

            $classSubject = MyclassSubject::findOrFail($id);
            $classSubject->delete();

            DB::commit();

            session()->flash('message', 'Class subject deleted successfully!');
            $this->loadClassSubjects();
            $this->loadAvailableSubjects();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting class subject: ' . $e->getMessage());
            session()->flash('error', 'Error deleting class subject: ' . $e->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        try {
            $classSubject = MyclassSubject::findOrFail($id);
            $classSubject->update([
                'is_active' => !$classSubject->is_active,
                'status' => $classSubject->is_active ? 'inactive' : 'active'
            ]);

            session()->flash('message', 'Status updated successfully!');
            $this->loadClassSubjects();
        } catch (\Exception $e) {
            Log::error('Error toggling status: ' . $e->getMessage());
            session()->flash('error', 'Error updating status: ' . $e->getMessage());
        }
    }

    public function finalizeClassSubject($id)
    {
        try {
            $classSubject = MyclassSubject::findOrFail($id);
            $classSubject->update([
                'is_finalized' => true,
                'approved_by' => auth()->id()
            ]);

            session()->flash('message', 'Class subject finalized successfully!');
            $this->loadClassSubjects();
        } catch (\Exception $e) {
            Log::error('Error finalizing class subject: ' . $e->getMessage());
            session()->flash('error', 'Error finalizing class subject: ' . $e->getMessage());
        }
    }

    public function moveUp($id)
    {
        $this->reorderClassSubject($id, 'up');
    }

    public function moveDown($id)
    {
        $this->reorderClassSubject($id, 'down');
    }

    protected function reorderClassSubject($id, $direction)
    {
        try {
            DB::beginTransaction();

            $classSubject = MyclassSubject::findOrFail($id);
            $currentOrder = $classSubject->order_index;

            if ($direction === 'up' && $currentOrder > 1) {
                $swapWith = MyclassSubject::where('myclass_id', $this->selectedClassId)
                    ->where('order_index', $currentOrder - 1)
                    ->first();

                if ($swapWith) {
                    $classSubject->update(['order_index' => $currentOrder - 1]);
                    $swapWith->update(['order_index' => $currentOrder]);
                }
            } elseif ($direction === 'down') {
                $swapWith = MyclassSubject::where('myclass_id', $this->selectedClassId)
                    ->where('order_index', $currentOrder + 1)
                    ->first();

                if ($swapWith) {
                    $classSubject->update(['order_index' => $currentOrder + 1]);
                    $swapWith->update(['order_index' => $currentOrder]);
                }
            }

            DB::commit();
            $this->loadClassSubjects();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error reordering class subject: ' . $e->getMessage());
            session()->flash('error', 'Error reordering class subject: ' . $e->getMessage());
        }
    }

    protected function resetForm()
    {
        $this->editingId = null;
        $this->name = '';
        $this->description = '';
        $this->selectedSubjectId = null;
        $this->orderIndex = 1;
        $this->isOptional = false;
        $this->status = 'active';
        $this->remarks = '';
        $this->resetErrorBag();
    }

    public function refreshData()
    {
        try {
            if ($this->selectedClassId) {
                $this->loadClassSubjects();
                $this->loadAvailableSubjects();
            }
            session()->flash('message', 'Data refreshed successfully!');
        } catch (\Exception $e) {
            Log::error('Error refreshing data: ' . $e->getMessage());
            session()->flash('error', 'Error refreshing data: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.myclass-subject-comp');
    }
}
