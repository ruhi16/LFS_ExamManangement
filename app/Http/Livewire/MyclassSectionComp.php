<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Myclass;
use App\Models\Section;
use App\Models\MyclassSection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MyclassSectionComp extends Component
{
    public $classes = [];
    public $sections = [];
    public $classesWithSections = [];

    public function mount()
    {
        $this->loadData();
    }

    protected function loadData()
    {
        try {
            // Load all active classes
            $this->classes = Myclass::where('is_active', true)->orderBy('order_index')->get();

            // Load all active sections
            $this->sections = Section::where('is_active', true)->orderBy('name')->get();

            // Load classes with their sections
            $this->classesWithSections = $this->classes->map(function ($class) {
                $classSections = MyclassSection::where('myclass_id', $class->id)
                    ->with(['section'])
                    ->orderBy('order_index')
                    ->get()
                    ->map(function ($classSection) use ($class) {
                        return [
                            'id' => $classSection->id,
                            'section_name' => $classSection->section->name ?? 'Unknown',
                            'section_code' => $classSection->section->code ?? '',
                            'order_index' => $classSection->order_index ?? 1,
                            'is_active' => $classSection->is_active,
                            'students_count' => $classSection->section->studentcrs()->where('myclass_id', $class->id)->count()
                        ];
                    });

                // Get available sections for this class
                $assignedSectionIds = MyclassSection::where('myclass_id', $class->id)->pluck('section_id')->toArray();
                $availableSections = $this->sections->whereNotIn('id', $assignedSectionIds);

                return [
                    'id' => $class->id,
                    'name' => $class->name,
                    'description' => $class->description,
                    'is_active' => $class->is_active,
                    'sections' => $classSections->toArray(),
                    'sections_count' => $classSections->count(),
                    'available_sections' => $availableSections->toArray(),
                    'has_available_sections' => $availableSections->count() > 0
                ];
            })->toArray();
        } catch (\Exception $e) {
            Log::error('Error loading data: ' . $e->getMessage());
            session()->flash('error', 'Error loading data: ' . $e->getMessage());
        }
    }

    public function addSectionToClass($classId)
    {
        try {
            DB::beginTransaction();

            // Get the first available section for this class
            $assignedSectionIds = MyclassSection::where('myclass_id', $classId)
                ->pluck('section_id')
                ->toArray();

            $availableSection = Section::where('is_active', true)
                ->whereNotIn('id', $assignedSectionIds)
                ->orderBy('name')
                ->first();

            if (!$availableSection) {
                session()->flash('error', 'No available sections to add to this class.');
                return;
            }

            // Get the next order index
            $nextOrderIndex = MyclassSection::where('myclass_id', $classId)->max('order_index') + 1;

            // Create the class section
            MyclassSection::create([
                'myclass_id' => $classId,
                'section_id' => $availableSection->id,
                'name' => $availableSection->name,
                'description' => $availableSection->description,
                'capacity' => $availableSection->capacity,
                'order_index' => $nextOrderIndex,
                'is_active' => true,
                'user_id' => auth()->id(),
                'session_id' => session('current_session_id', 1),
                'school_id' => session('current_school_id', 1),
            ]);

            DB::commit();

            session()->flash('message', "Section '{$availableSection->name}' added to class successfully!");
            $this->loadData();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error adding section to class: ' . $e->getMessage());
            session()->flash('error', 'Error adding section to class: ' . $e->getMessage());
        }
    }

    public function removeSectionFromClass($classId)
    {
        try {
            DB::beginTransaction();

            // Get the last added section for this class
            $lastSection = MyclassSection::where('myclass_id', $classId)
                ->orderBy('order_index', 'desc')
                ->first();

            if (!$lastSection) {
                session()->flash('error', 'No sections to remove from this class.');
                return;
            }

            // Check if there are students in this class-section combination
            $studentsCount = $lastSection->section->studentcrs()
                ->where('myclass_id', $classId)
                ->count();

            if ($studentsCount > 0) {
                session()->flash('error', 'Cannot remove section with existing students.');
                return;
            }

            $sectionName = $lastSection->section->name ?? 'Unknown';
            $lastSection->delete();

            DB::commit();

            session()->flash('message', "Section '{$sectionName}' removed from class successfully!");
            $this->loadData();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error removing section from class: ' . $e->getMessage());
            session()->flash('error', 'Error removing section from class: ' . $e->getMessage());
        }
    }

    public function refreshData()
    {
        try {
            $this->loadData();
            session()->flash('message', 'Data refreshed successfully!');
        } catch (\Exception $e) {
            Log::error('Error refreshing data: ' . $e->getMessage());
            session()->flash('error', 'Error refreshing data: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.myclass-section-comp');
    }
}
