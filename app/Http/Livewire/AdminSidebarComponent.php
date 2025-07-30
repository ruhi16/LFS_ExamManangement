<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminSidebarComponent extends Component
{
    public $isSidebarOpen = true;
    public $isActiveLink = true;

    public $sidebarOptions = [
        'profile' => 'Profile',
        'answerscriptdistribution' => 'Ans Scr Distribution',
        'contact' => 'Contact',
    ];

    
    public $activeOption = null;
    // public $componentName = null;
    // public $selectedMenuItem = null;

    public function mount(){
        $this->activeOption = 'profile';
        
    }


    public function setActiveOption($option){
        // dd('clicked', $option);
        // $this->isActiveLink = true;
        $this->activeOption = $option;
    }



    public function render()
    {
        return view('livewire.admin-sidebar-component', [
            'content' => $this->sidebarOptions[$this->activeOption]
        ]);
    }
}
