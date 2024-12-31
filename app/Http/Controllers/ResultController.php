<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultController extends Controller
{
    //
    public function resultMenu()
    {
        return view('layout.result-menu');
    }
}
