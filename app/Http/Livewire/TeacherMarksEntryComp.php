<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Teacher;
use App\Models\Exam07AnsscrDist;
use App\Models\Exam06ClassSubject;
use App\Models\Exam10MarksEntry;
use App\Models\Studentcr;
use App\Models\MyclassSection;
use Illuminate\Support\Facades\Log;

class TeacherMarksEntryComp extends Component{

    public $teachers;
    public $distributions;
    public $distributionsByTeacher;
    public $subjectMap; // exam_class_subject_id => Exam06ClassSubject (with subject)
    public $marksProgress = []; // To store marks entry progress statistics

    public function mount(){

        // Load teachers
        $this->teachers = Teacher::orderBy('id')->get();

        // Load distributions with necessary relations
        $this->distributions = Exam07AnsscrDist::with([
            'examDetail.examName',
            'examDetail.examType',
            'examDetail.examMode',
            'myclassSection.section',
            'myclassSection.myclass',
            'examClassSubject.subject',
            'teacher',
        ])->whereHas('examClassSubject')->get(); // Only get distributions where examClassSubject exists

        // Build subject map for resolving subject names quickly
        $examClassSubjectIds = $this->distributions
            ->pluck('exam_class_subject_id')
            ->filter()
            ->unique();

        $this->subjectMap = Exam06ClassSubject::whereIn('id', $examClassSubjectIds)
            ->with('subject')
            ->get()
            ->keyBy('id');
            
        // Calculate marks entry progress for each distribution
        $this->calculateMarksProgress();
    }

    public function render()
    {
        return view('livewire.teacher-marks-entry-comp',[
            'distributions' => $this->distributions,
            'distByTeacher' => $this->distributionsByTeacher,
            'marksProgress' => $this->marksProgress,
        ]);
    }

    public function finalizeMarks($examClassSubjectId)
    {
        try {
            $examClassSubject = Exam06ClassSubject::find($examClassSubjectId);
            
            if (!$examClassSubject) {
                throw new \Exception('Exam class subject not found');
            }
            
            $examClassSubject->update(['is_finalized' => true]);
            
            // Refresh distributions to reflect the change
            $this->refreshDistributions();
            
            session()->flash('message', 'Marks have been finalized successfully. No further edits are allowed.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error finalizing marks: ' . $e->getMessage());
            session()->flash('error', 'Error finalizing marks: ' . $e->getMessage());
        }
    }

    public function unfinalizeMarks($examClassSubjectId)
    {
        try {
            $examClassSubject = Exam06ClassSubject::find($examClassSubjectId);
            
            if (!$examClassSubject) {
                throw new \Exception('Exam class subject not found');
            }
            
            $examClassSubject->update(['is_finalized' => false]);
            
            // Refresh distributions to reflect the change
            $this->refreshDistributions();
            
            session()->flash('message', 'Marks have been unfinalized successfully. You can now edit marks.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error unfinalizing marks: ' . $e->getMessage());
            session()->flash('error', 'Error unfinalizing marks: ' . $e->getMessage());
        }
    }

    private function refreshDistributions()
    {
        // Reload distributions with updated finalization status
        $this->distributions = Exam07AnsscrDist::with([
            'examDetail.examName',
            'examDetail.examType',
            'examDetail.examMode',
            'myclassSection.section',
            'myclassSection.myclass',
            'examClassSubject.subject',
            'teacher',
        ])->whereHas('examClassSubject')->get();
        
        // Recalculate marks progress
        $this->calculateMarksProgress();
    }
    
    private function calculateMarksProgress()
    {
        $this->marksProgress = [];
        
        foreach ($this->distributions as $distribution) {
            // Skip if required relations are missing
            if (!$distribution->examClassSubject || !$distribution->myclassSection) {
                continue;
            }
            
            $examClassSubjectId = $distribution->examClassSubject->id;
            $myclassSectionId = $distribution->myclassSection->id;
            $examDetailId = $distribution->exam_detail_id;
            
            // Get the class and section IDs from the myclassSection
            $myclassId = $distribution->myclassSection->myclass_id;
            $sectionId = $distribution->myclassSection->section_id;
            
            // Count total students in this class-section with active status
            $totalStudents = Studentcr::where('myclass_id', $myclassId)
                ->where('section_id', $sectionId)
                ->where('crstatus', 'active')
                ->count();
                
            // Count entered marks for this combination
            $enteredMarks = Exam10MarksEntry::where('exam_class_subject_id', $examClassSubjectId)
                ->where('myclass_section_id', $myclassSectionId)
                ->where('exam_detail_id', $examDetailId)
                ->where(function($query) {
                    $query->whereNotNull('exam_marks')
                          ->orWhere('is_absent', 1);
                })
                ->count();
                
            // Store progress data
            $this->marksProgress[$examClassSubjectId] = [
                'total' => $totalStudents,
                'entered' => $enteredMarks,
                'percentage' => $totalStudents > 0 ? round(($enteredMarks / $totalStudents) * 100, 1) : 0
            ];
        }
    }
}