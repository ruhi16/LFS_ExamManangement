<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Home extends Component{

    public $activeMenu = 'dashboard';
    public $openSubmenus = [];

    protected $listeners = ['menuChanged' => 'setActiveMenu'];

    public function mount(){
        // Initialize with dashboard menu open if it has submenus
        $this->openSubmenus = [];
    }

    public function toggleSubmenu($menu){
        if (in_array($menu, $this->openSubmenus)) {
            $this->openSubmenus = array_diff($this->openSubmenus, [$menu]);
        } else {
            $this->openSubmenus[] = $menu;
        }
    }

    public function setActiveMenu($menu, $submenu = null){
        $this->activeMenu = $submenu ?? $menu;
        
        // Keep parent menu open when submenu is selected
        if ($submenu && !in_array($menu, $this->openSubmenus)) {
            $this->openSubmenus[] = $menu;
        }
    }


    public function render(){
        return view('livewire.home',[
            'examNames' => \App\Models\Exam01Name::all(),
            'examTypes' => \App\Models\Exam02Type::all(),
            'examParts' => \App\Models\Exam03Part::all(),
            'examModes' => \App\Models\Exam04Mode::all(),
        ]);
    }
}
