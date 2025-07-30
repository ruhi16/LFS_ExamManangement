<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SASideBarComponent extends Component
{

    public $saslotdata;
    public $count = 10;
    public $sbFlag = true;
    public $sbSubMenu = false;

    public $sidebar_array = array(
        array(
            'title' => 'Dashboard',
            'ref' => 'dashboard',
            'isSelected' => true
        ),
        array(
            'title' => 'Pages',
            'ref' => 'pages',
            'isSelected' => false
        ),

        array(
            'title' => 'Media',
            'ref' => 'media',
            'isSelected' => false,
            'spacing' => true
        ),

        array(
            'title' => 'Projects',
            'ref' => 'projects',
            'isSelected' => false,
            'submenu' => true,
            'submenuItems' => array(
                array(
                    'title' => 'SubMentu Item 1',
                    'isSelected' => false
                ),
                array(
                    'title' => 'SubMentu Item 2',
                    'isSelected' => false
                ),
                array(
                    'title' => 'SubMentu Item 3',
                    'isSelected' => false
                ),
            ),
        ),
        array(
            'title' => 'Analysis',
            'isSelected' => false,
            'ref' => 'analysis',
        ),
        array(
            'title' => 'Profile',
            'isSelected' => false,
            'spacing' => true,
            'ref' => 'profile',
        ),
        array(
            'title' => 'Setting',
            'isSelected' => false,
            'ref' => 'setting',
        ),
        array(
            'title' => 'Logout',
            'isSelected' => false,
            'ref' => 'logout',
        ),
    );




    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function sbSubMenuToggle(){

        $this->sbSubMenu = !$this->sbSubMenu;        
    }

    public function sbFlagToggle()
    {
        $this->sbFlag = !$this->sbFlag;
        // echo ($sbFlag);
    }

    public function render()
    {
        return view('livewire.s-a-side-bar-component');
    }
}
