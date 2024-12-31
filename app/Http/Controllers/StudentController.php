<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    //

    public function studentRegistration()
    {
        return redirect()->back()->with('success','This module is still under development');
    }

    public function studentMigration()
    {
        return redirect()->back()->with('success','This module is still under development');
    }

    public function studentMenu()
    {
        return view('layout.student-menu');
    }
}
