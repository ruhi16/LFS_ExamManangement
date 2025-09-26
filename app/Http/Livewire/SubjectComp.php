<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subject;
use App\Models\SubjectType;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SubjectComp extends Component
{
    public $subjects = [];
    public $subjectTypes = [];

    // Modal properties
    public $showModal = false;
    public $editingId = null;
    public $name = '';
    public $description = '';
    public $code = '';
    public $subjectTypeId = null;
    public $isActive = true;
    public $remarks = '';
    public $showFinalizeModal = false;
    public $finalizingId = null;
    public $isDataFinalized = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'code' => 'nullable|string|max:10',
        'subjectTypeId' => 'nullable|exists:subject_types,id',
        'isActive' => 'boolean',
        'remarks' => 'nullable|string|max:255'
    ];

    protected $messages = [
        'name.required' => 'Subject name is required.',
        'name.max' => 'Subject name cannot exceed 255 characters.',
        'code.max' => 'Code cannot exceed 10 characters.',
        'subjectTypeId.exists' => 'Selected subject type is invalid.'
    ];

    public function mount()
    {
        $this->loadSubjects();
        $this->loadSubjectTypes();
        $this->checkGlobalFinalizationStatus();
    }

    protected function loadSubjects()
    {
        $allSubjects = Subject::with(['subjectType'])
            ->withCount('myclassSubjects')
            ->orderBy('subject_type_id')
            ->orderBy('id')
            ->get()
            ->map(function ($subject) {
                return [
                    'id' => $subject->id,
                    'name' => $subject->name,
                    'description' => $subject->description,
                    'code' => $subject->code,
                    'subject_type_id' => $subject->subject_type_id,
                    'subject_type_name' => $subject->subjectType->name ?? 'No Type',
                    'is_active' => $subject->is_active,
                    'is_finalized' => $subject->is_finalized ?? false,
                    'remarks' => $subject->remarks,
                    'myclass_subjects_count' => $subject->myclass_subjects_count,
                    'created_at' => $subject->created_at,
                    'updated_at' => $subject->updated_at
                ];
            });

        // Group subjects by type: Summative first, then Formative, then others
        $this->subjects = [
            'summative' => $allSubjects->filter(function ($subject) {
                return strtolower($subject['subject_type_name']) === 'summative';
            })->values()->toArray(),
            'formative' => $allSubjects->filter(function ($subject) {
                return strtolower($subject['subject_type_name']) === 'formative';
            })->values()->toArray(),
            'others' => $allSubjects->filter(function ($subject) {
                return !in_array(strtolower($subject['subject_type_name']), ['summative', 'formative']);
            })->values()->toArray()
        ];
    }

    protected function loadSubjectTypes()
    {
        $this->subjectTypes = SubjectType::where('is_active', true)
            ->orderBy('name')
            ->get()
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

    public function editSubject($id)
    {
        // Find subject across all groups
        $subject = null;
        foreach (['summative', 'formative', 'others'] as $group) {
            $found = collect($this->subjects[$group])->firstWhere('id', $id);
            if ($found) {
                $subject = $found;
                break;
            }
        }

        if (!$subject) {
            session()->flash('error', 'Subject not found.');
            return;
        }

        $this->editingId = $id;
        $this->name = $subject['name'];
        $this->description = $subject['description'];
        $this->code = $subject['code'];
        $this->subjectTypeId = $subject['subject_type_id'];
        $this->isActive = $subject['is_active'];
        $this->remarks = $subject['remarks'];
        $this->showModal = true;
    }

    public function saveSubject()
    {
        if ($this->isDataFinalized) {
            session()->flash('error', 'Cannot modify data - it has been finalized.');
            return;
        }

        $this->validate();
        // dd($this->subjectTypeId);

        try {
            DB::beginTransaction();

            $data = Subject::updateOrCreate(
                ['id' => $this->editingId],
                [
                    'name' => $this->name,
                    'description' => $this->description,
                    'code' => $this->code,
                    'subject_type_id' => $this->subjectTypeId ?? 0,
                    'order_index'=> 1,
                    // 'subject_type_id' => (int) $this->subjectTypeId ?? 0,
                    'is_active' => $this->isActive,
                    'remarks' => $this->remarks,
                    'user_id' => auth()->id(),
                    'session_id' => session('current_session_id', 1),
                    'school_id' => session('current_school_id', 1),
                ]
            );
            // dd($this->subjectTypeId, $data);

            if($this->editingId){
                session()->flash('message', 'Subject updated successfully!');
            }else{
                session()->flash('message', 'Subject created successfully!');
            }

            DB::commit();

            $this->loadSubjects();
            $this->hideModal();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving subject: ' . $e->getMessage());
            session()->flash('error', 'Error saving subject: ' . $e->getMessage());
        }
    }

    public function deleteSubject($id)
    {
        try {
            DB::beginTransaction();

            $subject = Subject::findOrFail($id);

            // Check if subject has related class subjects
            if ($subject->myclassSubjects()->count() > 0) {
                session()->flash('error', 'Cannot delete subject with existing class assignments.');
                return;
            }

            $subject->delete();

            DB::commit();

            session()->flash('message', 'Subject deleted successfully!');
            $this->loadSubjects();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting subject: ' . $e->getMessage());
            session()->flash('error', 'Error deleting subject: ' . $e->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        if ($this->isDataFinalized) {
            session()->flash('error', 'Cannot modify data - it has been finalized.');
            return;
        }

        try {
            $subject = Subject::findOrFail($id);
            $subject->update([
                'is_active' => !$subject->is_active
            ]);

            session()->flash('message', 'Status updated successfully!');
            $this->loadSubjects();
        } catch (\Exception $e) {
            Log::error('Error toggling status: ' . $e->getMessage());
            session()->flash('error', 'Error updating status: ' . $e->getMessage());
        }
    }

    protected function checkGlobalFinalizationStatus()
    {
        $this->isDataFinalized = Subject::where('is_finalized', true)->exists();
    }

    public function confirmFinalize($id)
    {
        $this->finalizingId = $id;
        $this->showFinalizeModal = true;
    }

    public function finalizeData()
    {
        if ($this->finalizingId) {
            $subject = Subject::findOrFail($this->finalizingId);
            $subject->update(['is_finalized' => true]);
            
            $this->checkGlobalFinalizationStatus();
            session()->flash('message', 'Subject finalized successfully! No further changes allowed.');
        }
        
        $this->showFinalizeModal = false;
        $this->finalizingId = null;
        $this->loadSubjects();
    }

    public function unfinalizeData($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->update(['is_finalized' => false]);
        
        $this->checkGlobalFinalizationStatus();
        session()->flash('message', 'Subject unfinalized successfully! Changes are now allowed.');
        $this->loadSubjects();
    }

    public function cancelFinalize()
    {
        $this->showFinalizeModal = false;
        $this->finalizingId = null;
    }

    protected function resetForm()
    {
        $this->editingId = null;
        $this->name = '';
        $this->description = '';
        $this->code = '';
        $this->subjectTypeId = null;
        $this->isActive = true;
        $this->remarks = '';
        $this->resetErrorBag();
    }

    public function refreshData()
    {
        try {
            $this->loadSubjects();
            $this->loadSubjectTypes();
            session()->flash('message', 'Data refreshed successfully!');
        } catch (\Exception $e) {
            Log::error('Error refreshing data: ' . $e->getMessage());
            session()->flash('error', 'Error refreshing data: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.subject-comp');
    }
}
