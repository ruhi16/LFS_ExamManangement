<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exam07AnsscrDist;
use App\Models\Myclass;
use App\Models\MyclassSection;
use App\Models\MyclassSubject;
use App\Models\Exam01Name;
use App\Models\Exam02Type;
use App\Models\Exam03Part;
use App\Models\Exam05Detail;
use App\Models\Exam06ClassSubject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AnswerScriptDistributionComp extends Component
{
    public $selectedClassId = null;
    public $selectedExamNameId = null;
    public $examNames;
    public $examTypes;
    public $examParts;
    public $classSections;
    public $classSubjects;
    public $distributions;

    // Modal properties
    public $showModal = false;
    public $modalSubjectId = null;
    public $modalExamTypeId = null;
    public $modalExamPartId = null;
    public $modalSectionId = null;
    public $selectedTeacherId = null;
    public $teachers;

    // Debug properties
    public $debugMode = false;

    public function mount()
    {
        try {
            // Initialize collections
            $this->examNames = collect();
            $this->examTypes = collect();
            $this->examParts = collect();
            $this->classSections = collect();
            $this->classSubjects = collect();
            $this->distributions = collect();
            $this->teachers = collect();

            $this->loadExamNames();
            $this->loadExamTypes();
            $this->loadExamParts();
            $this->loadTeachers();
            // dd($this->teachers);
        } catch (\Exception $e) {
            Log::error('Error in AnswerScriptDistributionComp mount: ' . $e->getMessage());
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
            $this->examTypes = Exam02Type::orderBy('name')->get();
        } catch (\Exception $e) {
            Log::error('Error loading exam types: ' . $e->getMessage());
            $this->examTypes = collect();
        }
    }

    protected function loadExamParts()
    {
        try {
            $this->examParts = Exam03Part::orderBy('name')->get();
        } catch (\Exception $e) {
            Log::error('Error loading exam parts: ' . $e->getMessage());
            $this->examParts = collect();
        }
    }

    protected function loadTeachers()
    {
        try {
            // Load teachers from User model with teacher role or from Teacher model
            $this->teachers = Teacher::all(); //where('is_active', true)
            // dd($this->teachers);
            //User::where('role', 'teacher')

            // ->orderBy('id')
            // ->get();

            // If no teachers found in users, try Teacher model
            // if ($this->teachers->isEmpty()) {
            //     $this->teachers = Teacher::where('is_active', true)
            //         ->orderBy('name')
            //         ->get();
            // }
        } catch (\Exception $e) {
            Log::error('Error loading teachers: ' . $e->getMessage());
            $this->teachers = collect();
        }
    }

    public function selectClass($classId)
    {
        try {
            $this->selectedClassId = $classId;
            $this->selectedExamNameId = null;
            $this->resetData();
            $this->loadClassData();
        } catch (\Exception $e) {
            Log::error('Error selecting class: ' . $e->getMessage());
            session()->flash('error', 'Error loading class data: ' . $e->getMessage());
        }
    }

    public function selectExamName($examNameId)
    {
        try {
            $this->selectedExamNameId = $examNameId;
            $this->loadDistributions();
        } catch (\Exception $e) {
            Log::error('Error selecting exam name: ' . $e->getMessage());
            session()->flash('error', 'Error loading exam data: ' . $e->getMessage());
        }
    }

    protected function resetData()
    {
        $this->classSections = collect();
        $this->classSubjects = collect();
        $this->distributions = collect();
    }

    protected function loadClassData()
    {
        if (!$this->selectedClassId) {
            return;
        }

        try {
            // Load class sections
            $this->classSections = MyclassSection::where('myclass_id', $this->selectedClassId)
                ->where('is_active', true)
                ->orderBy('name')
                ->get();

            // Load class subjects
            $this->classSubjects = MyclassSubject::with('subject')
                ->where('myclass_id', $this->selectedClassId)
                ->where('is_active', true)
                ->orderBy('order_index')
                ->get();

            Log::info("Loaded " . $this->classSections->count() . " sections and " . $this->classSubjects->count() . " subjects for class {$this->selectedClassId}");
        } catch (\Exception $e) {
            Log::error('Error loading class data: ' . $e->getMessage());
            session()->flash('error', 'Error loading class data: ' . $e->getMessage());
        }
    }

    protected function loadDistributions()
    {
        if (!$this->selectedClassId || !$this->selectedExamNameId) {
            return;
        }

        try {
            // Get exam details for the selected class and exam
            $examDetails = Exam05Detail::where('myclass_id', $this->selectedClassId)
                ->where('exam_name_id', $this->selectedExamNameId)
                ->get();

            $examDetailIds = $examDetails->pluck('id');

            // Get class sections for the selected class
            $classSections = MyclassSection::where('myclass_id', $this->selectedClassId)
                ->where('is_active', true)
                ->get();

            $classSectionIds = $classSections->pluck('id');

            // Load distributions with relationships
            $distributions = Exam07AnsscrDist::with(['teacher', 'user'])
                ->whereIn('exam_detail_id', $examDetailIds)
                ->whereIn('myclass_section_id', $classSectionIds)
                ->get();

            // Create a keyed collection for easy lookup
            $this->distributions = collect();

            foreach ($distributions as $distribution) {
                // Get the exam detail to find exam type and part
                $examDetail = $examDetails->where('id', $distribution->exam_detail_id)->first();

                // Get the class section to find section id
                $classSection = $classSections->where('id', $distribution->myclass_section_id)->first();

                // Get exam class subject to find subject id
                $examClassSubject = Exam06ClassSubject::where('id', $distribution->exam_class_subject_id)->first();

                if ($examDetail && $classSection && $examClassSubject) {
                    $key = "{$examClassSubject->subject_id}_{$examDetail->exam_type_id}_{$examDetail->exam_part_id}_{$classSection->section_id}";
                    $this->distributions[$key] = $distribution;
                }
            }

            Log::info("Loaded " . $this->distributions->count() . " distributions for class {$this->selectedClassId}, exam {$this->selectedExamNameId}");
        } catch (\Exception $e) {
            Log::error('Error loading distributions: ' . $e->getMessage());
            session()->flash('error', 'Error loading distributions: ' . $e->getMessage());
        }
    }

    public function openModal($subjectId, $examTypeId, $examPartId, $sectionId)
    {
        try {
            $this->modalSubjectId = $subjectId;
            $this->modalExamTypeId = $examTypeId;
            $this->modalExamPartId = $examPartId;
            $this->modalSectionId = $sectionId;

            // Check if distribution already exists
            $key = "{$subjectId}_{$examTypeId}_{$examPartId}_{$sectionId}";
            if (isset($this->distributions[$key])) {
                $distribution = $this->distributions[$key];

                // Handle both array and object cases
                if (is_array($distribution)) {
                    $this->selectedTeacherId = $distribution['teacher_id'] ?? $distribution['user_id'] ?? null;
                } else {
                    $this->selectedTeacherId = $distribution->teacher_id ?? $distribution->user_id ?? null;
                }
            } else {
                $this->selectedTeacherId = null;
            }

            $this->showModal = true;

            // Debug message
            if ($this->selectedTeacherId) {
                session()->flash('message', 'Opening edit modal for existing assignment');
            } else {
                session()->flash('message', 'Opening assign modal for new assignment');
            }

            Log::info("Opening modal for Subject: {$subjectId}, ExamType: {$examTypeId}, ExamPart: {$examPartId}, Section: {$sectionId}");
            Log::info("Selected Teacher ID: " . ($this->selectedTeacherId ?? 'null'));
        } catch (\Exception $e) {
            Log::error('Error opening modal: ' . $e->getMessage());
            session()->flash('error', 'Error opening assignment modal: ' . $e->getMessage());
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->modalSubjectId = null;
        $this->modalExamTypeId = null;
        $this->modalExamPartId = null;
        $this->modalSectionId = null;
        $this->selectedTeacherId = null;
    }

    public function assignTeacher()
    {
        try {
            if (!$this->selectedTeacherId) {
                session()->flash('error', 'Please select a teacher.');
                return;
            }

            // Validate required data
            if (
                !$this->selectedClassId || !$this->selectedExamNameId || !$this->modalSubjectId ||
                !$this->modalExamTypeId || !$this->modalExamPartId || !$this->modalSectionId
            ) {
                session()->flash('error', 'Missing required data. Please try again.');
                return;
            }

            DB::beginTransaction();

            // Check if assignment already exists
            $key = "{$this->modalSubjectId}_{$this->modalExamTypeId}_{$this->modalExamPartId}_{$this->modalSectionId}";

            $examDetail = Exam05Detail::where('myclass_id', $this->selectedClassId)
                ->where('exam_name_id', $this->selectedExamNameId)
                ->where('exam_type_id', $this->modalExamTypeId)
                ->where('exam_part_id', $this->modalExamPartId)
                // ->where('subject_id', $this->modalSubjectId)
                // ->where('section_id', $this->modalSectionId)
                ->first();

            $myclassSection = MyclassSection::where('myclass_id', $this->selectedClassId)
                ->where('section_id', $this->modalSectionId)
                ->first();

            $examClassSubject = Exam06ClassSubject::where('exam_detail_id', $examDetail->id)
                ->where('myclass_id', $this->selectedClassId)
                ->where('subject_id', $this->modalSubjectId)
                ->first();

            // dd($examDetail->id, $myclassSection->id, $examClassSubject->id);


            $distributionData = [
                'name' => $key,
                'exam_detail_id' => $examDetail->id,
                'myclass_section_id' => $myclassSection->id,
                'exam_class_subject_id' => $examClassSubject->id,

                // 'exam_name_id' => $this->selectedExamNameId,
                // 'exam_type_id' => $this->modalExamTypeId,
                // 'exam_part_id' => $this->modalExamPartId,
                // 'subject_id' => $this->modalSubjectId,
                // 'section_id' => $this->modalSectionId,
                'teacher_id' => $this->selectedTeacherId,
                'user_id' => auth()->id(),    //$this->selectedTeacherId, // Assuming teacher_id and user_id are the same
                'is_active' => true,
                // 'assigned_by' => auth()->id(),
                // 'assigned_at' => now(),
            ];
            // dd($distributionData, $key);
            // dd($this->distributions);

            // Exam07AnsscrDist::updateOrCreate([
            //     'exam_detail_id' => $examDetail->id ?? 0,
            //     'myclass_section_id' => $myclassSection->id,
            //     'exam_class_subject_id' => $examClassSubject->id,

            // ],[
            //     'teacher_id' => $this->selectedTeacherId,
            //     'user_id' => auth()->id(),    //$this->selectedTeacherId, // Assuming teacher_id and user_id are the same
            //     'is_active' => true,
            // ]);

            if (isset($this->distributions[$key])) {
                // Update existing
                $distribution = $this->distributions[$key];

                // If it's an array, get the model by ID
                if (is_array($distribution)) {
                    $distributionModel = Exam07AnsscrDist::find($distribution['id']);
                    if ($distributionModel) {
                        $distributionModel->update($distributionData);
                        $this->distributions[$key] = $distributionModel;
                    }
                } else {
                    // If it's already a model object
                    $distribution->update($distributionData);
                }

                $message = 'Teacher assignment updated successfully!';
            } else {
                // Create new
                $newDistribution = Exam07AnsscrDist::create($distributionData);
                $this->distributions[$key] = $newDistribution;
                $message = 'Teacher assigned successfully!';
            }

            DB::commit();

            // Reload distributions to reflect changes
            $this->loadDistributions();

            $this->closeModal();
            session()->flash('message', $message);

            Log::info("Teacher {$this->selectedTeacherId} assigned to Subject: {$this->modalSubjectId}, ExamType: {$this->modalExamTypeId}, ExamPart: {$this->modalExamPartId}, Section: {$this->modalSectionId}");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error assigning teacher: ' . $e->getMessage());
            session()->flash('error', 'Error assigning teacher: ' . $e->getMessage());
        }
    }

    public function removeAssignment($subjectId, $examTypeId, $examPartId, $sectionId)
    {
        try {
            $key = "{$subjectId}_{$examTypeId}_{$examPartId}_{$sectionId}";

            if (isset($this->distributions[$key])) {
                $distribution = $this->distributions[$key];

                // If it's an array, get the model by ID
                if (is_array($distribution)) {
                    $distributionModel = Exam07AnsscrDist::find($distribution['id']);
                    if ($distributionModel) {
                        $distributionModel->delete();
                    }
                } else {
                    // If it's already a model object
                    $distribution->delete();
                }

                unset($this->distributions[$key]);

                session()->flash('message', 'Teacher assignment removed successfully!');
                Log::info("Removed assignment for Subject: {$subjectId}, ExamType: {$examTypeId}, ExamPart: {$examPartId}, Section: {$sectionId}");
            }
        } catch (\Exception $e) {
            Log::error('Error removing assignment: ' . $e->getMessage());
            session()->flash('error', 'Error removing assignment: ' . $e->getMessage());
        }
    }

    // Debug methods
    public function checkDatabaseConnection()
    {
        try {
            DB::select('SELECT 1');
            session()->flash('message', 'Database connection successful!');
        } catch (\Exception $e) {
            session()->flash('error', 'Database connection failed: ' . $e->getMessage());
        }
    }

    public function testDataLoad()
    {
        try {
            $distributionCount = Exam07AnsscrDist::count();
            $classCount = Myclass::where('is_active', true)->count();
            $teacherCount = $this->teachers->count();

            session()->flash('message', "Test Data Load: Distributions={$distributionCount}, Classes={$classCount}, Teachers={$teacherCount}");
        } catch (\Exception $e) {
            Log::error('Test data load failed: ' . $e->getMessage());
            session()->flash('error', 'Test data load failed: ' . $e->getMessage());
        }
    }

    public function toggleDebugMode()
    {
        $this->debugMode = !$this->debugMode;
        session()->flash('message', 'Debug mode ' . ($this->debugMode ? 'enabled' : 'disabled'));
    }

    public function refreshData()
    {
        try {
            if ($this->selectedClassId) {
                $this->loadClassData();
                if ($this->selectedExamNameId) {
                    $this->loadDistributions();
                }
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
        return view('livewire.answer-script-distribution-comp', [
            'classes' => $this->getClassesProperty()
        ]);
    }
}
