<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Myclass;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MyclassComp extends Component
{
    public $classes = [];

    // Form properties
    public $showAddForm = false;
    public $editingId = null;
    public $name = '';
    public $description = '';
    public $orderIndex = 1;
    public $status = 'active';
    public $remarks = '';

    protected $rules = [
        'name' => 'required|string|max:255|unique:myclasses,name',
        'description' => 'nullable|string|max:500',
        'orderIndex' => 'required|integer|min:1',
        'status' => 'required|in:active,inactive,pending',
        'remarks' => 'nullable|string|max:255'
    ];

    protected $messages = [
        'name.required' => 'Class name is required.',
        'name.unique' => 'This class name already exists.',
        'orderIndex.required' => 'Order index is required.',
        'orderIndex.min' => 'Order index must be at least 1.'
    ];

    public function mount()
    {
        $this->loadClasses();
    }

    protected function loadClasses()
    {
        $this->classes = Myclass::orderBy('order_index')
            ->get()
            ->map(function ($class) {
                return [
                    'id' => $class->id,
                    'name' => $class->name,
                    'description' => $class->description,
                    'order_index' => $class->order_index,
                    'is_active' => $class->is_active,
                    'is_finalized' => $class->is_finalized,
                    'status' => $class->status,
                    'remarks' => $class->remarks,
                    'created_at' => $class->created_at,
                    'sections_count' => $class->myclass_sections()->count(),
                    'subjects_count' => $class->myclassSubjects()->count(),
                    'students_count' => $class->studentcrs()->count()
                ];
            })
            ->toArray();
    }

    public function showAddForm()
    {
        $this->resetForm();
        $this->showAddForm = true;
        $this->orderIndex = count($this->classes) + 1;
    }

    public function hideAddForm()
    {
        $this->showAddForm = false;
        $this->resetForm();
    }

    public function editClass($id)
    {
        $class = collect($this->classes)->firstWhere('id', $id);

        if (!$class) {
            session()->flash('error', 'Class not found.');
            return;
        }

        $this->editingId = $id;
        $this->name = $class['name'];
        $this->description = $class['description'];
        $this->orderIndex = $class['order_index'];
        $this->status = $class['status'];
        $this->remarks = $class['remarks'];
        $this->showAddForm = true;
    }

    public function saveClass()
    {
        // Update validation rule for editing
        if ($this->editingId) {
            $this->rules['name'] = 'required|string|max:255|unique:myclasses,name,' . $this->editingId;
        }

        $this->validate();

        try {
            DB::beginTransaction();

            $data = [
                'name' => $this->name,
                'description' => $this->description,
                'order_index' => $this->orderIndex,
                'status' => $this->status,
                'remarks' => $this->remarks,
                'is_active' => $this->status === 'active',
                'user_id' => auth()->id(),
                'session_id' => session('current_session_id', 1),
                'school_id' => session('current_school_id', 1),
            ];

            if ($this->editingId) {
                // Update existing
                $class = Myclass::findOrFail($this->editingId);
                $class->update($data);
                session()->flash('message', 'Class updated successfully!');
            } else {
                // Create new
                Myclass::create($data);
                session()->flash('message', 'Class created successfully!');
            }

            DB::commit();

            $this->loadClasses();
            $this->hideAddForm();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving class: ' . $e->getMessage());
            session()->flash('error', 'Error saving class: ' . $e->getMessage());
        }
    }

    public function deleteClass($id)
    {
        try {
            DB::beginTransaction();

            $class = Myclass::findOrFail($id);

            // Check if class has related data
            if (
                $class->myclass_sections()->count() > 0 ||
                $class->myclassSubjects()->count() > 0 ||
                $class->studentcrs()->count() > 0
            ) {
                session()->flash('error', 'Cannot delete class with existing sections, subjects, or students.');
                return;
            }

            $class->delete();

            DB::commit();

            session()->flash('message', 'Class deleted successfully!');
            $this->loadClasses();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting class: ' . $e->getMessage());
            session()->flash('error', 'Error deleting class: ' . $e->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        try {
            $class = Myclass::findOrFail($id);
            $class->update([
                'is_active' => !$class->is_active,
                'status' => $class->is_active ? 'inactive' : 'active'
            ]);

            session()->flash('message', 'Status updated successfully!');
            $this->loadClasses();
        } catch (\Exception $e) {
            Log::error('Error toggling status: ' . $e->getMessage());
            session()->flash('error', 'Error updating status: ' . $e->getMessage());
        }
    }

    public function finalizeClass($id)
    {
        try {
            $class = Myclass::findOrFail($id);
            $class->update([
                'is_finalized' => true,
                'approved_by' => auth()->id()
            ]);

            session()->flash('message', 'Class finalized successfully!');
            $this->loadClasses();
        } catch (\Exception $e) {
            Log::error('Error finalizing class: ' . $e->getMessage());
            session()->flash('error', 'Error finalizing class: ' . $e->getMessage());
        }
    }

    public function moveUp($id)
    {
        $this->reorderClass($id, 'up');
    }

    public function moveDown($id)
    {
        $this->reorderClass($id, 'down');
    }

    protected function reorderClass($id, $direction)
    {
        try {
            DB::beginTransaction();

            $class = Myclass::findOrFail($id);
            $currentOrder = $class->order_index;

            if ($direction === 'up' && $currentOrder > 1) {
                $swapWith = Myclass::where('order_index', $currentOrder - 1)->first();

                if ($swapWith) {
                    $class->update(['order_index' => $currentOrder - 1]);
                    $swapWith->update(['order_index' => $currentOrder]);
                }
            } elseif ($direction === 'down') {
                $swapWith = Myclass::where('order_index', $currentOrder + 1)->first();

                if ($swapWith) {
                    $class->update(['order_index' => $currentOrder + 1]);
                    $swapWith->update(['order_index' => $currentOrder]);
                }
            }

            DB::commit();
            $this->loadClasses();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error reordering class: ' . $e->getMessage());
            session()->flash('error', 'Error reordering class: ' . $e->getMessage());
        }
    }

    protected function resetForm()
    {
        $this->editingId = null;
        $this->name = '';
        $this->description = '';
        $this->orderIndex = 1;
        $this->status = 'active';
        $this->remarks = '';
        $this->resetErrorBag();
    }

    public function refreshData()
    {
        try {
            $this->loadClasses();
            session()->flash('message', 'Data refreshed successfully!');
        } catch (\Exception $e) {
            Log::error('Error refreshing data: ' . $e->getMessage());
            session()->flash('error', 'Error refreshing data: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.myclass-comp');
    }
}
