<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Teacher;
use App\Models\Exam07AnsscrDist;
use App\Models\Exam06ClassSubject;

class TeacherMarksEntryComp extends Component
{
    public $teachers;
    public $distributions;
    public $distributionsByTeacher;
    public $subjectMap; // exam_class_subject_id => Exam06ClassSubject (with subject)

    public function mount()
    {
        // Load teachers
        $this->teachers = Teacher::orderBy('name')->get();

        // Load distributions with necessary relations
        $this->distributions = Exam07AnsscrDist::with([
            'examDetail.examName',
            'myclassSection.section',
            'myclassSection.myclass',
            'teacher',
        ])->get();

        // Group by teacher for quick access in the view
        $this->distributionsByTeacher = $this->distributions->groupBy('teacher_id');

        // Build subject map for resolving subject names quickly
        $examClassSubjectIds = $this->distributions
            ->pluck('exam_class_subject_id')
            ->filter()
            ->unique();

        $this->subjectMap = Exam06ClassSubject::whereIn('id', $examClassSubjectIds)
            ->with('subject')
            ->get()
            ->keyBy('id');
    }

    public function render()
    {
        return view('livewire.teacher-marks-entry-comp', [
            'teachers' => $this->teachers,
            'distByTeacher' => $this->distributionsByTeacher,
            'subjectMap' => $this->subjectMap,
        ]);
    }
}
