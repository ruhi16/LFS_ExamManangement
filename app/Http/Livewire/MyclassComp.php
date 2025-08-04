<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Myclass;
use Livewire\WithPagination;

class MyclassComp extends Component
{
    use WithPagination;

    // Form properties
    public $name = '';
    public $description = '';
    public $order_index = '';
    public $school_id = '';
    public $session_id = '';
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
        'school_id' => 'nullable|integer',
        'session_id' => 'nullable|integer',
        'is_active' => 'boolean',
        'is_finalized' => 'boolean',
        'status' => 'nullable|string|max:100',
        'remarks' => 'nullable|string|max:500',
    ];

    protected $messages = [
        'name.required' => 'Class name is required.',
        'name.max' => 'Class name cannot exceed 255 characters.',
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
        $this->school_id = '';
        $this->session_id = '';
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
            'school_id' => $this->school_id ?: null,
            'session_id' => $this->session_id ?: null,
            'is_active' => $this->is_active,
            'is_finalized' => $this->is_finalized,
            'status' => $this->status,
            'remarks' => $this->remarks,
            'user_id' => auth()->id(),
        ];

        if ($this->editingId) {
            $myclass = Myclass::findOrFail($this->editingId);
            $myclass->update($data);
            session()->flash('message', 'Class updated successfully!');
        } else {
            Myclass::create($data);
            session()->flash('message', 'Class created successfully!');
        }

        $this->closeModal();
    }

    public function edit($id)
    {
        $myclass = Myclass::findOrFail($id);
        
        $this->editingId = $id;
        $this->name = $myclass->name;
        $this->description = $myclass->description;
        $this->order_index = $myclass->order_index;
        $this->school_id = $myclass->school_id;
        $this->session_id = $myclass->session_id;
        $this->is_active = $myclass->is_active;
        $this->is_finalized = $myclass->is_finalized;
        $this->status = $myclass->status;
        $this->remarks = $myclass->remarks;
        
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
            $myclass = Myclass::findOrFail($this->deletingId);
            
            // Check if class has related records
            $hasStudents = $myclass->studentdb()->exists() || $myclass->studentcrs()->exists();
            $hasSections = $myclass->myclass_sections()->exists();
            $hasExams = $myclass->examDetails()->exists();
            
            if ($hasStudents || $hasSections || $hasExams) {
                session()->flash('error', 'Cannot delete class. It has related students, sections, or exam configurations.');
            } else {
                $myclass->delete();
                session()->flash('message', 'Class deleted successfully!');
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
        $myclass = Myclass::findOrFail($id);
        $myclass->update(['is_active' => !$myclass->is_active]);
        
        $status = $myclass->is_active ? 'activated' : 'deactivated';
        session()->flash('message', "Class {$status} successfully!");
    }

    public function render()
    {
        $myclasses = Myclass::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
                      ->orWhere('status', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('livewire.myclass-comp', [
            'myclasses' => $myclasses,
        ]);
    }
}
