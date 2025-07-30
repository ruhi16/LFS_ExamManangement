<?php

namespace App\Http\Livewire;

use App\Models\Examdetails;
use App\Models\Examtype;
use App\Models\Myclasssection;
use App\Models\Myclasssubject;
use App\Models\Myclass;
use App\Models\Section;
use App\Models\Subject; 

use Livewire\Component;

class ExamDetailComponent extends Component{
    public $examdetails;
    public $examtypes;
    public $myclasssections;
    public $myclasssubjects;
    public $myclasses;
    public $sections;
    public $subjects;

    public function __construct(){
        $this->examdetails = Examdetails::all();
        $this->examtypes = Examtype::all();
        $this->myclasssections = Myclasssection::all();
        $this->myclasssubjects = Myclasssubject::all();
        $this->myclasses = Myclass::all();
        $this->sections = Section::all();
        $this->subjects = Subject::all();
    }




    public function render(){
        return view('livewire.exam-detail-component');
    }
}
