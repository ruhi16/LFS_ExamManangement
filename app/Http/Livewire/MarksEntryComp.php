<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Myclass;
use App\Models\MyclassSection;
use App\Models\MyclassSubject;
use App\Models\Exam01Name;
use App\Models\Exam02Type;
use App\Models\Exam03Part;
use App\Models\Exam05Detail;
use App\Models\Exam06ClassSubject;
use App\Models\Exam07AnsscrDist;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MarksEntryComp extends Component
{
    public $selectedClassId = null;
    public $selectedExamNameId = null;
    public $examNames;
    public $examTypes;
    public $examParts;
    
    public $classSections;
    public $classSubjects;
    public $examDetails;

    public $answerScriptDistributions;

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
            
            $this->examDetails = []; // Initialize as array instead of collection

            $this->loadExamNames();
            $this->loadExamTypes();
            $this->loadExamParts();

            $this->answerScriptDistributions = Exam07AnsscrDist::all();


        } catch (\Exception $e) {
            Log::error('Error in MarksEntryComp mount: ' . $e->getMessage());
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
            $this->examNames = Exam01Name::orderBy('id')->get();
        } catch (\Exception $e) {
            Log::error('Error loading exam names: ' . $e->getMessage());
            $this->examNames = collect();
        }
    }

    protected function loadExamTypes()
    {
        try {
            // Order by type: Summative first, then Formative
            $this->examTypes = Exam02Type::where('is_active', true)
                // ->orderByRaw("CASE WHEN LOWER(name) LIKE '%summative%' THEN 1 WHEN LOWER(name) LIKE '%formative%' THEN 2 ELSE 3 END")
                ->orderBy('id', 'desc')
                ->get();
        } catch (\Exception $e) {
            Log::error('Error loading exam types: ' . $e->getMessage());
            $this->examTypes = collect();
        }
    }

    protected function loadExamParts()
    {
        try {
            $this->examParts = Exam03Part::where('is_active', true)->orderBy('id')->get();
        } catch (\Exception $e) {
            Log::error('Error loading exam parts: ' . $e->getMessage());
            $this->examParts = collect();
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
            session()->flash('message', "DEBUG: Starting selectExamName with ID: {$examNameId}");
            $this->selectedExamNameId = $examNameId;
            session()->flash('message', "DEBUG: Set selectedExamNameId to: {$this->selectedExamNameId}");
            
            $this->resetData();
            $this->loadClassData();
            $this->loadExamDetails();
            session()->flash('message', "DEBUG: Completed loadExamDetails");
        } catch (\Exception $e) {
            Log::error('Error selecting exam name: ' . $e->getMessage());
            session()->flash('error', 'ERROR in selectExamName: ' . $e->getMessage() . ' | Line: ' . $e->getLine() . ' | File: ' . $e->getFile());
        }
    }

    protected function resetData()
    {
        $this->classSections = collect();
        $this->classSubjects = collect();
        $this->examDetails = []; // Reset as array
    }

    protected function loadClassData()
    {
        if (!$this->selectedClassId) {
            return;
        }

        try {
            // Load examDetailids
            $examDetailIds = Exam05Detail::where('myclass_id', $this->selectedClassId)
                ->where('exam_name_id', $this->selectedExamNameId)                
                ->where('is_active', true)
                ->pluck('id');

            // Load class sections
            $this->classSections = MyclassSection::with('section')->where('myclass_id', $this->selectedClassId)
                ->where('is_active', true)
                ->orderBy('id')
                ->get();

            // Load class subjects - check if exam configurations exist
            if ($this->selectedExamNameId) {
                // First check if there are any configurations for this class and exam
                $configuredSubjectIds = MyclassSubject::with('subject')
                    ->where('myclass_id', $this->selectedClassId)                                        
                    ->where('is_active', true)
                    ->distinct()
                    ->pluck('subject_id');
                // dd($configuredSubjectIds);

                Log::info("Found " . $configuredSubjectIds->count() . " configured subjects for class {$this->selectedClassId}, exam {$this->selectedExamNameId}");

                // If there is any subject available for the class, then selected for the exam
                if ($configuredSubjectIds->isNotEmpty()) {
                    // Use configured subjects only
                    $this->classSubjects = Exam06ClassSubject::with('subject')
                        ->where('myclass_id', $this->selectedClassId)
                        ->whereIn('exam_detail_id', $examDetailIds)
                        ->whereIn('subject_id', $configuredSubjectIds)
                        ->where('is_active', true)
                        ->orderBy('order_index')
                        ->get();
                } else {
                    // No configurations found, show all class subjects with a warning
                    $this->classSubjects = Exam06ClassSubject::with('subject')
                        ->where('myclass_id', $this->selectedClassId)
                        ->whereIn('exam_detail_id', $examDetailIds)
                        ->where('is_active', true)
                        ->orderBy('order_index')
                        ->get();

                    if ($this->classSubjects->isNotEmpty()) {
                        session()->flash('warning', 'No exam configurations found for this class and exam. Showing all class subjects. Please configure exams in Class Exam Subject first.');
                    }
                }

                
            } else {
                // If no exam selected, load all class subjects
                $this->classSubjects = MyclassSubject::with('subject')
                    ->where('myclass_id', $this->selectedClassId)
                    ->where('is_active', true)
                    ->orderBy('order_index')
                    ->get();
            }
            // dd($this->classSubjects);
            
            // Load class subjects
            // $this->classSubjects = MyclassSubject::with('subject')
            //     ->where('myclass_id', $this->selectedClassId)
            //     ->where('is_active', true)
            //     ->orderBy('order_index')
            //     ->get();

            Log::info("Loaded " . $this->classSections->count() . " sections and " . $this->classSubjects->count() . " subjects for class {$this->selectedClassId}");
        } catch (\Exception $e) {
            Log::error('Error loading class data: ' . $e->getMessage());
            session()->flash('error', 'Error loading class data: ' . $e->getMessage());
        }
    }

    protected function loadExamDetails()
    {
        session()->flash('message', "DEBUG: Starting loadExamDetails - ClassID: {$this->selectedClassId}, ExamID: {$this->selectedExamNameId}");

        if (!$this->selectedClassId || !$this->selectedExamNameId) {
            session()->flash('error', "DEBUG: Missing required IDs - ClassID: {$this->selectedClassId}, ExamID: {$this->selectedExamNameId}");
            return;
        }

        try {
            session()->flash('message', "DEBUG: About to query Exam05Detail");

            // Load exam details for the selected class and exam
            $examDetailsQuery = Exam05Detail::with(['examType', 'examPart'])
                ->where('myclass_id', $this->selectedClassId)
                ->where('exam_name_id', $this->selectedExamNameId)
                ->get();

            session()->flash('message', "DEBUG: Query completed, found " . $examDetailsQuery->count() . " exam details");

            // Use simple array structure instead of Collection groupBy to avoid getKey() issues
            session()->flash('message', "DEBUG: About to organize by exam_type_id");
            $this->examDetails = [];

            foreach ($examDetailsQuery as $examDetail) {
                $typeId = $examDetail->exam_type_id;
                if (!isset($this->examDetails[$typeId])) {
                    $this->examDetails[$typeId] = [];
                }
                $this->examDetails[$typeId][] = $examDetail;
            }
            // dd($examDetailsQuery, $this->examDetails);

            session()->flash('message', "DEBUG: Organization completed, types: " . count($this->examDetails));

            // Debug the structure
            $debugInfo = [];
            foreach ($this->examDetails as $typeId => $details) {
                $debugInfo[] = "Type {$typeId}: " . count($details) . " details";
            }
            session()->flash('message', "DEBUG: Group structure: " . implode(', ', $debugInfo));

            Log::info("Loaded exam details for class {$this->selectedClassId}, exam {$this->selectedExamNameId}");
        } catch (\Exception $e) {
            Log::error('Error loading exam details: ' . $e->getMessage());
            session()->flash('error', 'ERROR in loadExamDetails: ' . $e->getMessage() . ' | Line: ' . $e->getLine() . ' | File: ' . $e->getFile());
            $this->examDetails = [];
        }
    }

    public function openMarksEntry($examDetailId, $subjectId, $sectionId)
    {
        try {
            // Redirect to marks entry page with parameters
            return redirect()->route('marks-entry.detail', [
                'examDetailId' => $examDetailId,
                'subjectId' => $subjectId,
                'sectionId' => $sectionId
            ]);
        } catch (\Exception $e) {
            Log::error('Error opening marks entry: ' . $e->getMessage());
            session()->flash('error', 'Error opening marks entry: ' . $e->getMessage());
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
                    $this->loadExamDetails();
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

    public function debugExamDetails()
    {
        try {
            $debugInfo = [
                'selectedClassId' => $this->selectedClassId,
                'selectedExamNameId' => $this->selectedExamNameId,
                'examDetails_type' => gettype($this->examDetails),
                'examDetails_count' => is_array($this->examDetails) ? count($this->examDetails) : 'NOT_ARRAY',
                'examDetails_keys' => is_array($this->examDetails) ? array_keys($this->examDetails) : 'NOT_ARRAY',
                'examTypes_count' => $this->examTypes ? $this->examTypes->count() : 'NULL',
            ];

            if (is_array($this->examDetails) && count($this->examDetails) > 0) {
                foreach ($this->examDetails as $typeId => $details) {
                    $debugInfo["type_{$typeId}_count"] = count($details);
                    $debugInfo["type_{$typeId}_first_item"] = !empty($details) ? get_class($details[0]) : 'EMPTY';
                }
            }

            session()->flash('message', 'DEBUG INFO: ' . json_encode($debugInfo, JSON_PRETTY_PRINT));
        } catch (\Exception $e) {
            session()->flash('error', 'DEBUG ERROR: ' . $e->getMessage() . ' | Line: ' . $e->getLine());
        }
    }

    public function render()
    {
        return view('livewire.marks-entry-comp', [
            'classes' => $this->getClassesProperty()
        ]);
    }
}
