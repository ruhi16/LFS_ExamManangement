<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MyclassSection;
use App\Models\Teacher;
use App\Models\Studentcr;
use App\Models\Exam06ClassSubject;
use App\Models\Exam05Detail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClassSectionTasksComp extends Component
{
    public $myclassSections = [];
    public $examDetails = []; // Store exam details separately
    public $selectedTeacherId = null;
    public $selectedMyclassSectionId = null;
    public $showTeacherModal = false;
    public $students = [];

    protected $listeners = ['refreshComponent' => '$refresh', 'teacherAssigned' => 'loadData'];

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->myclassSections = MyclassSection::with(['myclass', 'section', 'teacher'])->get();
        $this->examDetails = []; // Reset exam details array
        
        foreach ($this->myclassSections as $section) {
            $section->studentcrs_count = Studentcr::where('myclass_id', $section->myclass_id)
                ->where('section_id', $section->section_id)
                ->count();
            
            // Load exam detail information
            $examClassSubjects = Exam06ClassSubject::where('myclass_id', $section->myclass_id)->get();
            $this->examDetails[$section->id] = [];
            
            foreach ($examClassSubjects as $examClassSubject) {
                $examDetail = Exam05Detail::find($examClassSubject->exam_detail_id);
                if ($examDetail) {
                    $this->examDetails[$section->id][] = $examDetail;
                }
            }
        }
    }

    public function showTeacherModal($myclassSectionId)
    {
        $this->selectedMyclassSectionId = $myclassSectionId;
        $this->selectedTeacherId = MyclassSection::find($myclassSectionId)->teacher_id;
        $this->showTeacherModal = true;
    }

    public function assignTeacher()
    {
        if (!$this->selectedMyclassSectionId) {
            session()->flash('error', 'Invalid selection.');
            return;
        }

        try {
            $myclassSection = MyclassSection::findOrFail($this->selectedMyclassSectionId);
            $myclassSection->teacher_id = $this->selectedTeacherId;
            $myclassSection->save();

            $this->showTeacherModal = false;
            $this->selectedMyclassSectionId = null;
            $this->selectedTeacherId = null;

            $this->loadData();
            
            session()->flash('message', 'Teacher assigned successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Error assigning teacher: ' . $e->getMessage());
        }
    }

    public function viewStudents($myclassSectionId)
    {
        $myclassSection = MyclassSection::find($myclassSectionId);
        $this->students = Studentcr::with('studentdb', 'myclass', 'section')
            ->where('myclass_id', $myclassSection->myclass_id)
            ->where('section_id', $myclassSection->section_id)
            ->orderBy('roll_no')
            ->get();
            
        $this->dispatchBrowserEvent('show-students-modal');
    }

    public function render()
    {
        $availableTeachers = Teacher::where('is_active', true)
            ->orderBy('name')
            ->get();
            
        return view('livewire.class-section-tasks-comp', [
            'availableTeachers' => $availableTeachers
        ]);
    }
}