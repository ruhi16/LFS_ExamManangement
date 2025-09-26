<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exam05Detail;
use App\Models\Myclass;
use App\Models\Exam01Name;
use App\Models\Exam02Type;
use App\Models\Exam03Part;
use App\Models\Exam04Mode;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\FinalizationTrait;

class Exam05DetailComp extends Component
{
    use WithPagination, FinalizationTrait;

    // Form properties
    public $myclass_id = '';
    public $exam_name_id = '';
    public $exam_type_id = '';
    public $exam_part_id = '';
    public $exam_mode_id = '';
    public $order_index = '';
    public $is_optional = false;
    public $session_id = '';
    public $school_id = '';
    public $is_active = true;
    public $is_finalized = false;
    public $status = '';
    public $remarks = '';

    // Component state
    public $showModal = false;
    public $editingId = null;
    public $confirmingDeletion = false;
    public $deletingId = null;
    public $search = '';
    public $selectedClassId = '';

    protected $rules = [
        'myclass_id' => 'required|integer',
        'exam_name_id' => 'required|integer',
        'exam_type_id' => 'required|integer',
        'exam_part_id' => 'required|integer',
        'exam_mode_id' => 'required|integer',
        'order_index' => 'nullable|integer|min:0',
        'is_optional' => 'boolean',
        'session_id' => 'nullable|integer',
        'school_id' => 'nullable|integer',
        'is_active' => 'boolean',
        'is_finalized' => 'boolean',
        'status' => 'nullable|string|max:100',
        'remarks' => 'nullable|string|max:500',
    ];

    protected $messages = [
        'myclass_id.required' => 'Class is required.',
        'exam_name_id.required' => 'Exam name is required.',
        'exam_type_id.required' => 'Exam type is required.',
        'exam_part_id.required' => 'Exam part is required.',
        'exam_mode_id.required' => 'Exam mode is required.',
        'order_index.integer' => 'Order index must be a number.',
        'order_index.min' => 'Order index must be 0 or greater.',
    ];

    public function mount()
    {
        $this->resetForm();
        $this->checkGlobalFinalizationStatus(Exam05Detail::class);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->myclass_id = '';
        $this->exam_name_id = '';
        $this->exam_type_id = '';
        $this->exam_part_id = '';
        $this->exam_mode_id = '';
        $this->order_index = '';
        $this->is_optional = false;
        $this->session_id = '';
        $this->school_id = '';
        $this->is_active = true;
        $this->is_finalized = false;
        $this->status = '';
        $this->remarks = '';
        $this->editingId = null;
        $this->resetValidation();
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function save()
    {
        if ($this->preventActionIfFinalized('modify data')) {
            return;
        }

        $this->validate();

        $data = [
            'myclass_id' => $this->myclass_id,
            'exam_name_id' => $this->exam_name_id,
            'exam_type_id' => $this->exam_type_id,
            'exam_part_id' => $this->exam_part_id,
            'exam_mode_id' => $this->exam_mode_id,
            'order_index' => $this->order_index ?: null,
            'is_optional' => $this->is_optional,
            'session_id' => $this->session_id ?: null,
            'school_id' => $this->school_id ?: null,
            'is_active' => $this->is_active,
            'is_finalized' => $this->is_finalized,
            'status' => $this->status,
            'remarks' => $this->remarks,
            'user_id' => auth()->id(),
        ];

        if ($this->editingId) {
            $examDetail = Exam05Detail::findOrFail($this->editingId);
            $examDetail->update($data);
            session()->flash('message', 'Exam detail updated successfully!');
        } else {
            Exam05Detail::create($data);
            session()->flash('message', 'Exam detail created successfully!');
        }

        $this->closeModal();
    }

    public function edit($id)
    {
        $examDetail = Exam05Detail::findOrFail($id);
        
        $this->editingId = $id;
        $this->myclass_id = $examDetail->myclass_id;
        $this->exam_name_id = $examDetail->exam_name_id;
        $this->exam_type_id = $examDetail->exam_type_id;
        $this->exam_part_id = $examDetail->exam_part_id;
        $this->exam_mode_id = $examDetail->exam_mode_id;
        $this->order_index = $examDetail->order_index;
        $this->is_optional = $examDetail->is_optional;
        $this->session_id = $examDetail->session_id;
        $this->school_id = $examDetail->school_id;
        $this->is_active = $examDetail->is_active;
        $this->is_finalized = $examDetail->is_finalized;
        $this->status = $examDetail->status;
        $this->remarks = $examDetail->remarks;
        
        $this->showModal = true;
    }

    public function confirmDelete($id)
    {
        $this->deletingId = $id;
        $this->confirmingDeletion = true;
    }

    public function delete()
    {
        if ($this->deletingId) {
            $examDetail = Exam05Detail::findOrFail($this->deletingId);
            
            // Check if exam detail has related records
            $hasClassSubjects = $examDetail->examClassSubjects()->exists();
            
            if ($hasClassSubjects) {
                session()->flash('error', 'Cannot delete exam detail. It has related class subject configurations.');
            } else {
                $examDetail->delete();
                session()->flash('message', 'Exam detail deleted successfully!');
            }
        }
        
        $this->confirmingDeletion = false;
        $this->deletingId = null;
    }

    public function cancelDelete()
    {
        $this->confirmingDeletion = false;
        $this->deletingId = null;
    }

    public function toggleStatus($id)
    {
        if ($this->preventActionIfFinalized('modify data')) {
            return;
        }

        $examDetail = Exam05Detail::findOrFail($id);
        $examDetail->update(['is_active' => !$examDetail->is_active]);
        
        $status = $examDetail->is_active ? 'activated' : 'deactivated';
        session()->flash('message', "Exam detail {$status} successfully!");
    }

    public function render()
    {
        $examDetails = Exam05Detail::query()
            ->with(['myclass', 'examName', 'examType', 'examPart', 'examMode'])
            ->when($this->search, function ($query) {
                $query->whereHas('myclass', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })->orWhereHas('examName', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })->orWhereHas('examType', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->selectedClassId, function ($query) {
                $query->where('myclass_id', $this->selectedClassId);
            })
            ->orderBy('id', 'asc')
            ->orderBy('myclass_id', 'asc')
            ->orderBy('exam_name_id', 'asc')
            ->paginate(10);

        $classes = Myclass::where('is_active', true)->orderBy('id')->get();
        $examNames = Exam01Name::orderBy('id')->get();
        $examTypes = Exam02Type::orderBy('id')->get();
        $examParts = Exam03Part::orderBy('id')->get();
        $examModes = Exam04Mode::orderBy('id')->get();

        return view('livewire.exam05-detail-comp', [
            'examDetails' => $examDetails,
            'classes' => $classes,
            'examNames' => $examNames,
            'examTypes' => $examTypes,
            'examParts' => $examParts,
            'examModes' => $examModes,
        ]);
    }
}