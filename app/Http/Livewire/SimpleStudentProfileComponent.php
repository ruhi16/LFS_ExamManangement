<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Studentdb;
use App\Models\Studentcr;
use Illuminate\Support\Facades\Auth;

class SimpleStudentProfileComponent extends Component
{
    public $studentdb;
    public $studentcr;
    
    public function mount()
    {
        $user = Auth::user();
        
        if ($user && $user->studentdb_id) {
            $this->studentdb = Studentdb::find($user->studentdb_id);
            
            if ($this->studentdb) {
                $this->studentcr = Studentcr::where('studentdb_id', $this->studentdb->id)
                    ->latest('created_at')
                    ->first();
            }
        }
    }
    
    public function render()
    {
        return view('livewire.simple-student-profile-component');
    }
}