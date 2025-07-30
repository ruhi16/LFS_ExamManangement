<?php

namespace App\Http\Livewire;

use App\Models\Myclass;
use App\Models\Section;
use App\Models\Myclasssection;
use App\Models\Studentcr;
use App\Models\Studentdb;
use App\Models\Teacher;
use Livewire\Component;


class AdminStudentdbComponent extends Component
{
    public $showModal = false;
    public $studentdbs;
    public $myclasses;
    public $sections;
    public $teachers;

    public $myclasssections = null;
    public $selectedClass = null;
    public $selectedSection = null;
    public $studentsNotInStudentDbs = null;

    public $message;


    public function showModal(){
        $this->showModal = ! $this->showModal;
    }
    

    public function mount()
    {
        $this->studentdbs = Studentdb::all();
        $this->studentsNotInStudentDbs = Studentcr::whereNotIn('studentdb_id', function ($query) {
            $query->select('studentdb_id')
                  ->from('studentcrs');
        })->get();


        $this->myclasses = Myclass::all();
        $this->sections = Section::all();
        // $this->teachers = Teacher::all();
    }

    public function updatedSelectedClass($clss_id)
    {
        $this->myclasssections = Myclasssection::where('myclass_id', $clss_id)
            ->get();

        if($this->selectedSection == null){
            $this->studentdbs = Studentdb::where('stclass_id', $this->selectedClass)        
                ->get();
        }else{
            $this->studentdbs = Studentdb::where('stclass_id', $this->selectedClass)        
                ->where('stsection_id', $this->selectedSection)    
                ->get();
        }
        
        // dd($this->sections);
    }

    public function updatedSelectedSection($section_id)
    {
        if($this->selectedClass == null){
            $this->studentdbs = Studentdb::where('stsection_id', $section_id)
                ->get();
        }else{
            $this->studentdbs = Studentdb::where('stclass_id', $this->selectedClass)
                ->where('stsection_id', $section_id)
                ->get();
        }
    }



    public function assignRollNo($studentdb_id){
        $this->message = [ $studentdb_id => 'Done ' . $studentdb_id];
        // echo($message);
        $studentdb = Studentdb::where('id', $studentdb_id)->firstOrFail();
        $studentcr = new Studentcr();

        $studentcr->studentdb_id = $studentdb->id;
        $studentcr->session_id = $studentdb->session_id;
        $studentcr->myclass_id = $studentdb->stclass_id;
        $studentcr->section_id = $studentdb->stsection_id;
        $studentcr->roll_no = (int) $studentdb->remarks;
        $studentcr->crstatus = 'Pending';
        $studentcr->save();


    }





    public function render()
    {        
        return view('livewire.admin-studentdb-component');
    }

}
