<?php

namespace App\Http\Livewire;

use App\Models\Myclass;
use App\Models\Myclasssection;
use App\Models\Studentvl;
use Exception;
use Livewire\Component;

class AdminVoterListComponent extends Component{
    
    public $showModal = false;
    public $voters;
    public $voters_all;

    public $studentvl;

    public $selectedStudent_id;

    public $selectedMyclass = null;
    public $selectedSection = null;
    public $selectedRollno = null;

    public $myclasses = null;
    public $myclasssections = null;
    public $rollnos = null;

    public $myclssecStudents = null;
    public $mysibling = null;


    public $class_id;
    public $section_id;

    public function mount(  $class_id = null, $section_id = null){
        $this->class_id = $class_id;
        $this->section_id = $section_id;

        // dd($this->class_id, $this->section_id);
        if($this->class_id != null ){
            $this->voters_all = Studentvl::whereColumn('brother_id','!=', 'id') 
            ->where('myclass_id', $this->class_id)
            // ->where('section_id', $this->section_id)
            ->with('myclass')
            ->with('section')           
            ->orderBy('id', 'asc')  
            ->get();

            $this->voters = Studentvl::whereColumn('brother_id','=', 'id')
            ->where('myclass_id', $this->class_id)
            // ->where('section_id', $this->section_id)
            ->with('myclass')
            ->with('section')                       
            ->orderBy('id', 'asc')  
            ->get();    
        }else{
            $this->voters_all = Studentvl::whereColumn('brother_id','!=', 'id') 
            // ->where('myclass_id', $this->class_id)
            // ->where('section_id', $this->section_id)
            ->with('myclass')
            ->with('section')           
            ->orderBy('id', 'asc')  
            ->get();

        $this->voters = Studentvl::whereColumn('brother_id','=', 'id')
            // ->where('myclass_id', $this->class_id)
            // ->where('section_id', $this->section_id)
            ->with('myclass')
            ->with('section')                       
            ->orderBy('id', 'asc')  
            ->get();
        }
        

        // dd($this->voters_all);

        $this->myclasses = Myclass::all();
        $this->closeModal();
    }

    public function initialization(){        
        
        $this->studentvl = null;
        $this->selectedStudent_id = null;
    
        $this->selectedMyclass = null;
        $this->selectedSection = null;
        $this->selectedRollno = null;
    
        // $this->myclasses = null;
        $this->myclasssections = null;
        $this->rollnos = null;
    
        $this->myclssecStudents = null;
        $this->mysibling = null;
    }


    public function openModal($studentvl_id){
        $this->initialization();

        $this->selectedStudent_id = $studentvl_id;

        $this->studentvl = Studentvl::where('id', $studentvl_id)
            ->with('myclass')
            ->with('section')
            ->firstOrFail();

        $this->showModal = true;    
    }


    public function updatedSelectedMyclass($selectedMyclass){
        $this->selectedMyclass = $selectedMyclass;

        $this->myclasssections = Myclasssection::where('myclass_id', $this->selectedMyclass)
            ->get();        
    }



    public function updatedSelectedSection($selectedSection){
        $this->selectedSection = $selectedSection;

        $this->myclssecStudents = Studentvl::whereColumn('brother_id','=', 'id')
            ->where('id', '!=', $this->selectedStudent_id)
            ->where('myclass_id', $this->selectedMyclass)
            ->where('section_id', $this->selectedSection)            
            ->get();           
        
    }


    public function updatedSelectedRollno($selectedRollno){
        $this->selectedRollno = $selectedRollno;

        $this->mysibling = Studentvl::where('myclass_id', $this->selectedMyclass)
            ->where('section_id', $this->selectedSection)
            ->where('roll_no', $selectedRollno)
            ->first();

        // dd($this->mysibling);
        // dd($this->selectedMyclass, $this->selectedSection, $this->selectedRollno);
    }
    

    public function saveChanges(){

        try{
            $this->mysibling->update([
                'brother_id'   => $this->selectedStudent_id
            ]);
        }catch(Exception $e){
            dd($e);
        }

        $this->initialization();
        $this->mount();        
    }




    public function closeModal(){
        $this->showModal = false;
    }

    public function removeBrotherhood($voter_id){
        try{
            Studentvl::where('id', $voter_id)->update([
                'brother_id'   => $voter_id
            ]);
        }catch(Exception $e){
            dd($e);
        }
        

        $this->initialization();
        $this->mount();
    }


    public function render()
    {
        return view('livewire.admin-voter-list-component');
    }
}
