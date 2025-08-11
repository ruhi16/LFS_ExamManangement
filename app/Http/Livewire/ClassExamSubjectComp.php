<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Myclass;
use App\Models\MyclassSubject;
use App\Models\Exam01Name;
use App\Models\Exam02Type;
use App\Models\Exam05Detail;
use App\Models\Exam06ClassSubject;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ClassExamSubjectComp extends Component
{
    public $selectedClassId = null;
    public $examNames;
    public $examTypes;
    public $classSubjects;
    public $examDetails = [];
    public $subjectSelections = []; // [subject_id][exam_name_id][exam_type_id] = true/false

    // Debug properties
    public $debugMode = false;

    public function mount()
    {
        try {
            // Initialize collections
            $this->examNames = collect();
            $this->examTypes = collect();
            $this->classSubjects = collect();
            $this->examDetails = [];
            $this->subjectSelections = [];

            $this->loadExamNames();
            $this->loadExamTypes();
        } catch (\Exception $e) {
            Log::error('Error in ClassExamSubjectComp mount: ' . $e->getMessage());
            session()->flash('error', 'Error initializing component: ' . $e->getMessage());
        }
    }

    public function getClassesProperty()
    {
        try {
            return Myclass::where('is_active', true)->orderBy('id')->get();
        } catch (\Exception $e) {
            Log::error('Error getting classes: ' . $e->getMessage());
            return collect();
        }
    }

    protected function loadExamNames()
    {
        try {
            $this->examNames = Exam01Name::orderBy('name')->get();
        } catch (\Exception $e) {
            Log::error('Error loading exam names: ' . $e->getMessage());
            $this->examNames = collect();
        }
    }

    protected function loadExamTypes()
    {
        try {
            // Order by type: Summative first, then Formative
            $this->examTypes = Exam02Type::orderByRaw("CASE WHEN LOWER(name) LIKE '%summative%' THEN 1 WHEN LOWER(name) LIKE '%formative%' THEN 2 ELSE 3 END")
                ->orderBy('name')
                ->get();
        } catch (\Exception $e) {
            Log::error('Error loading exam types: ' . $e->getMessage());
            $this->examTypes = collect();
        }
    }

    public function selectClass($classId)
    {
        try {
            $this->selectedClassId = $classId;
            $this->resetData();
            $this->loadClassSubjects();
            $this->loadExamDetails();
            $this->loadExistingSelections();
        } catch (\Exception $e) {
            Log::error('Error selecting class: ' . $e->getMessage());
            session()->flash('error', 'Error loading class data: ' . $e->getMessage());
        }
    }

    protected function resetData()
    {
        $this->classSubjects = collect();
        $this->examDetails = [];
        $this->subjectSelections = [];
    }

    protected function loadClassSubjects()
    {
        if (!$this->selectedClassId) {
            return;
        }

        try {
            // Load class subjects
            $this->classSubjects = MyclassSubject::with('subject')
                ->where('myclass_id', $this->selectedClassId)
                ->where('is_active', true)
                ->orderBy('order_index')
                ->get();

            Log::info("Loaded " . $this->classSubjects->count() . " subjects for class {$this->selectedClassId}");
        } catch (\Exception $e) {
            Log::error('Error loading class subjects: ' . $e->getMessage());
            session()->flash('error', 'Error loading class subjects: ' . $e->getMessage());
        }
    }

    protected function loadExamDetails()
    {
        if (!$this->selectedClassId) {
            return;
        }

        try {
            // Load all exam details for this class
            $examDetailsQuery = Exam05Detail::where('myclass_id', $this->selectedClassId)->get();

            $this->examDetails = [];
            foreach ($examDetailsQuery as $examDetail) {
                $key = $examDetail->exam_name_id . '_' . $examDetail->exam_type_id;
                // Store as array to avoid Livewire serialization issues
                $this->examDetails[$key] = [
                    'id' => $examDetail->id,
                    'exam_name_id' => $examDetail->exam_name_id,
                    'exam_type_id' => $examDetail->exam_type_id,
                    'myclass_id' => $examDetail->myclass_id,
                ];
            }

            Log::info("Loaded " . count($this->examDetails) . " exam details for class {$this->selectedClassId}");
        } catch (\Exception $e) {
            Log::error('Error loading exam details: ' . $e->getMessage());
            session()->flash('error', 'Error loading exam details: ' . $e->getMessage());
        }
    }

    protected function loadExistingSelections()
    {
        if (!$this->selectedClassId) {
            return;
        }

        try {
            // Load existing Exam06ClassSubject records
            $existingSelections = Exam06ClassSubject::with(['examDetail'])
                ->where('myclass_id', $this->selectedClassId)
                ->get();

            $this->subjectSelections = [];
            foreach ($existingSelections as $selection) {
                if ($selection->examDetail) {
                    $subjectId = $selection->subject_id;
                    $examNameId = $selection->examDetail->exam_name_id;
                    $examTypeId = $selection->examDetail->exam_type_id;

                    $this->subjectSelections[$subjectId][$examNameId][$examTypeId] = true;
                }
            }

            Log::info("Loaded " . $existingSelections->count() . " existing subject selections");
        } catch (\Exception $e) {
            Log::error('Error loading existing selections: ' . $e->getMessage());
            session()->flash('error', 'Error loading existing selections: ' . $e->getMessage());
        }
    }

    public function toggleSubjectSelection($subjectId, $examNameId, $examTypeId)
    {
        try {
            $examDetailKey = $examNameId . '_' . $examTypeId;

            if (!isset($this->examDetails[$examDetailKey])) {
                session()->flash('error', 'Exam detail not found for this combination. Please create exam details first.');
                return;
            }

            $examDetail = $this->examDetails[$examDetailKey];

            // Debug logging
            Log::info("Toggle selection - Key: {$examDetailKey}, ExamDetail type: " . gettype($examDetail));

            if (!$examDetail || !is_array($examDetail) || !isset($examDetail['id'])) {
                session()->flash('error', 'Invalid exam detail data. Please refresh and try again.');
                Log::error("Invalid exam detail - Key: {$examDetailKey}, Detail: " . json_encode($examDetail));
                return;
            }

            $isCurrentlySelected = $this->subjectSelections[$subjectId][$examNameId][$examTypeId] ?? false;

            if ($isCurrentlySelected) {
                // Remove selection
                $this->removeSubjectSelection($subjectId, $examDetail['id']);
                if (isset($this->subjectSelections[$subjectId][$examNameId][$examTypeId])) {
                    unset($this->subjectSelections[$subjectId][$examNameId][$examTypeId]);
                }
            } else {
                // Add selection
                $this->addSubjectSelection($subjectId, $examDetail['id']);
                if (!isset($this->subjectSelections[$subjectId])) {
                    $this->subjectSelections[$subjectId] = [];
                }
                if (!isset($this->subjectSelections[$subjectId][$examNameId])) {
                    $this->subjectSelections[$subjectId][$examNameId] = [];
                }
                $this->subjectSelections[$subjectId][$examNameId][$examTypeId] = true;
            }

            session()->flash('message', 'Subject selection updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error toggling subject selection: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            session()->flash('error', 'Error updating subject selection: ' . $e->getMessage());
        }
    }

    protected function addSubjectSelection($subjectId, $examDetailId)
    {
        try {
            DB::beginTransaction();

            Exam06ClassSubject::updateOrCreate([
                'exam_detail_id' => $examDetailId,
                'myclass_id' => $this->selectedClassId,
                'subject_id' => $subjectId,
            ], [
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit();
            Log::info("Added subject {$subjectId} to exam detail {$examDetailId}");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error adding subject selection: ' . $e->getMessage());
            throw $e;
        }
    }

    protected function removeSubjectSelection($subjectId, $examDetailId)
    {
        try {
            DB::beginTransaction();

            Exam06ClassSubject::where('exam_detail_id', $examDetailId)
                ->where('myclass_id', $this->selectedClassId)
                ->where('subject_id', $subjectId)
                ->delete();

            DB::commit();
            Log::info("Removed subject {$subjectId} from exam detail {$examDetailId}");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error removing subject selection: ' . $e->getMessage());
            throw $e;
        }
    }

    public function saveAllSelections()
    {
        try {
            if (!$this->selectedClassId) {
                session()->flash('error', 'Please select a class first.');
                return;
            }

            DB::beginTransaction();

            // Remove all existing selections for this class
            Exam06ClassSubject::where('myclass_id', $this->selectedClassId)->delete();

            // Add all current selections
            $count = 0;
            foreach ($this->subjectSelections as $subjectId => $examNames) {
                foreach ($examNames as $examNameId => $examTypes) {
                    foreach ($examTypes as $examTypeId => $isSelected) {
                        if ($isSelected) {
                            $examDetailKey = $examNameId . '_' . $examTypeId;
                            if (isset($this->examDetails[$examDetailKey])) {
                                $examDetail = $this->examDetails[$examDetailKey];

                                Exam06ClassSubject::create([
                                    'exam_detail_id' => $examDetail['id'],
                                    'myclass_id' => $this->selectedClassId,
                                    'subject_id' => $subjectId,
                                    'is_active' => true,
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]);
                                $count++;
                            }
                        }
                    }
                }
            }

            DB::commit();
            session()->flash('message', "Successfully saved {$count} subject selections!");
            Log::info("Saved {$count} subject selections for class {$this->selectedClassId}");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving all selections: ' . $e->getMessage());
            session()->flash('error', 'Error saving selections: ' . $e->getMessage());
        }
    }

    public function clearAllSelections()
    {
        try {
            if (!$this->selectedClassId) {
                session()->flash('error', 'Please select a class first.');
                return;
            }

            DB::beginTransaction();

            // Remove all existing selections for this class
            $count = Exam06ClassSubject::where('myclass_id', $this->selectedClassId)->count();
            Exam06ClassSubject::where('myclass_id', $this->selectedClassId)->delete();

            // Clear local selections
            $this->subjectSelections = [];

            DB::commit();
            session()->flash('message', "Successfully cleared {$count} subject selections!");
            Log::info("Cleared {$count} subject selections for class {$this->selectedClassId}");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error clearing all selections: ' . $e->getMessage());
            session()->flash('error', 'Error clearing selections: ' . $e->getMessage());
        }
    }

    // Debug methods
    public function toggleDebugMode()
    {
        $this->debugMode = !$this->debugMode;
        session()->flash('message', 'Debug mode ' . ($this->debugMode ? 'enabled' : 'disabled'));
    }

    public function refreshData()
    {
        try {
            if ($this->selectedClassId) {
                $this->loadClassSubjects();
                $this->loadExamDetails();
                $this->loadExistingSelections();
                session()->flash('message', 'Data refreshed successfully!');
            } else {
                session()->flash('error', 'Please select a class first.');
            }
        } catch (\Exception $e) {
            Log::error('Error refreshing data: ' . $e->getMessage());
            session()->flash('error', 'Error refreshing data: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.class-exam-subject-comp');
    }
}
