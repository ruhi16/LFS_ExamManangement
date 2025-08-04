<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MyclassSubject;
use App\Models\Myclass;
use App\Models\Subject;
use Livewire\WithPagination;

class MyclassSubjectComp extends Component
{
    use WithPagination;

    // Form properties
    public $name = '';
    public $description = '';
    public $order_index = '';
    public $is_optional = false;
    public $myclass_id = '';
    public $subject_id = '';
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
    public $filterClass = '';
    public $filterSubject = '';



    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'order_index' => 'nullable|integer|min:0',
        'is_optional' => 'boolean',
        'myclass_id' => 'required|integer|exists:myclasses,id',
        'subject_id' => 'required|integer|exists:subjects,id',
        'school_id' => 'nullable|integer',
        'session_id' => 'nullable|integer',
        'is_active' => 'boolean',
        'is_finalized' => 'boolean',
        'status' => 'nullable|string|max:100',
        'remarks' => 'nullable|string|max:500',
    ];

    protected $messages = [
        'name.required' => 'Subject name is required.',
        'name.max' => 'Subject name cannot exceed 255 characters.',
        'myclass_id.required' => 'Class selection is required.',
        'myclass_id.exists' => 'Selected class does not exist.',
        'subject_id.required' => 'Subject selection is required.',
        'subject_id.exists' => 'Selected subject does not exist.',
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

    public function updatingFilterClass()
    {
        $this->resetPage();
    }

    public function updatingFilterSubject()
    {
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->order_index = '';
        $this->is_optional = false;
        $this->myclass_id = '';
        $this->subject_id = '';
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
            'is_optional' => $this->is_optional,
            'myclass_id' => $this->myclass_id,
            'subject_id' => $this->subject_id,
            'school_id' => $this->school_id ?: null,
            'session_id' => $this->session_id ?: null,
            'is_active' => $this->is_active,
            'is_finalized' => $this->is_finalized,
            'status' => $this->status,
            'remarks' => $this->remarks,
            'user_id' => auth()->id(),
        ];

        if ($this->editingId) {
            $myclassSubject = MyclassSubject::findOrFail($this->editingId);
            $myclassSubject->update($data);
            session()->flash('message', 'Class Subject updated successfully!');
        } else {
            // Check for duplicate class-subject combination
            $exists = MyclassSubject::where('myclass_id', $this->myclass_id)
                                   ->where('subject_id', $this->subject_id)
                                   ->exists();
            
            if ($exists) {
                session()->flash('error', 'This subject is already assigned to the selected class.');
                return;
            }

            MyclassSubject::create($data);
            session()->flash('message', 'Class Subject created successfully!');
        }

        $this->closeModal();
    }

    public function edit($id)
    {
        $myclassSubject = MyclassSubject::findOrFail($id);
        
        $this->editingId = $id;
        $this->name = $myclassSubject->name;
        $this->description = $myclassSubject->description;
        $this->order_index = $myclassSubject->order_index;
        $this->is_optional = $myclassSubject->is_optional;
        $this->myclass_id = $myclassSubject->myclass_id;
        $this->subject_id = $myclassSubject->subject_id;
        $this->school_id = $myclassSubject->school_id;
        $this->session_id = $myclassSubject->session_id;
        $this->is_active = $myclassSubject->is_active;
        $this->is_finalized = $myclassSubject->is_finalized;
        $this->status = $myclassSubject->status;
        $this->remarks = $myclassSubject->remarks;
        
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
            $myclassSubject = MyclassSubject::findOrFail($this->deletingId);
            $myclassSubject->delete();
            session()->flash('message', 'Class Subject deleted successfully!');
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
        $myclassSubject = MyclassSubject::findOrFail($id);
        $myclassSubject->update(['is_active' => !$myclassSubject->is_active]);
        
        $status = $myclassSubject->is_active ? 'activated' : 'deactivated';
        session()->flash('message', "Class Subject {$status} successfully!");
    }

    public function toggleOptional($id)
    {
        $myclassSubject = MyclassSubject::findOrFail($id);
        $myclassSubject->update(['is_optional' => !$myclassSubject->is_optional]);
        
        $type = $myclassSubject->is_optional ? 'optional' : 'mandatory';
        session()->flash('message', "Subject marked as {$type} successfully!");
    }

    public function render()
    {
        $myclassSubjects = MyclassSubject::with(['myclass', 'subject'])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
                      ->orWhere('status', 'like', '%' . $this->search . '%')
                      ->orWhereHas('myclass', function ($q) {
                          $q->where('name', 'like', '%' . $this->search . '%');
                      })
                      ->orWhereHas('subject', function ($q) {
                          $q->where('name', 'like', '%' . $this->search . '%');
                      });
            })
            ->when($this->filterClass, function ($query) {
                $query->where('myclass_id', $this->filterClass);
            })
            ->when($this->filterSubject, function ($query) {
                $query->where('subject_id', $this->filterSubject);
            })
            ->orderBy('id', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(10);

        $myclasses = Myclass::where('is_active', true)->orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();

        return view('livewire.myclass-subject-comp', [
            'myclassSubjects' => $myclassSubjects,
            'myclasses' => $myclasses,
            'subjects' => $subjects
        ]);
    }
}