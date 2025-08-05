<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exam01Name;
use Livewire\WithPagination;

class ExamNameComp extends Component
{
    use WithPagination;

    // Form properties
    public $name = '';
    public $description = '';
    public $order_index = '';
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
        'session_id' => 'nullable|integer',
        'is_active' => 'boolean',
        'is_finalized' => 'boolean',
        'status' => 'nullable|string|max:100',
        'remarks' => 'nullable|string|max:500',
    ];

    protected $messages = [
        'name.required' => 'Exam name is required.',
        'name.max' => 'Exam name cannot exceed 255 characters.',
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
            'session_id' => $this->session_id ?: null,
            'is_active' => $this->is_active,
            'is_finalized' => $this->is_finalized,
            'status' => $this->status,
            'remarks' => $this->remarks,
            'user_id' => auth()->id(),
        ];

        if ($this->editingId) {
            $examName = Exam01Name::findOrFail($this->editingId);
            $examName->update($data);
            session()->flash('message', 'Exam name updated successfully!');
        } else {
            Exam01Name::create($data);
            session()->flash('message', 'Exam name created successfully!');
        }

        $this->closeModal();
    }

    public function edit($id)
    {
        $examName = Exam01Name::findOrFail($id);
        
        $this->editingId = $id;
        $this->name = $examName->name;
        $this->description = $examName->description;
        $this->order_index = $examName->order_index;
        $this->session_id = $examName->session_id;
        $this->is_active = $examName->is_active;
        $this->is_finalized = $examName->is_finalized;
        $this->status = $examName->status;
        $this->remarks = $examName->remarks;
        
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
            $examName = Exam01Name::findOrFail($this->deletingId);
            
            // Check if exam name has related records
            $hasExamDetails = $examName->examDetails()->exists();
            
            if ($hasExamDetails) {
                session()->flash('error', 'Cannot delete exam name. It has related exam configurations.');
            } else {
                $examName->delete();
                session()->flash('message', 'Exam name deleted successfully!');
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
        $examName = Exam01Name::findOrFail($id);
        $examName->update(['is_active' => !$examName->is_active]);
        
        $status = $examName->is_active ? 'activated' : 'deactivated';
        session()->flash('message', "Exam name {$status} successfully!");
    }

    public function render()
    {
        $examNames = Exam01Name::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
                      ->orWhere('status', 'like', '%' . $this->search . '%');
            })
            ->orderBy('order_index', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('livewire.exam-name-comp', [
            'examNames' => $examNames,
        ]);
    }
}