<?php

namespace App\Http\Livewire;

use App\Models\Myclasssection;
use App\Models\Studentcr;
use App\Models\Studentdb;
use Livewire\Component;

class AdminAdmissionComponent extends Component
{
    public $myclssec_id;
    public $myclssec;
    public $studentdbs; 
    public $studentcrs;
    public $studentdbsNotInStudentcrs;


    public function mount($myclassSection_id){
        $this->myclssec_id = $myclassSection_id;        

        $this->myclssec = Myclasssection::where('id', $myclassSection_id)->first();
                
        $this->studentdbs = Studentdb::where('stclass_id', $this->myclssec->myclass_id)
            ->where('stsection_id', $this->myclssec->section_id)->get();

            $this->studentdbsNotInStudentcrs = Studentdb::where('stclass_id', $this->myclssec->myclass_id)
                ->where('stsection_id', $this->myclssec->section_id)
                ->whereNotIn('id', function ($query) {
                    $query->select('studentdb_id')
                      ->from('studentcrs');
            })->get();

        $this->updatedStudentcrs();
        $this->updatedStudentdbsNotInStudentcrs();
        // $this->studentcrs = Studentcr::where('myclass_id', $this->myclssec->myclass_id)
        //     ->where('section_id', $this->myclssec->section_id)->get();

    }

    public function updatedStudentdbsNotInStudentcrs(){
        $this->studentdbsNotInStudentcrs = Studentdb::where('stclass_id', $this->myclssec->myclass_id)
                ->where('stsection_id', $this->myclssec->section_id)
                ->whereNotIn('id', function ($query) {
                    $query->select('studentdb_id')
                      ->from('studentcrs');
            })->orderBy('remarks')->get();
    }

    public function updatedStudentcrs(){
        $this->studentcrs = Studentcr::where('myclass_id', $this->myclssec->myclass_id)
            ->where('section_id', $this->myclssec->section_id)
            ->orderBy('roll_no', 'asc')
            ->get();
    }


    
    public function assignRollNo($studentdb_id){
        // $this->message = [ $studentdb_id => 'Done ' . $studentdb_id];
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



        $this->updatedStudentcrs();
        $this->updatedStudentdbsNotInStudentcrs();

        // $this->studentdbs = Studentdb::where('stclass_id', $this->myclssec->myclass_id)
        //     ->where('stsection_id', $this->myclssec->section_id)->get();

        // $this->studentcrs = Studentcr::where('myclass_id', $this->myclssec->myclass_id)
        //     ->where('section_id', $this->myclssec->section_id)->get();
    }








    public function render()
    {
        return view('livewire.admin-admission-component');
    }
}
