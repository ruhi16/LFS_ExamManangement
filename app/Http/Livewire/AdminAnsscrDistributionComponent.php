<?php

namespace App\Http\Livewire;

use App\Models\Answerscriptdistribution;
use App\Models\Exam;
use App\Models\Examtype;
use App\Models\Myclasssection;
use App\Models\Myclasssubject;
use Livewire\Component;

class AdminAnsscrDistributionComponent extends Component
{
    public $myclssec_id;
    public $myclssec;
    public $exams;
    public $examtypes;
    public $myclasssubjects;
    public $answerscriptdistributions;

    public function mount($myclassSection_id)
    {
        $this->myclssec_id = $myclassSection_id;

        $this->myclssec = Myclasssection::where(
            'id',
            $myclassSection_id
        )->first();

        $this->exams = Exam::all();
        $this->examtypes = Examtype::all();
        $this->myclasssubjects = Myclasssubject::where('myclass_id', $this->myclssec->myclass_id)
            ->orderBy('examtype_id', 'asc')->get();

        $this->answerscriptdistributions = Answerscriptdistribution::where('myclass_id', $this->myclssec->myclass_id)
            ->where('section_id', $this->myclssec->section_id)
            ->get();


    }

    public function render()
    {
        return view('livewire.admin-ansscr-distribution-component');
    }
}
