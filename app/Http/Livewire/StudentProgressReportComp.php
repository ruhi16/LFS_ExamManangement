<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Myclass;
use App\Models\Section;
use App\Models\MyclassSection;
use App\Models\Studentcr;
use App\Models\Exam01Name;
use App\Models\Exam02Type;
use App\Models\Exam05Detail;
use App\Models\Exam06ClassSubject;
use App\Models\Exam10MarksEntry;
use Illuminate\Support\Collection;

class StudentProgressReportComp extends Component
{
    public $selectedClassId = '';
    public $selectedSectionId = '';
    public $selectedStudentId = '';
    public $classes = [];
    public $sections = [];
    public $students = [];
    public $progressData = [];
    
    public function mount()
    {
        $this->classes = Myclass::where('is_active', true)->orderBy('id')->get();
        if ($this->classes instanceof Collection && $this->classes->isNotEmpty()) {
            $this->selectedClassId = $this->classes->first()->id;
            $this->loadSections();
            $this->loadStudents();
        }
        $this->loadProgressData();
    }
    
    public function updatedSelectedClassId()
    {
        $this->selectedSectionId = '';
        $this->selectedStudentId = '';
        $this->loadSections();
        $this->loadStudents();
        $this->loadProgressData();
    }
    
    public function updatedSelectedSectionId()
    {
        $this->selectedStudentId = '';
        $this->loadStudents();
        $this->loadProgressData();
    }
    
    public function updatedSelectedStudentId()
    {
        $this->loadProgressData();
    }
    
    public function loadSections()
    {
        if ($this->selectedClassId) {
            $this->sections = MyclassSection::where('myclass_id', $this->selectedClassId)
                ->with('section')
                ->get()
                ->pluck('section', 'section.id');
        } else {
            $this->sections = collect();
        }
    }
    
    public function loadStudents()
    {
        $query = Studentcr::with(['studentdb', 'myclass', 'section'])
            // ->where('is_active', true)
            ;
            
        if ($this->selectedClassId) {
            $query->where('myclass_id', $this->selectedClassId);
        }
        
        if ($this->selectedSectionId) {
            $query->where('section_id', $this->selectedSectionId);
        }
        
        $this->students = $query->orderBy('roll_no')->get();
    }
    
    public function loadProgressData()
    {
        $this->progressData = [];
        
        if (!$this->selectedStudentId) {
            return;
        }
        
        // Get the student
        $student = Studentcr::find($this->selectedStudentId);
        if (!$student) {
            return;
        }
        
        // Get all exam names
        $examNames = Exam01Name::where('is_active', true)
            ->orderBy('id')
            ->get();
            
        // Get exam types (summative and formative)
        $examTypes = Exam02Type::where('is_active', true)
            ->orderBy('name')
            ->get();
            
        // Get all subjects for this class
        $subjects = Exam06ClassSubject::where('myclass_id', $this->selectedClassId)
            ->with('subject')
            ->get()
            ->pluck('subject')
            ->unique('id')
            ->values();
            
        // Organize data by exam name and type
        foreach ($examNames as $examName) {
            $examData = [
                'name' => $examName->name,
                'types' => []
            ];
            
            foreach ($examTypes as $examType) {
                // Get exam details for this exam name and type
                $examDetails = Exam05Detail::where('exam_name_id', $examName->id)
                    ->where('exam_type_id', $examType->id)
                    ->where('myclass_id', $this->selectedClassId)
                    ->where('is_active', true)
                    ->get();
                
                if ($examDetails->isEmpty()) {
                    continue;
                }
                
                $typeData = [
                    'name' => $examType->name,
                    'subjects' => []
                ];
                
                foreach ($subjects as $subject) {
                    // Get class subject mapping
                    $examClassSubject = Exam06ClassSubject::where('myclass_id', $this->selectedClassId)
                        ->where('subject_id', $subject->id)
                        ->first();
                    
                    if (!$examClassSubject) {
                        continue;
                    }
                    
                    $subjectData = [
                        'name' => $subject->name,
                        'full_marks' => $examClassSubject->full_marks,
                        'marks' => []
                    ];
                    
                    // Get marks for each exam detail
                    foreach ($examDetails as $examDetail) {
                        $marksEntry = Exam10MarksEntry::where('studentcr_id', $this->selectedStudentId)
                            ->where('exam_detail_id', $examDetail->id)
                            ->where('exam_class_subject_id', $examClassSubject->id)
                            ->first();
                        
                        $grade = null;
                        if ($marksEntry && $marksEntry->grade_id) {
                            $grade = \App\Models\Exam08Grade::find($marksEntry->grade_id);
                        }
                        
                        $subjectData['marks'][] = [
                            'exam_detail' => $examDetail,
                            'marks_entry' => $marksEntry,
                            'grade' => $grade,
                            'display_marks' => $marksEntry ? $marksEntry->getDisplayMarks() : 'N/A'
                        ];
                    }
                    
                    $typeData['subjects'][] = $subjectData;
                }
                
                if (!empty($typeData['subjects'])) {
                    $examData['types'][] = $typeData;
                }
            }
            
            if (!empty($examData['types'])) {
                $this->progressData[] = $examData;
            }
        }
    }
    
    public function render()
    {
        return view('livewire.student-progress-report-comp');
    }
}