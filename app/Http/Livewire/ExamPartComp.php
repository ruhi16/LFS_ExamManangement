<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exam03Part;
use Livewire\WithPagination;

class ExamPartComp extends Component
{
    use WithPagination;

    // Form properties
    public $name = '';
    public $description = '';
    public $order_index = '';
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
    public $showFinalizeModal = false;
    public $finalizingId = null;
    public $isDataFinalized = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'order_index' => 'nullable|integer|min:0',
        'is_active' => 'boolean',
        'is_finalized' => 'boolean',
        'status' => 'nullable|string|max:100',
        'remarks' => 'nullable|string|max:500',
    ];

    protected $messages = [
        'name.required' => 'Exam part is required.',
        'name.max' => 'Exam part cannot exceed 255 characters.',
        'description.max' => 'Description cannot exceed 500 characters.',
        'order_index.integer' => 'Order index must be a number.',
        'order_index.min' => 'Order index must be 0 or greater.',
    ];

    public function mount()
    {
        $this->resetForm();
        $this->checkGlobalFinalizationStatus();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->order_index = '';
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
        if ($this->isDataFinalized) {
            session()->flash('error', 'Cannot modify data - it has been finalized.');
            return;
        }

        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'order_index' => $this->order_index ?: null,
            'is_active' => $this->is_active,
            'is_finalized' => $this->is_finalized,
            'status' => $this->status,
            'remarks' => $this->remarks,
            'user_id' => auth()->id(),
        ];

        if ($this->editingId) {
            $examPart = Exam03Part::findOrFail($this->editingId);
            $examPart->update($data);
            session()->flash('message', 'Exam part updated successfully!');
        } else {
            Exam03Part::create($data);
            session()->flash('message', 'Exam part created successfully!');
        }

        $this->closeModal();
    }

    public function edit($id)
    {
        $examPart = Exam03Part::findOrFail($id);
        
        $this->editingId = $id;
        $this->name = $examPart->name;
        $this->description = $examPart->description;
        $this->order_index = $examPart->order_index;
        $this->is_active = $examPart->is_active;
        $this->is_finalized = $examPart->is_finalized;
        $this->status = $examPart->status;
        $this->remarks = $examPart->remarks;
        
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
            $examPart = Exam03Part::findOrFail($this->deletingId);
            
            // Check if exam part has related records
            $hasExamDetails = $examPart->examDetails()->exists();
            
            if ($hasExamDetails) {
                session()->flash('error', 'Cannot delete exam part. It has related exam configurations.');
            } else {
                $examPart->delete();
                session()->flash('message', 'Exam part deleted successfully!');
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
        if ($this->isDataFinalized) {
            session()->flash('error', 'Cannot modify data - it has been finalized.');
            return;
        }

        $examPart = Exam03Part::findOrFail($id);
        $examPart->update(['is_active' => !$examPart->is_active]);
        
        $status = $examPart->is_active ? 'activated' : 'deactivated';
        session()->flash('message', "Exam part {$status} successfully!");
    }

    protected function checkGlobalFinalizationStatus()
    {
        $this->isDataFinalized = Exam03Part::where('is_finalized', true)->exists();
    }

    public function confirmFinalize($id)
    {
        $this->finalizingId = $id;
        $this->showFinalizeModal = true;
    }

    public function finalizeData()
    {
        if ($this->finalizingId) {
            $examPart = Exam03Part::findOrFail($this->finalizingId);
            $examPart->update(['is_finalized' => true]);
            
            $this->checkGlobalFinalizationStatus();
            session()->flash('message', 'Exam part finalized successfully! No further changes allowed.');
        }
        
        $this->showFinalizeModal = false;
        $this->finalizingId = null;
    }

    public function unfinalizeData($id)
    {
        $examPart = Exam03Part::findOrFail($id);
        $examPart->update(['is_finalized' => false]);
        
        $this->checkGlobalFinalizationStatus();
        session()->flash('message', 'Exam part unfinalized successfully! Changes are now allowed.');
    }

    public function cancelFinalize()
    {
        $this->showFinalizeModal = false;
        $this->finalizingId = null;
    }

    public function render()
    {
        $examParts = Exam03Part::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
                      ->orWhere('status', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'asc')
            ->orderBy('order_index', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('livewire.exam-part-comp', [
            'examParts' => $examParts,
        ]);
    }
}