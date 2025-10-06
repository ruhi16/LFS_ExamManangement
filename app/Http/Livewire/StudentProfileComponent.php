<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Studentdb;
use App\Models\Studentcr;
use App\Models\Session;
use Illuminate\Support\Facades\Auth;

class StudentProfileComponent extends Component
{
    public $studentdb;
    public $studentcr;
    public $activeTab = 'basic';
    public $activeSection = 'profile';
    
    public function mount()
    {
        $user = Auth::user();
        
        if ($user && $user->studentdb_id) {
            // Load studentdb with relationships, handling potential issues
            $this->studentdb = Studentdb::with([
                'studentcrs.myclass', 
                'studentcrs.section', 
                'studentcrs.session'
            ])->find($user->studentdb_id);
            
            if ($this->studentdb) {
                // Get the most recent studentcr record
                $this->studentcr = Studentcr::with(['myclass', 'section', 'session'])
                    ->where('studentdb_id', $this->studentdb->id)
                    ->latest('created_at')
                    ->first();
            }
        }
    }
    
    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }
    
    public function setActiveSection($section)
    {
        $this->activeSection = $section;
    }
    
    public function render()
    {
        return view('livewire.student-profile-component');
    }
}