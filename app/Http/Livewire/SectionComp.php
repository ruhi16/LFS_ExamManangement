<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Section;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SectionComp extends Component
{
    public $sections = [];

    // Form properties
    public $showAddForm = false;
    public $editingId = null;
    public $name = '';
    public $description = '';
    public $code = '';
    public $capacity = null;
    public $isActive = true;
    public $remarks = '';

    protected $rules = [
        'name' => 'required|string|max:255|unique:sections,name',
        'description' => 'nullable|string|max:500',
        'code' => 'nullable|string|max:10|unique:sections,code',
        'capacity' => 'nullable|integer|min:1|max:200',
        'isActive' => 'boolean',
        'remarks' => 'nullable|string|max:255'
    ];

    protected $messages = [
        'name.required' => 'Section name is required.',
        'name.unique' => 'This section name already exists.',
        'code.unique' => 'This section code already exists.',
        'capacity.min' => 'Capacity must be at least 1.',
        'capacity.max' => 'Capacity cannot exceed 200.'
    ];

    public function mount()
    {
        $this->loadSections();
    }

    protected function loadSections()
    {
        $this->sections = Section::orderBy('name')
            ->get()
            ->map(function ($section) {
                return [
                    'id' => $section->id,
                    'name' => $section->name,
                    'description' => $section->description,
                    'code' => $section->code,
                    'capacity' => $section->capacity,
                    'is_active' => $section->is_active,
                    'remarks' => $section->remarks,
                    'created_at' => $section->created_at,
                    'classes_count' => $section->myclass_sections()->count(),
                    'students_count' => $section->studentcrs()->count()
                ];
            })
            ->toArray();
    }

    public function showAddForm()
    {
        $this->resetForm();
        $this->showAddForm = true;
    }

    public function hideAddForm()
    {
        $this->showAddForm = false;
        $this->resetForm();
    }

    public function editSection($id)
    {
        $section = collect($this->sections)->firstWhere('id', $id);

        if (!$section) {
            session()->flash('error', 'Section not found.');
            return;
        }

        $this->editingId = $id;
        $this->name = $section['name'];
        $this->description = $section['description'];
        $this->code = $section['code'];
        $this->capacity = $section['capacity'];
        $this->isActive = $section['is_active'];
        $this->remarks = $section['remarks'];
        $this->showAddForm = true;
    }

    public function saveSection()
    {
        // Update validation rules for editing
        if ($this->editingId) {
            $this->rules['name'] = 'required|string|max:255|unique:sections,name,' . $this->editingId;
            $this->rules['code'] = 'nullable|string|max:10|unique:sections,code,' . $this->editingId;
        }

        $this->validate();

        try {
            DB::beginTransaction();

            $data = [
                'name' => $this->name,
                'description' => $this->description,
                'code' => $this->code,
                'capacity' => $this->capacity,
                'is_active' => $this->isActive,
                'remarks' => $this->remarks,
                'user_id' => auth()->id(),
                'session_id' => session('current_session_id', 1),
                'school_id' => session('current_school_id', 1),
            ];

            if ($this->editingId) {
                // Update existing
                $section = Section::findOrFail($this->editingId);
                $section->update($data);
                session()->flash('message', 'Section updated successfully!');
            } else {
                // Create new
                Section::create($data);
                session()->flash('message', 'Section created successfully!');
            }

            DB::commit();

            $this->loadSections();
            $this->hideAddForm();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving section: ' . $e->getMessage());
            session()->flash('error', 'Error saving section: ' . $e->getMessage());
        }
    }

    public function deleteSection($id)
    {
        try {
            DB::beginTransaction();

            $section = Section::findOrFail($id);

            // Check if section has related data
            if (
                $section->myclass_sections()->count() > 0 ||
                $section->studentcrs()->count() > 0
            ) {
                session()->flash('error', 'Cannot delete section with existing class assignments or students.');
                return;
            }

            $section->delete();

            DB::commit();

            session()->flash('message', 'Section deleted successfully!');
            $this->loadSections();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting section: ' . $e->getMessage());
            session()->flash('error', 'Error deleting section: ' . $e->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        try {
            $section = Section::findOrFail($id);
            $section->update([
                'is_active' => !$section->is_active
            ]);

            session()->flash('message', 'Status updated successfully!');
            $this->loadSections();
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
        $this->capacity = null;
        $this->isActive = true;
        $this->remarks = '';
        $this->resetErrorBag();
    }

    public function refreshData()
    {
        try {
            $this->loadSections();
            session()->flash('message', 'Data refreshed successfully!');
        } catch (\Exception $e) {
            Log::error('Error refreshing data: ' . $e->getMessage());
            session()->flash('error', 'Error refreshing data: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.section-comp');
    }
}
