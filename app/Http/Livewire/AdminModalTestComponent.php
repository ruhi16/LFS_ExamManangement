<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdminModalTestComponent extends Component
{
    public $showModal = false;

    public function showModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function saveChanges()
    {
        // Your logic to save changes here
        $this->closeModal();
    }

    

    public function render()
    {
        return view('livewire.admin-modal-test-component');
    }
}
