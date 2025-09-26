<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Studentdb;
use App\Models\Studentcr;
use App\Models\Session;
use Illuminate\Support\Facades\Auth;

class DebugStudentProfileComponent extends Component
{
    public $studentdb;
    public $studentcr;
    public $activeTab = 'basic';
    public $activeSection = 'profile';
    public $debugInfo = [];
    
    public function mount()
    {
        $user = Auth::user();
        
        // Debug information
        $this->debugInfo['user'] = $user ? json_decode(json_encode($user), true) : null;
        $this->debugInfo['user_id'] = $user ? $user->id : null;
        $this->debugInfo['studentdb_id'] = $user ? $user->studentdb_id : null;
        
        if ($user && $user->studentdb_id) {
            $this->studentdb = Studentdb::with(['myclass', 'sections', 'studentcrs.myclass', 'studentcrs.section', 'studentcrs.session'])->find($user->studentdb_id);
            
            $this->debugInfo['studentdb_found'] = $this->studentdb ? 'Yes' : 'No';
            $this->debugInfo['studentdb'] = $this->studentdb ? json_decode(json_encode($this->studentdb), true) : null;
            
            if ($this->studentdb) {
                $this->studentcr = Studentcr::with(['myclass', 'section', 'session'])
                    ->where('studentdb_id', $this->studentdb->id)
                    ->latest('created_at')
                    ->first();
                
                $this->debugInfo['studentcr_found'] = $this->studentcr ? 'Yes' : 'No';
                $this->debugInfo['studentcr'] = $this->studentcr ? json_decode(json_encode($this->studentcr), true) : null;
            }
        } else {
            $this->debugInfo['issue'] = 'No studentdb_id found for user';
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
        return view('livewire.debug-student-profile-component');
    }
}