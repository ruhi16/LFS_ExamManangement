<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminSidebarEntityComponent extends Component{

    public $route;
    public $option;
    public $isActive = false;
    
    public $selectedMenuItem = null;


    public function mount($route, $option, $isActive = false){
        $this->route = $route;
        $this->option = $option;        
        $this->isActive = $isActive;
    }

    public function setActiveOption($option){
        $this->isActive = true;
        // $this->activeOption = $option;
        // $this->componentName = $this->sidebarOptions[$this->activeOption];
    }
    
    public function setPage($route){
        $this->selectedMenuItem = $route;
    }


    public function render(){
        return view('livewire.admin-sidebar-entity-component');
    }
}
