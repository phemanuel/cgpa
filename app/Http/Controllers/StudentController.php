<?php

namespace App\Http\Controllers;
use App\Models\Registration;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    //

    public function students()
    {
        try {
            $user = auth()->user();
            $rolePermission = $user->students;

            if($rolePermission != 1) {
                return redirect()->back()->with('error', 'You do not have permission to this module.');
            }
        
            $users = Registration::paginate(10);
            $userCount = Registration::count();
            return view('layout.students', compact('users','userCount'));
        } catch (\Exception $e) {
            // Handle any exceptions that may occur
            // Log the error or redirect to a generic error page
            return redirect('generic-error')->with('error', 'An unexpected error occurred');
        }
         

    }

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
