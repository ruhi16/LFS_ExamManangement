<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exam05Detail;
use App\Models\Exam06ClassSubject;
use App\Models\MyclassSection;
use App\Models\Studentcr;
use App\Models\Exam08Grade;
use App\Models\Exam10MarksEntry;
use App\Models\Exam02Type;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MarksEntryFormativeComp extends Component
{
    public $exam_detail_id;
    public $myclass_section_id;
    public $examDetail;
    public $myclassSection;
    public $students = [];
    public $formativeSubjects;
    public $grades; // This will be a collection
    public $marksData = [];
    public $isFinalized = false;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function refreshMarksData()
    {
        $this->loadMarksData();
        $this->emit('refreshComponent');
    }

    public function mount($exam_detail_id, $myclass_section_id)
    {
        Log::info('Mounting MarksEntryFormativeComp with exam_detail_id: ' . $exam_detail_id . ', myclass_section_id: ' . $myclass_section_id);
        $this->exam_detail_id = $exam_detail_id;
        $this->myclass_section_id = $myclass_section_id;
        $this->formativeSubjects = collect(); // Initialize as empty collection
        
        $this->loadData();
    }

    public function loadData()
    {
        // Load exam detail
        $this->examDetail = Exam05Detail::with(['examType', 'examName', 'myclass', 'examMode'])->findOrFail($this->exam_detail_id);
        
        // Load class section
        $this->myclassSection = MyclassSection::with(['myclass', 'section'])->findOrFail($this->myclass_section_id);
            
        // Load students for this class-section
        $this->students = Studentcr::with('studentdb')
            ->where('myclass_id', $this->myclassSection->myclass_id)
            ->where('section_id', $this->myclassSection->section_id)
            ->orderBy('roll_no')
            ->get();
            
        // First, get all subjects for this exam detail
        $allSubjects = Exam06ClassSubject::with('subject.subjectType')
            ->where('exam_detail_id', $this->exam_detail_id)
            ->get();
            
        // Debug logging for all subjects
        Log::info('All subjects for exam detail ' . $this->exam_detail_id . ':');
        foreach ($allSubjects as $subject) {
            $subjectName = $subject->subject ? $subject->subject->name : 'N/A';
            $subjectTypeName = ($subject->subject && $subject->subject->subjectType) ? $subject->subject->subjectType->name : 'N/A';
            Log::info('Subject ID: ' . $subject->id . ', Name: ' . $subjectName . ', Type: ' . $subjectTypeName);
        }
            
        // Filter for formative subjects
        $this->formativeSubjects = $allSubjects->filter(function ($examClassSubject) {
            return $examClassSubject->subject && 
                   $examClassSubject->subject->subjectType && 
                   stripos($examClassSubject->subject->subjectType->name, 'Formative') !== false;
        });
            
        // Load grades for this exam type
        $this->grades = Exam08Grade::where('exam_type_id', $this->examDetail->exam_type_id)
            ->where('is_active', true)
            ->orderBy('order_index')
            ->get();
            
        // Debug: Log grades information
        Log::info('Loading grades for exam type ID: ' . $this->examDetail->exam_type_id);
        Log::info('Found grades: ' . $this->grades->count());
        foreach ($this->grades as $grade) {
            Log::info('Grade: ' . $grade->name . ' (ID: ' . $grade->id . ')');
        }
        
        // If no active grades found, try to get all grades regardless of active status
        if ($this->grades->count() == 0) {
            Log::warning('No active grades found, trying all grades for exam type: ' . $this->examDetail->exam_type_id);
            $this->grades = Exam08Grade::where('exam_type_id', $this->examDetail->exam_type_id)
                ->orderBy('order_index')
                ->get();
            Log::info('Found total grades (including inactive): ' . $this->grades->count());
        }
            
        // Check if marks are finalized
        if ($this->formativeSubjects->isNotEmpty()) {
            $this->isFinalized = $this->formativeSubjects->every('is_finalized');
        }
            
        // Load existing marks data
        $this->loadMarksData();
        
        // Debug logging
        Log::info('Formative Subjects Count: ' . $this->formativeSubjects->count());
        Log::info('Students Count: ' . count($this->students));
        Log::info('Grades Count: ' . $this->grades->count());
        
        // Additional debug logging for formative subjects
        foreach ($this->formativeSubjects as $subject) {
            Log::info('Formative Subject: ' . $subject->subject->name . ' (ID: ' . $subject->id . ') Type: ' . $subject->subject->subjectType->name);
        }
    }

    public function loadMarksData()
    {
        // Initialize marks data array
        $this->marksData = [];
        
        Log::info('Loading marks data for ' . count($this->students) . ' students and ' . $this->formativeSubjects->count() . ' subjects');
        
        foreach ($this->students as $student) {
            foreach ($this->formativeSubjects as $subject) {
                // Check if marks entry already exists
                $marksEntry = Exam10MarksEntry::where('exam_detail_id', $this->exam_detail_id)
                    ->where('exam_class_subject_id', $subject->id)
                    ->where('myclass_section_id', $this->myclass_section_id)
                    ->where('studentcr_id', $student->id)
                    ->first();
                    
                if ($marksEntry) {
                    $this->marksData[$student->id][$subject->id] = [
                        'marks_entry_id' => $marksEntry->id,
                        'grade_id' => $marksEntry->is_absent ? 'absent' : $marksEntry->grade_id,
                        'is_absent' => $marksEntry->is_absent ?? false,
                        'marks' => $marksEntry->exam_marks
                    ];
                    Log::info("Loaded marks for student {$student->id}, subject {$subject->id}: grade_id = " . ($marksEntry->is_absent ? 'absent' : $marksEntry->grade_id) . ", marks = " . $marksEntry->exam_marks);
                } else {
                    $this->marksData[$student->id][$subject->id] = [
                        'marks_entry_id' => null,
                        'grade_id' => null,
                        'is_absent' => false,
                        'marks' => null
                    ];
                    Log::info("No marks found for student {$student->id}, subject {$subject->id}");
                }
            }
        }
        
        // Debug log the loaded marks data
        Log::info('Marks Data Array: ' . json_encode($this->marksData));
        
        // Additional detailed debug for a specific student-subject combination
        if (!empty($this->students) && !empty($this->formativeSubjects)) {
            $firstStudent = $this->students[0];
            $firstSubject = $this->formativeSubjects[0];
            if (isset($this->marksData[$firstStudent->id][$firstSubject->id])) {
                Log::info("First student-subject data: " . json_encode($this->marksData[$firstStudent->id][$firstSubject->id]));
            }
        }
        
        Log::info('Finished loading marks data');
    }

    // Save marks for a specific student
    public function saveStudentMarks($studentId)
    {
        // Check if all marks for this student are filled
        $isComplete = true;
        foreach($this->formativeSubjects as $subject) {
            if (!isset($this->marksData[$studentId][$subject->id]) || empty($this->marksData[$studentId][$subject->id]['grade_id'])) {
                $isComplete = false;
                break;
            }
        }
        
        if ($this->isFinalized) {
            session()->flash('error', 'Cannot save marks. The marks entry is finalized.');
            return;
        }

        if (!$isComplete) {
            session()->flash('error', 'Please fill all marks for this student before saving.');
            return;
        }

        try {
            DB::beginTransaction();
            
            foreach ($this->formativeSubjects as $subject) {
                $data = $this->marksData[$studentId][$subject->id] ?? null;
                
                if (!$data) continue;
                
                // Get the grade
                $grade = null;
                $gradeId = $data['grade_id'] ?? null;
                if ($gradeId && $gradeId !== 'absent') {
                    $grade = Exam08Grade::find($gradeId);
                }
                
                // Calculate marks - use max_mark_percentage from grade
                $marks = null;
                if ($gradeId === 'absent') {
                    $marks = -99; // Absent marker
                } elseif ($grade) {
                    // Use max mark percentage for the grade
                    $marks = $grade->max_mark_percentage;
                }
                
                // Prepare data for saving
                $saveData = [
                    'exam_detail_id' => $this->exam_detail_id,
                    'exam_class_subject_id' => $subject->id,
                    'myclass_section_id' => $this->myclass_section_id,
                    'studentcr_id' => $studentId,
                    'exam_marks' => $marks,
                    'grade_id' => $gradeId !== 'absent' ? $gradeId : null,
                    'is_absent' => $gradeId === 'absent',
                    'session_id' => session('current_session_id', 1),
                    'school_id' => session('current_school_id', 1),
                    'user_id' => Auth::id(),
                ];
                
                // Save or update marks entry
                if ($data['marks_entry_id']) {
                    // Update existing
                    $marksEntry = Exam10MarksEntry::find($data['marks_entry_id']);
                    if ($marksEntry) {
                        $marksEntry->update($saveData);
                        Log::info("Updated marks entry ID {$data['marks_entry_id']} for student {$studentId}, subject {$subject->id}");
                    } else {
                        Log::warning("Marks entry ID {$data['marks_entry_id']} not found for student {$studentId}, subject {$subject->id}");
                    }
                } else {
                    // Create new
                    $marksEntry = Exam10MarksEntry::create($saveData);
                    // Update the marks entry ID in our data
                    $this->marksData[$studentId][$subject->id]['marks_entry_id'] = $marksEntry->id;
                    Log::info("Created new marks entry ID {$marksEntry->id} for student {$studentId}, subject {$subject->id}");
                }
                
                Log::info("Saved marks for student {$studentId}, subject {$subject->id}: grade_id = {$gradeId}, marks = {$marks}");
            }
            
            DB::commit();
            session()->flash('message', 'Marks saved successfully for student!');
            // Reload data to ensure UI is updated
            $this->refreshMarksData();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving marks: ' . $e->getMessage());
            session()->flash('error', 'Error saving marks: ' . $e->getMessage());
        }
    }

    public function updatedMarksData()
    {
        // This method is called when marksData is updated
        // We'll handle saving in the saveMarks method
        Log::info('MarksData updated: ' . json_encode($this->marksData));
    }

    public function saveMarks()
    {
        if ($this->isFinalized) {
            session()->flash('error', 'Cannot save marks. The marks entry is finalized.');
            return;
        }

        try {
            DB::beginTransaction();
            
            foreach ($this->students as $student) {
                foreach ($this->formativeSubjects as $subject) {
                    $data = $this->marksData[$student->id][$subject->id] ?? null;
                    
                    if (!$data) continue;
                    
                    // Get the grade
                    $grade = null;
                    $gradeId = $data['grade_id'] ?? null;
                    if ($gradeId && $gradeId !== 'absent') {
                        $grade = Exam08Grade::find($gradeId);
                    }
                    
                    // Calculate marks - use max_mark_percentage from grade
                    $marks = null;
                    if ($gradeId === 'absent') {
                        $marks = -99; // Absent marker
                    } elseif ($grade) {
                        // Use max mark percentage for the grade
                        $marks = $grade->max_mark_percentage;
                    }
                    
                    // Prepare data for saving
                    $saveData = [
                        'exam_detail_id' => $this->exam_detail_id,
                        'exam_class_subject_id' => $subject->id,
                        'myclass_section_id' => $this->myclass_section_id,
                        'studentcr_id' => $student->id,
                        'exam_marks' => $marks,
                        'grade_id' => $gradeId !== 'absent' ? $gradeId : null,
                        'is_absent' => $gradeId === 'absent',
                        'session_id' => session('current_session_id', 1),
                        'school_id' => session('current_school_id', 1),
                        'user_id' => Auth::id(),
                    ];
                    
                    // Save or update marks entry
                    if ($data['marks_entry_id']) {
                        // Update existing
                        $marksEntry = Exam10MarksEntry::find($data['marks_entry_id']);
                        if ($marksEntry) {
                            $marksEntry->update($saveData);
                            Log::info("Updated marks entry ID {$data['marks_entry_id']} for student {$student->id}, subject {$subject->id}");
                        } else {
                            Log::warning("Marks entry ID {$data['marks_entry_id']} not found for student {$student->id}, subject {$subject->id}");
                        }
                    } else {
                        // Create new
                        $marksEntry = Exam10MarksEntry::create($saveData);
                        // Update the marks entry ID in our data
                        $this->marksData[$student->id][$subject->id]['marks_entry_id'] = $marksEntry->id;
                        Log::info("Created new marks entry ID {$marksEntry->id} for student {$student->id}, subject {$subject->id}");
                    }
                    
                    Log::info("Saved marks for student {$student->id}, subject {$subject->id}: grade_id = {$gradeId}, marks = {$marks}");
                }
            }
            
            DB::commit();
            session()->flash('message', 'Marks saved successfully!');
            // Reload data to ensure UI is updated
            $this->refreshMarksData();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving marks: ' . $e->getMessage());
            session()->flash('error', 'Error saving marks: ' . $e->getMessage());
        }
    }

    public function finalizeMarks()
    {
        if ($this->isFinalized) {
            session()->flash('error', 'Marks are already finalized.');
            return;
        }

        try {
            DB::beginTransaction();
            
            // First save any unsaved marks
            $this->saveMarks();
            
            // Then finalize all formative exam class subjects
            foreach ($this->formativeSubjects as $subject) {
                $subject->update([
                    'is_finalized' => true,
                    'approved_by' => Auth::id()
                ]);
            }
            
            $this->isFinalized = true;
            
            DB::commit();
            session()->flash('message', 'Marks finalized successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error finalizing marks: ' . $e->getMessage());
            session()->flash('error', 'Error finalizing marks: ' . $e->getMessage());
        }
    }

    public function unfinalizeMarks()
    {
        if (!$this->isFinalized) {
            session()->flash('error', 'Marks are not finalized.');
            return;
        }

        try {
            DB::beginTransaction();
            
            // Unfinalize all formative exam class subjects
            foreach ($this->formativeSubjects as $subject) {
                $subject->update([
                    'is_finalized' => false,
                    'approved_by' => null
                ]);
            }
            
            $this->isFinalized = false;
            
            DB::commit();
            session()->flash('message', 'Marks unfinalized successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error unfinalizing marks: ' . $e->getMessage());
            session()->flash('error', 'Error unfinalizing marks: ' . $e->getMessage());
        }
    }

    public function render()
    {
        // Debug: Log when rendering
        Log::info('Rendering MarksEntryFormativeComp with grades count: ' . ($this->grades ? $this->grades->count() : 0));
        Log::info('Rendering MarksEntryFormativeComp with formative subjects count: ' . ($this->formativeSubjects ? $this->formativeSubjects->count() : 0));
        Log::info('Rendering MarksEntryFormativeComp with isFinalized: ' . ($this->isFinalized ? 'true' : 'false'));
        
        // Log a sample of marks data for debugging
        if (!empty($this->marksData)) {
            $sampleStudentId = array_key_first($this->marksData);
            $sampleSubjectId = array_key_first($this->marksData[$sampleStudentId]);
            Log::info('Sample marks data for student ' . $sampleStudentId . ', subject ' . $sampleSubjectId . ': ' . json_encode($this->marksData[$sampleStudentId][$sampleSubjectId]));
        }
        
        return view('livewire.marks-entry-formative-comp');
    }
}