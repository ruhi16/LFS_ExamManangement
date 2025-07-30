<?php

namespace App\Http\Livewire;

use App\Models\Answerscriptdistribution;
use App\Models\Exam;
use App\Models\Examdetails;
use App\Models\Exammode;
use App\Models\Examtype;
use App\Models\Myclass;
use App\Models\Myclasssection;
use App\Models\Myclasssubject;
use App\Models\Teacher;
use Livewire\Component;

class AdminAnsscrDistributioncwComponent extends Component
{
    // ids from ui's click event
    public $exam_id;
    public $myclass_id;
    public $section_id;
    public $subject_id;
    public $examtype_id;
    public $exammode_id;

    // ui bindings
    public $selectedTeacher = null;

    // models
    public $myclass;
    public $myclasssections;
    public $myclasssubjects;
    public $exam;
    public $examtypes;
    public $exammodes;
    public $teachers;
    public $examdetails;
    public $answerscriptdistributions;

    // flag to show modal
    public $showModal = false;

    public function resetToNull()
    {
        $this->selectedTeacher = null;
        $this->examdetails = Examdetails::where('myclass_id', $this->myclass_id)
            ->where('exam_id', $this->exam_id)
            ->orderBy('subject_id')
            ->get();
    }

    public function mount($myclass_id, $exam_id)
    {
        // dd('CLS:', $myclass_id, 'EXM:', $exam_id);

        $this->resetToNull();

        $this->myclass_id = $myclass_id;
        $this->exam_id = $exam_id;

        $this->myclass = Myclass::where('id', $myclass_id)->get();
        $this->myclasssections = Myclasssection::where(
            'myclass_id',
            $myclass_id
        )->get();
        $this->myclasssubjects = Myclasssubject::where(
            'myclass_id',
            $myclass_id
        )
            ->orderBy('examtype_id', 'asc')
            ->get();

        $this->exam = Exam::where('id', $exam_id)->first();
        $this->examtypes = Examtype::all();
        $this->exammodes = Exammode::all();
        $this->teachers = Teacher::all();

        $this->examdetails = Examdetails::where('myclass_id', $myclass_id)
            ->where('exam_id', $exam_id)
            ->orderBy('subject_id')
            ->get();

        $this->answerscriptdistributions = Answerscriptdistribution::where(
            'myclass_id',
            $myclass_id
        )
            ->where('exam_id', $exam_id)
            ->get();
    }

    public function updateSelectedTeacher($teacher_id)
    {
        session()->flash('message', 'Data changed successfully!');
        $this->answerscriptdistributions = Answerscriptdistribution::where(
            'myclass_id',
            $this->myclass_id
        )
            ->where('exam_id', $this->exam_id)
            ->get();
    }

    public function showModal($section_id, $subject_id, $examtype_id, $exammode_id)
    {
        $this->resetToNull();
        $this->showModal = true;

        $this->section_id = $section_id;
        $this->subject_id = $subject_id;
        $this->examtype_id = $examtype_id;
        $this->exammode_id = $exammode_id;
    }

    public function closeModal()
    {
        $this->resetToNull();

        $this->showModal = false;
    }

    public function saveChanges()
    {
        $this->validate([
            'selectedTeacher' => 'required',
        ]);

        $this->examdetails = $this->examdetails
                ->where('subject_id', $this->subject_id);
        // dd($this->examdetails);
        // dd(
        //     'DET:',
        //     $this->examdetails,
        //     'SEC:',
        //     $this->section_id,
        //     'SUB:',
        //     $this->subject_id,
        //     'EXM:',
        //     $this->exam_id,
        //     'EXT:',
        //     $this->examtype_id,
        //     'TCH:',
        //     $this->selectedTeacher
        // );

        // $examdetails_id

        // dd($this->examdetails);
        $exdetail = Examdetails::where('exam_id', $this->exam_id)            
            ->where('myclass_id', $this->myclass_id)
            ->where('examtype_id', $this->examtype_id)
            ->where('exammode_id', $this->exammode_id)
            ->where('subject_id', $this->subject_id)
            ->first();
            
        

        try {
            $answerscriptdistribution = Answerscriptdistribution::firstOrCreate(
                [
                    'school_id' => 1,
                    'session_id' => 1,
                    'examdetail_id' => $exdetail->id,
                    'exam_id' => $this->exam_id,
                    'examtype_id' => $this->examtype_id,
                    'exammode_id' => $this->exammode_id,
                    'myclass_id' => $this->myclass_id,
                    'section_id' => $this->section_id,
                    'subject_id' => $this->subject_id,
                ]
            );

            $answerscriptdistribution->teacher_id = $this->selectedTeacher;
            $answerscriptdistribution->save();

            $this->answerscriptdistributions = Answerscriptdistribution::where(
                'myclass_id',
                $this->myclass_id
            )
                ->where('exam_id', $this->exam_id)
                ->get();

            $this->resetToNull();
            // $this->myclassteachers = Myclassteacher::all();
            session()->flash('message', 'Form submitted successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Error saving data: ' . $e->getMessage());
        }

        $this->resetToNull();
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.admin-ansscr-distributioncw-component');
    }
}
