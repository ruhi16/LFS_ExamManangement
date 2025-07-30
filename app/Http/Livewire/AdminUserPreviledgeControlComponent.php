<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\Teacher;
use App\Models\User;
use Livewire\Component;

class AdminUserPreviledgeControlComponent extends Component
{

    public $users;
    public $roles;
    public $userPreviledge = [];
    public $teacherProfile = [];
    public $teachers;

    public $userPreviledgeKey = null;
    public $userPreviledgeValue = null;

    public $user_id = null;
    public $teacher_id = null;

    


    public function mount(){

        $this->users = User::where('role_id', '!=' ,4)->get();
        $this->roles = Role::all();
        
        $this->getUnAttachedTeachers();
        
    }

    // public function updatedUserPreviledge($key, $value){
    //     $this->userPreviledgeKey = $key;
    //     $this->userPreviledgeValue = $value;
        
    // }

    public function updatedTeacherProfile($key, $value){
        $this->teacherProfile[$key] = $value;

        $this->userPreviledgeKey = $key;        // teacher_id
        $this->userPreviledgeValue = $value;    // user_id

        // $this->teacherProfile = array_filter($this->teacherProfile);

    }

    public function grantPreviledge($id){
        $this->user_id = $id;
        $user = User::find($id);

        // $user = User::find($this->userPreviledgeValue);
        $user->role_id = $this->roles->find(2)->id;  // teacher
        $user->teacher_id = $this->userPreviledgeKey;
        $user->save();

        $teacher = Teacher::find($this->userPreviledgeKey);
        $teacher->user_id = $this->userPreviledgeValue;
        $teacher->save();

        $this->getUnAttachedTeachers();
        
    }


    public function revokePreviledge($user_id, $teacher_id){
        
        // dd($user_id, $teacher_id);
        $this->user_id = $user_id;
        $this->teacher_id = $teacher_id;

        $user = User::find($this->user_id);
        
        $user->role_id = $this->roles->find(1)->id;  // student
        $user->teacher_id = 0;
        $user->save();

        $teacher = Teacher::find($this->teacher_id);
        $teacher->user_id = 0;
        $teacher->save();

        $this->getUnAttachedTeachers();
    }



    public function render()
    {
        return view('livewire.admin-user-previledge-control-component');
    }


    public function getUnAttachedTeachers(){

        $this->users = User::where('role_id', '!=' ,4)->get();

        $this->teachers = Teacher::whereNotIn('id', function ($query) {
            $query->select('teacher_id')->from('users');
        })->get();        
    }
}
