<?php

namespace App\Http\Livewire;

use App\Models\Exam;
use App\Models\Myclass;
use App\Models\Myclasssection;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\Myclassteacher;
use Livewire\Component;

class AdminMyclassSectionComponent extends Component
{
    public $myclasses;
    public $sections;
    public $myclassSections;
    public $teachers;
    public $myclassteachers;
    public $exams;

    public $showModal = false;
    public $myclassSection_id;

    public $myclass_id;
    public $section_id;

    public $selectedClass = null;
    public $selectedSecton = null;
    public $selectedTeacher = null;

    public function resetToNull()
    {
        $this->selectedSecton = null;
        $this->selectedClass = null;
        $this->selectedTeacher = null;
    }

    public function mount()
    {
        $this->myclassSections = Myclasssection::all();
        $this->myclassteachers = Myclassteacher::all();
        $this->myclasses = Myclass::all();
        $this->sections = Section::all();
        $this->teachers = Teacher::all();
        $this->exams = Exam::all();
    }

    public function showModal($myclassSection_id)
    {
        $this->showModal = true;
        $this->resetToNull();
        $this->myclassSection_id = $myclassSection_id;
        $myclsSec = Myclasssection::find($myclassSection_id);
        $this->myclass_id = $this->selectedClass = $myclsSec->myclass_id;
        $this->section_id = $this->selectedSecton = $myclsSec->section_id;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function saveChanges()
    {
        $this->showModal = false;

        // $this->resetToNull();
       

        $this->validate([
            'selectedClass' => 'required',
            'selectedSecton' => 'required',
            'selectedTeacher' => 'required',
        ]);

        // Myclassteacher::create([
        //     'myclass_id' => $this->selectedClass,
        //     'section_id' => $this->selectedSecton,
        //     'teacher_id' => $this->selectedTeacher,
        //     'subject_id' => null,
        //     'session_id'   => 1,
        //     'school_id'   => 1,
        // ]);
        try {
            $newMyclassTeacher = Myclassteacher::firstOrCreate([
                'myclass_id' => $this->selectedClass,
                'section_id' => $this->selectedSecton,
            ]);
            $newMyclassTeacher->myclass_id = $this->selectedClass;
            $newMyclassTeacher->section_id = $this->selectedSecton;
            $newMyclassTeacher->teacher_id = $this->selectedTeacher;
            $newMyclassTeacher->subject_id = null;
            $newMyclassTeacher->session_id = 1;
            $newMyclassTeacher->school_id = 1;
            $newMyclassTeacher->save();

            $this->resetToNull();
            $this->myclassteachers = Myclassteacher::all();
            session()->flash('message', 'Form submitted successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Error saving data: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin-myclass-section-component');
    }
}
