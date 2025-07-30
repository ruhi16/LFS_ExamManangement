<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exam;
use App\Models\Myclass;
use App\Models\Myclasssection;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\Myclassteacher;


class AdminMyclassAnserScriptDistributionBaseComponent extends Component
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

    public function render()
    {
        return view('livewire.admin-myclass-anser-script-distribution-base-component');
    }
}
