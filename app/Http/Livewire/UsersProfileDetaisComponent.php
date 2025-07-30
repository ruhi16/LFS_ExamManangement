<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UsersProfileDetaisComponent extends Component
{

    public $name;
    public $nickName;
    public $email;
    public $mobile;
    public $address;
    public $designaation;
    public $subject;
    public $status;
    public $prof_image_reference;


    public function mount(){
        $user = auth()->user();
        $this->name = $user->teacher->name;
        $this->nickName = $user->teacher->nickName;
        $this->email = $user->teacher->email;
        $this->mobile = $user->teacher->mobno;
        // $this->address = $user->teacher->address;
        $this->designaation = $user->teacher->desig;
        $this->subject = $user->teacher->subject->name ?? 'Not Connected'; 
        $this->status = $user->teacher->status;
        $this->prof_image_reference = $user->teacher->img_ref;
    }



    public function render()
    {
        return view('livewire.users-profile-detais-component');
    }
}
