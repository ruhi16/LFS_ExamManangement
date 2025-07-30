<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Teacher;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        // echo "Super Admin";
        // $teachers = Teacher::with('user')->get();
        // $teachers = Teacher::with('user')->get();
        // echo( $teachers );
        // foreach($teachers as $teacher){
        //     echo($teacher->user . '</br>');
        // }

        // echo(json_encode( $teachers->user() ));
        return view('superadmin-dashboard');
    }

    public function home()
    {
        return view('livewire.home');
    }

    public function about()
    {
        return view('livewire.about');
    }

    public function contact()
    {
        return view('livewire.contact');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
