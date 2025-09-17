<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Studentcr;
use App\Models\Studentdb;
use App\Models\Myclass;
use App\Models\MyclassSection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class StudentCrComp extends Component
{
    public $selectedClassId = null;
    public $selectedSectionId = null;
    public $students = [];
    public $studentRecords = [];

    // Modal properties
    public $showModal = false;
    public $selectedStudent = null;
    public $selectedStudentId = null;

    // Debug properties
    public $debugMode = false;

    public function mount()
    {
        try {
            // Initialize empty arrays
            $this->students = [];
            $this->studentRecords = [];
        } catch (\Exception $e) {
            Log::error('Error in StudentCrComp mount: ' . $e->getMessage());
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

    public function selectClass($classId)
    {
        try {
            $this->selectedClassId = $classId;
            $this->selectedSectionId = null;
            $this->students = [];
            $this->studentRecords = [];

            // Load sections for this class
            $this->loadClassSections();

            // If no sections available, load all students for this class
            $sections = $this->getClassSectionsProperty();
            // dd('Sections: ',$sections);
            if ($sections->isEmpty()) {
                $this->loadStudentRecords();
                session()->flash('message', 'No sections found for this class. Showing all students.');
            }
        } catch (\Exception $e) {
            Log::error('Error selecting class: ' . $e->getMessage());
            session()->flash('error', 'Error loading class data: ' . $e->getMessage());
        }
    }

    public function selectSection($sectionId)
    {
        try {
            $this->selectedSectionId = $sectionId;
            $this->loadStudentRecords();
        } catch (\Exception $e) {
            Log::error('Error selecting section: ' . $e->getMessage());
            session()->flash('error', 'Error loading section data: ' . $e->getMessage());
        }
    }

    public function getClassSectionsProperty()
    {

        if (!$this->selectedClassId) {
            return collect();
        }
        // dd('Selected Class:', $this->selectedClassId);
        try {
            return MyclassSection::where('myclass_id', $this->selectedClassId)
                ->where('is_active', true)
                ->orderBy('id')
                ->get();
        } catch (\Exception $e) {
            Log::error('Error getting class sections: ' . $e->getMessage());
            return collect();
        }
    }

    protected function loadClassSections()
    {
        $sections = $this->getClassSectionsProperty();
        if ($sections->isEmpty()) {
            Log::info("No sections found for class ID: {$this->selectedClassId}");
        }
        // This method can be used for additional logic when class is selected
        Log::info("Loading sections for class ID: {$this->selectedClassId}");
    }

    protected function loadStudentRecords()
    {

        try {
            if (!$this->selectedClassId) {
                return;
            }

            // Build query based on available data
            $query = Studentcr::with(['studentdb', 'myclass'])
                ->where('myclass_id', $this->selectedClassId)
                // ->where('is_active', true)
                // ->get()
            ;
            // dd($this->selectedSectionId);
            // Add section filter if section is selected and the column exists
            if ($this->selectedSectionId) {
                // Try to add section filter, but handle if column doesn't exist
                try {
                    $query->where('section_id', $this->selectedSectionId);
                } catch (\Exception $e) {
                    // If myclass_section_id doesn't exist, try section_id
                    try {
                        $query->where('section_id', $this->selectedSectionId);
                    } catch (\Exception $e2) {
                        Log::warning('Neither myclass_section_id nor section_id column found in studentcrs table');
                    }
                }
            }

            $this->studentRecords = $query->orderBy('roll_no')->get()->toArray();

            // Also get students from studentdb for reference
            $this->students = Studentdb::with('myclass')
                ->where('stclass_id', $this->selectedClassId)
                // ->where('is_active', true)
                ->orderBy('name')
                ->get()
                ->toArray();

            Log::info("Loaded " . count($this->studentRecords) . " student records for class {$this->selectedClassId}" . ($this->selectedSectionId ? ", section {$this->selectedSectionId}" : ""));

            if (count($this->studentRecords) > 0) {
                session()->flash('message', 'Loaded ' . count($this->studentRecords) . ' student records successfully!');
            } else {
                session()->flash('error', 'No student records found for this class' . ($this->selectedSectionId ? ' and section' : '') . '.');
            }
        } catch (\Exception $e) {
            Log::error('Error loading student records: ' . $e->getMessage());
            session()->flash('error', 'Error loading student records: ' . $e->getMessage());
        }
    }

    public function refreshData()
    {
        try {
            if ($this->selectedClassId && $this->selectedSectionId) {
                $this->loadStudentRecords();
                session()->flash('message', 'Data refreshed successfully!');
            } else {
                session()->flash('error', 'Please select a class and section first.');
            }
        } catch (\Exception $e) {
            Log::error('Error refreshing data: ' . $e->getMessage());
            session()->flash('error', 'Error refreshing data: ' . $e->getMessage());
        }
    }

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
            $studentcrCount = Studentcr::count();
            $studentdbCount = Studentdb::count();
            $classCount = Myclass::where('is_active', true)->count();
            $sectionCount = MyclassSection::count();

            session()->flash('message', "Test Data Load: Studentcr={$studentcrCount}, Studentdb={$studentdbCount}, Classes={$classCount}, Sections={$sectionCount}");
        } catch (\Exception $e) {
            Log::error('Test data load failed: ' . $e->getMessage());
            session()->flash('error', 'Test data load failed: ' . $e->getMessage());
        }
    }

    public function testStudentRecords()
    {
        try {
            // Get all student records without filters
            $allRecords = Studentcr::with(['studentdb', 'myclass'])->get();
            $recordsWithClass = Studentcr::whereNotNull('myclass_id')->count();
            $recordsWithSection = Studentcr::whereNotNull('myclass_section_id')->count();

            session()->flash('message', "All Records: {$allRecords->count()}, With Class: {$recordsWithClass}, With Section: {$recordsWithSection}");
        } catch (\Exception $e) {
            Log::error('Test student records failed: ' . $e->getMessage());
            session()->flash('error', 'Test student records failed: ' . $e->getMessage());
        }
    }

    public function loadAllStudents()
    {
        try {
            // Load all students without class/section filter for testing
            $this->studentRecords = Studentcr::with(['studentdb', 'myclass'])
                ->where('is_active', true)
                ->orderBy('id')
                ->get()
                ->toArray();

            session()->flash('message', 'Loaded ' . count($this->studentRecords) . ' total student records (no filters)');
        } catch (\Exception $e) {
            Log::error('Error loading all students: ' . $e->getMessage());
            session()->flash('error', 'Error loading all students: ' . $e->getMessage());
        }
    }

    public function toggleDebugMode()
    {
        $this->debugMode = !$this->debugMode;
        session()->flash('message', 'Debug mode ' . ($this->debugMode ? 'enabled' : 'disabled'));
    }

    public function viewStudent($studentId)
    {
        try {
            $this->selectedStudentId = $studentId;

            // Load the complete student record with all relationships
            $this->selectedStudent = Studentcr::with([
                'studentdb',
                'myclass',
                'myclassSection',
                'section'
            ])
                ->where('id', $studentId)
                ->first();

            if ($this->selectedStudent) {
                $this->showModal = true;
                Log::info("Viewing student record ID: {$studentId}");
            } else {
                session()->flash('error', 'Student record not found.');
            }
        } catch (\Exception $e) {
            Log::error('Error viewing student: ' . $e->getMessage());
            session()->flash('error', 'Error loading student details: ' . $e->getMessage());
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedStudent = null;
        $this->selectedStudentId = null;
    }

    public function editStudent($studentId)
    {
        // Placeholder for edit functionality
        session()->flash('message', "Edit functionality for student ID {$studentId} - Coming soon!");
    }

    public function deleteStudent($studentId)
    {
        try {
            $student = Studentcr::find($studentId);
            if ($student) {
                // Soft delete by setting is_active to false
                $student->update(['is_active' => false]);

                // Reload the student records
                $this->loadStudentRecords();

                session()->flash('message', 'Student record deactivated successfully!');
                Log::info("Deactivated student record ID: {$studentId}");
            } else {
                session()->flash('error', 'Student record not found.');
            }
        } catch (\Exception $e) {
            Log::error('Error deleting student: ' . $e->getMessage());
            session()->flash('error', 'Error deleting student: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.student-cr-comp', [
            'classes' => $this->classes,
            'classSections' => $this->classSections
        ]);
    }
}
