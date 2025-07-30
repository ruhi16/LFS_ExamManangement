<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserAccountComponent extends Component
{
    public $user = null;
    public function requestToBeTeacher(){
        
        $this->user = Auth::user();

        $user = User::find($this->user->id);
        $user->is_requested = true;
        $user->save();

    }


    public function render()
    {
        return view('livewire.user-account-component');
    }
}
