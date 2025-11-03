<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Studentcr;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AdminStudentIdCardComp extends Component
{
    public $message;
    public function getIdcard($uuid){
        $this->message = 'IdCard generated successfully';

        $studentcr = Studentcr::find($uuid);

        $qrcode_str = 'https://www.google.com';
        $qrcode = QrCode::size(80)->generate($qrcode_str);
        $qrcode_path = storage_path('app/public/'.time().'.svg');
        $qrcode = QrCode::format('svg')->size(300)->generate('Hello, world!', $qrcode_path);

        return view('livewire.admin-student-id-card-comp', [
            'qrcode' => $qrcode,
            'studentcr' => $studentcr,
        ]);
        // return response($qrcode)->header('Content-type','image/svg+xml');
        // return response($this->message)->header('Content-type','text/plain');
    }


    public function render()
    {
        return view('livewire.admin-student-id-card-comp');
    }
}
