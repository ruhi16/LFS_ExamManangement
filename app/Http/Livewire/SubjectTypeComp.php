<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\SubjectType;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SubjectTypeComp extends Component
{
    public $subjectTypes = [];

    // Modal properties
    public $showModal = false;
    public $editingId = null;
    public $name = '';
    public $description = '';
    public $code = '';
    public $isActive = true;
    public $remarks = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'code' => 'nullable|string|max:10',
        'isActive' => 'boolean',
        'remarks' => 'nullable|string|max:255'
    ];

    protected $messages = [
        'name.required' => 'Subject type name is required.',
        'name.max' => 'Subject type name cannot exceed 255 characters.',
        'code.max' => 'Code cannot exceed 10 characters.'
    ];

    public function mount()
    {
        $this->loadSubjectTypes();
    }

    protected function loadSubjectTypes()
    {
        $this->subjectTypes = SubjectType::withCount('subjects')
            ->orderBy('name')
            ->get()
            ->map(function ($subjectType) {
                return [
                    'id' => $subjectType->id,
                    'name' => $subjectType->name,
                    'description' => $subjectType->description,
                    'code' => $subjectType->code,
                    'is_active' => $subjectType->is_active,
                    'remarks' => $subjectType->remarks,
                    'subjects_count' => $subjectType->subjects_count,
                    'created_at' => $subjectType->created_at,
                    'updated_at' => $subjectType->updated_at
                ];
            })
            ->toArray();
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

    public function editSubjectType($id)
    {
        $subjectType = collect($this->subjectTypes)->firstWhere('id', $id);

        if (!$subjectType) {
            session()->flash('error', 'Subject type not found.');
            return;
        }

        $this->editingId = $id;
        $this->name = $subjectType['name'];
        $this->description = $subjectType['description'];
        $this->code = $subjectType['code'];
        $this->isActive = $subjectType['is_active'];
        $this->remarks = $subjectType['remarks'];
        $this->showModal = true;
    }

    public function saveSubjectType()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $data = [
                'name' => $this->name,
                'description' => $this->description,
                'code' => $this->code,
                'is_active' => $this->isActive,
                'remarks' => $this->remarks,
                'user_id' => auth()->id(),
                'session_id' => session('current_session_id', 1),
                'school_id' => session('current_school_id', 1),
            ];

            if ($this->editingId) {
                // Update existing
                $subjectType = SubjectType::findOrFail($this->editingId);
                $subjectType->update($data);
                session()->flash('message', 'Subject type updated successfully!');
            } else {
                // Create new
                SubjectType::create($data);
                session()->flash('message', 'Subject type created successfully!');
            }

            DB::commit();

            $this->loadSubjectTypes();
            $this->hideModal();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving subject type: ' . $e->getMessage());
            session()->flash('error', 'Error saving subject type: ' . $e->getMessage());
        }
    }

    public function deleteSubjectType($id)
    {
        try {
            DB::beginTransaction();

            $subjectType = SubjectType::findOrFail($id);

            // Check if subject type has related subjects
            if ($subjectType->subjects()->count() > 0) {
                session()->flash('error', 'Cannot delete subject type with existing subjects.');
                return;
            }

            $subjectType->delete();

            DB::commit();

            session()->flash('message', 'Subject type deleted successfully!');
            $this->loadSubjectTypes();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting subject type: ' . $e->getMessage());
            session()->flash('error', 'Error deleting subject type: ' . $e->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        try {
            $subjectType = SubjectType::findOrFail($id);
            $subjectType->update([
                'is_active' => !$subjectType->is_active
            ]);

            session()->flash('message', 'Status updated successfully!');
            $this->loadSubjectTypes();
        } catch (\Exception $e) {
            Log::error('Error toggling status: ' . $e->getMessage());
            session()->flash('error', 'Error updating status: ' . $e->getMessage());
        }
    }

    protected function resetForm()
    {
        $this->editingId = null;
        $this->name = '';
        $this->description = '';
        $this->code = '';
        $this->isActive = true;
        $this->remarks = '';
        $this->resetErrorBag();
    }

    public function refreshData()
    {
        try {
            $this->loadSubjectTypes();
            session()->flash('message', 'Data refreshed successfully!');
        } catch (\Exception $e) {
            Log::error('Error refreshing data: ' . $e->getMessage());
            session()->flash('error', 'Error refreshing data: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.subject-type-comp');
    }
}
