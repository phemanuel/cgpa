<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    //

    public function studentRegistration()
    {
        return redirect()->route('page-development');
    }

    public function studentMigration()
    {
        return redirect()->route('page-development');
    }

    public function studentMenu()
    {
        return view('layout.student-menu');
    }
}
