<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exam04Mode;
use Livewire\WithPagination;

class ExamModeComp extends Component
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
        'name.required' => 'Exam mode is required.',
        'name.max' => 'Exam mode cannot exceed 255 characters.',
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
            $examMode = Exam04Mode::findOrFail($this->editingId);
            $examMode->update($data);
            session()->flash('message', 'Exam mode updated successfully!');
        } else {
            Exam04Mode::create($data);
            session()->flash('message', 'Exam mode created successfully!');
        }

        $this->closeModal();
    }

    public function edit($id)
    {
        $examMode = Exam04Mode::findOrFail($id);
        
        $this->editingId = $id;
        $this->name = $examMode->name;
        $this->description = $examMode->description;
        $this->order_index = $examMode->order_index;
        $this->is_active = $examMode->is_active;
        $this->is_finalized = $examMode->is_finalized;
        $this->status = $examMode->status;
        $this->remarks = $examMode->remarks;
        
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
            $examMode = Exam04Mode::findOrFail($this->deletingId);
            
            // Check if exam mode has related records
            $hasExamDetails = $examMode->examDetails()->exists();
            
            if ($hasExamDetails) {
                session()->flash('error', 'Cannot delete exam mode. It has related exam configurations.');
            } else {
                $examMode->delete();
                session()->flash('message', 'Exam mode deleted successfully!');
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

        $examMode = Exam04Mode::findOrFail($id);
        $examMode->update(['is_active' => !$examMode->is_active]);
        
        $status = $examMode->is_active ? 'activated' : 'deactivated';
        session()->flash('message', "Exam mode {$status} successfully!");
    }

    protected function checkGlobalFinalizationStatus()
    {
        $this->isDataFinalized = Exam04Mode::where('is_finalized', true)->exists();
    }

    public function confirmFinalize($id)
    {
        $this->finalizingId = $id;
        $this->showFinalizeModal = true;
    }

    public function finalizeData()
    {
        if ($this->finalizingId) {
            $examMode = Exam04Mode::findOrFail($this->finalizingId);
            $examMode->update(['is_finalized' => true]);
            
            $this->checkGlobalFinalizationStatus();
            session()->flash('message', 'Exam mode finalized successfully! No further changes allowed.');
        }
        
        $this->showFinalizeModal = false;
        $this->finalizingId = null;
    }

    public function unfinalizeData($id)
    {
        $examMode = Exam04Mode::findOrFail($id);
        $examMode->update(['is_finalized' => false]);
        
        $this->checkGlobalFinalizationStatus();
        session()->flash('message', 'Exam mode unfinalized successfully! Changes are now allowed.');
    }

    public function cancelFinalize()
    {
        $this->showFinalizeModal = false;
        $this->finalizingId = null;
    }

    public function render()
    {
        $examModes = Exam04Mode::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
                      ->orWhere('status', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'asc')
            ->orderBy('order_index', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('livewire.exam-mode-comp', [
            'examModes' => $examModes,
        ]);
    }
}