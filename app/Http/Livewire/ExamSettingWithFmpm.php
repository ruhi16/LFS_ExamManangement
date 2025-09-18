<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exam05Detail;
use App\Models\Exam06ClassSubject;
use App\Models\MyclassSubject;
use App\Models\Myclass;
use App\Models\Exam01Name;
use App\Models\Exam02Type;
use App\Models\Exam03Part;
use App\Models\Subject;
use App\Models\SubjectType;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ExamSettingWithFmpm extends Component
{
    public $selectedClassId;
    public $classes = [];
    public $examDetails = [];
    public $examNames = [];
    public $examTypes = [];
    public $subjects = [];
    public $subjectTypes = [];
    public $selectedSubjects = [];
    public $fullMarks = [];
    public $passMarks = [];
    public $timeAllotted = [];
    public $savedData = [];
    public $isFinalized = false;
    public $finalizeProgress = [];

    public function mount()
    {
        $this->classes = Myclass::where('is_active', true)
            ->when(Auth::check() && Auth::user()->school_id, function($query) {
                return $query->where('school_id', Auth::user()->school_id);
            })
            ->orderBy('order_index')
            ->get();
            
        $this->subjectTypes = SubjectType::where('is_active', true)
            ->when(Auth::check() && Auth::user()->school_id, function($query) {
                return $query->where('school_id', Auth::user()->school_id);
            })
            ->orderBy('order_index')
            ->get();
    }

    public function updatedSelectedClassId($value)
    {
        if ($value) {
            $this->loadExamDetails();
            $this->loadSubjects();
            $this->loadSavedData();
        } else {
            $this->resetData();
        }
    }

    /**
     * Load exam details for selected class
     */
    public function loadExamDetails()
    {
        $this->examDetails = Exam05Detail::with(['examName', 'examType', 'examPart', 'examMode'])
            ->where('myclass_id', $this->selectedClassId)
            ->where('is_active', true)
            ->orderBy('order_index')
            ->get();

        // Get unique exam names from the exam details
        $this->examNames = $this->examDetails->groupBy('exam_name_id')
            ->map(function ($group) {
                return $group->first()->examName;
            })->values();

        // Get unique exam types from the exam details  
        $this->examTypes = $this->examDetails->groupBy('exam_type_id')
            ->map(function ($group) {
                return $group->first()->examType;
            })->values();
    }

    public function loadSubjects()
    {
        $this->subjects = MyclassSubject::with(['subject.subjectType'])
            ->where('myclass_id', $this->selectedClassId)
            ->where('is_active', true)
            ->whereHas('subject') // Only load MyclassSubjects that have valid subjects
            ->get();
    }

    public function loadSavedData()
    {
        $savedRecords = Exam06ClassSubject::where('myclass_id', $this->selectedClassId)
            ->get()
            ->keyBy(function ($item) {
                return $item->exam_detail_id . '_' . $item->subject_id;
            });

        $this->savedData = $savedRecords->toArray();
        
        // Check if class is finalized (if any record has is_finalized = true)
        $this->isFinalized = $savedRecords->where('is_finalized', true)->isNotEmpty();
        
        // Load existing data into component properties
        foreach ($savedRecords as $key => $record) {
            $this->selectedSubjects[$key] = true;
            $this->fullMarks[$key] = $record->full_marks;
            $this->passMarks[$key] = $record->pass_marks;
            $this->timeAllotted[$key] = $record->time_in_minutes;
        }
    }

    public function resetData()
    {
        $this->examDetails = [];
        $this->examNames = [];
        $this->examTypes = [];
        $this->subjects = [];
        $this->selectedSubjects = [];
        $this->fullMarks = [];
        $this->passMarks = [];
        $this->timeAllotted = [];
        $this->savedData = [];
        $this->isFinalized = false;
        $this->finalizeProgress = [];
    }

    public function toggleSubject($examDetailId, $subjectId)
    {
        // Prevent changes if finalized
        if ($this->isFinalized) {
            session()->flash('error', 'Cannot modify data: Class exam settings are finalized.');
            return;
        }

        $key = $examDetailId . '_' . $subjectId;
        
        if (isset($this->selectedSubjects[$key]) && $this->selectedSubjects[$key]) {
            // If unchecking, save the data first
            $this->saveSubjectData($examDetailId, $subjectId);
            unset($this->selectedSubjects[$key]);
            unset($this->fullMarks[$key]);
            unset($this->passMarks[$key]);
            unset($this->timeAllotted[$key]);
        } else {
            // If checking, enable the inputs
            $this->selectedSubjects[$key] = true;
            
            // Load existing data if available
            if (isset($this->savedData[$key])) {
                $this->fullMarks[$key] = $this->savedData[$key]['full_marks'];
                $this->passMarks[$key] = $this->savedData[$key]['pass_marks'];
                $this->timeAllotted[$key] = $this->savedData[$key]['time_in_minutes'];
            }
        }
    }

    public function saveSubjectData($examDetailId, $subjectId)
    {
        $key = $examDetailId . '_' . $subjectId;
        
        if (!isset($this->selectedSubjects[$key]) || !$this->selectedSubjects[$key]) {
            // If subject is not selected, delete existing record
            Exam06ClassSubject::where('exam_detail_id', $examDetailId)
                ->where('myclass_id', $this->selectedClassId)
                ->where('subject_id', $subjectId)
                ->delete();
            return;
        }

        $examDetail = Exam05Detail::find($examDetailId);
        $subject = Subject::find($subjectId);
        
        if (!$examDetail || !$subject) {
            return;
        }

        $data = [
            'name' => $examDetail->examName->name . ' - ' . $subject->name,
            'description' => 'Auto-generated from exam setting',
            'exam_detail_id' => $examDetailId,
            'myclass_id' => $this->selectedClassId,
            'subject_id' => $subjectId,
            'full_marks' => $this->fullMarks[$key] ?? 0,
            'pass_marks' => $this->passMarks[$key] ?? 0,
            'time_in_minutes' => $this->timeAllotted[$key] ?? 0,
            'session_id' => $examDetail->session_id,
            'school_id' => $examDetail->school_id,
            'user_id' => Auth::check() ? Auth::id() : 1,
            'is_active' => true,
            'status' => 'active'
        ];

        Exam06ClassSubject::updateOrCreate(
            [
                'exam_detail_id' => $examDetailId,
                'myclass_id' => $this->selectedClassId,
                'subject_id' => $subjectId
            ],
            $data
        );

        $this->emit('saved', 'Subject settings saved successfully!');
    }

    public function updatedFullMarks($value, $key)
    {
        $this->autoSave($key);
    }

    public function updatedPassMarks($value, $key)
    {
        $this->autoSave($key);
    }

    public function updatedTimeAllotted($value, $key)
    {
        $this->autoSave($key);
    }

    private function autoSave($key)
    {
        if (isset($this->selectedSubjects[$key]) && $this->selectedSubjects[$key]) {
            $parts = explode('_', $key);
            if (count($parts) >= 2) {
                $examDetailId = $parts[0];
                $subjectId = $parts[1];
                $this->saveSubjectData($examDetailId, $subjectId);
            }
        }
    }

    public function getSubjectsByType($subjectTypeId)
    {
        return $this->subjects->filter(function ($myclassSubject) use ($subjectTypeId) {
            // Add null check to prevent "Trying to get property of non-object" error
            return $myclassSubject->subject && 
                   $myclassSubject->subject->subject_type_id == $subjectTypeId;
        });
    }

    /**
     * Get exam details filtered by subject type
     * For a SubjectType, only corresponding ExamType and its available ExamParts should be enabled
     */
    public function getExamDetailsBySubjectType($subjectTypeId)
    {
        // Get the subject type to find corresponding exam type
        $subjectType = SubjectType::find($subjectTypeId);
        if (!$subjectType) {
            return collect();
        }

        // Filter exam details where exam_type matches the subject_type name/id
        // Assuming SubjectType and ExamType have similar names or a mapping relationship
        return $this->examDetails->filter(function ($examDetail) use ($subjectType) {
            // You can customize this logic based on your business rules
            // For now, assuming exam_type name matches subject_type name
            return $examDetail->examType && 
                   (strtolower($examDetail->examType->name) === strtolower($subjectType->name) ||
                    $examDetail->exam_type_id == $subjectType->id);
        });
    }

    /**
     * Check if a subject type is enabled for a specific exam detail
     * ExamType ≡ SubjectType matching logic
     */
    public function isSubjectTypeEnabledForExam($subjectTypeId, $examDetail)
    {
        $subjectType = SubjectType::find($subjectTypeId);
        if (!$subjectType || !$examDetail->examType) {
            return false;
        }

        // Match ExamType with SubjectType by name
        $subjectTypeName = strtolower(trim($subjectType->name));
        $examTypeName = strtolower(trim($examDetail->examType->name));
        
        // Enable only when ExamType matches SubjectType exactly
        return $subjectTypeName === $examTypeName;
    }

    /**
     * Check if all required data is entered for finalization
     */
    public function canFinalize()
    {
        if ($this->isFinalized) {
            return false;
        }

        $hasAnyData = false;
        $allDataComplete = true;

        foreach ($this->selectedSubjects as $key => $isSelected) {
            if ($isSelected) {
                $hasAnyData = true;
                
                // Check if all required fields are filled
                if (empty($this->fullMarks[$key]) || 
                    empty($this->passMarks[$key]) || 
                    empty($this->timeAllotted[$key])) {
                    $allDataComplete = false;
                    break;
                }
            }
        }

        return $hasAnyData && $allDataComplete;
    }

    /**
     * Finalize the exam settings for the class
     */
    public function finalizeClass()
    {
        if (!$this->canFinalize()) {
            session()->flash('error', 'Cannot finalize: Please ensure all selected subjects have complete data (Full Marks, Pass Marks, and Time).');
            return;
        }

        try {
            // Update all Exam06ClassSubject records for this class to finalized
            Exam06ClassSubject::where('myclass_id', $this->selectedClassId)
                ->update([
                    'is_finalized' => true,
                    'updated_at' => now()
                ]);

            $this->isFinalized = true;
            
            session()->flash('success', 'Class exam settings have been finalized successfully! Data entry is now locked.');
            $this->emit('saved', 'Class finalized successfully!');
        } catch (\Exception $e) {
            Log::error('Error finalizing class: ' . $e->getMessage());
            session()->flash('error', 'Error finalizing class: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.exam-setting-with-fmpm');
    }
}