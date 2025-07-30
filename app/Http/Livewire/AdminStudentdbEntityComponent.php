<?php

namespace App\Http\Livewire;

use App\Models\Studentdb;
use Livewire\Component;

class AdminStudentdbEntityComponent extends Component
{
    public $studentdb;
    public function mount($studentdb_id ){
        // $this->studentdb = $studentdb;  
        $this->studentdb = Studentdb::where('id', $studentdb_id)->firstOrFail();

    }

    public function render()
    {
        return view('livewire.admin-studentdb-entity-component');
    }
}


