<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exam02Type;
use Livewire\WithPagination;

class ExamTypeComp extends Component
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
        'name.required' => 'Exam type is required.',
        'name.max' => 'Exam type cannot exceed 255 characters.',
        'description.max' => 'Description cannot exceed 500 characters.',
        'order_index.integer' => 'Order index must be a number.',
        'order_index.min' => 'Order index must be 0 or greater.',
    ];

    public function mount()
    {
        $this->resetForm();
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
            $examType = Exam02Type::findOrFail($this->editingId);
            $examType->update($data);
            session()->flash('message', 'Exam type updated successfully!');
        } else {
            Exam02Type::create($data);
            session()->flash('message', 'Exam type created successfully!');
        }

        $this->closeModal();
    }

    public function edit($id)
    {
        $examType = Exam02Type::findOrFail($id);
        
        $this->editingId = $id;
        $this->name = $examType->name;
        $this->description = $examType->description;
        $this->order_index = $examType->order_index;
        $this->is_active = $examType->is_active;
        $this->is_finalized = $examType->is_finalized;
        $this->status = $examType->status;
        $this->remarks = $examType->remarks;
        
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
            $examType = Exam02Type::findOrFail($this->deletingId);
            
            // Check if exam type has related records
            $hasExamDetails = $examType->examDetails()->exists();
            
            if ($hasExamDetails) {
                session()->flash('error', 'Cannot delete exam type. It has related exam configurations.');
            } else {
                $examType->delete();
                session()->flash('message', 'Exam type deleted successfully!');
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
        $examType = Exam02Type::findOrFail($id);
        $examType->update(['is_active' => !$examType->is_active]);
        
        $status = $examType->is_active ? 'activated' : 'deactivated';
        session()->flash('message', "Exam type {$status} successfully!");
    }

    public function render()
    {
        $examTypes = Exam02Type::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
                      ->orWhere('status', 'like', '%' . $this->search . '%');
            })
            ->orderBy('order_index', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('livewire.exam-type-comp', [
            'examTypes' => $examTypes,
        ]);
    }
}