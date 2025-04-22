<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>E-Result :: Result</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('dashboard/assets/css/app.min.css')}}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('dashboard/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/assets/css/components.css')}}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{asset('dashboard/assets/css/custom.css')}}">
  <link rel='shortcut icon' type='image/x-icon' href="{{asset('dashboard/assets/img/favicon.png')}}" />
  
  <style>
    .black-link {
    color: black;
    font-weight: bold;
    }

    .black-link:hover {
        color: black;

    }
  </style>
  <style>
    .form-control {
    width: 70px; /* You can adjust this width based on your desired size */
    text-align: center; /* Optional, to center the text in each input */
    box-sizing: border-box; /* Ensures padding and borders are included in width */
}
  </style>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .container {
        width: 100%;
    }

    /* Remove any unwanted elements like the footer */
    footer {
        display: none;
    }
</style>
</head>

<body>
  <!-- <div class="loader"></div> -->
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
           
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">        
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="{{ asset('profile_pictures/'. auth()->user()->image) }}" alt="Profile Picture"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello {{auth()->user()->first_name}}</div> 
              <a href="{{ route('admin-account-setting', ['id' => auth()->user()->id]) }}" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Account Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="{{route('logout')}}" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{route('admin-dashboard')}}"> <img alt="image" src="{{asset('dashboard/assets/img/logo.png')}}" class="header-logo" /> <span
                class="logo-name">E-Result</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            @if(auth()->user()->user_type_status == 1)
            <li class="dropdown">
              <a href="{{ route('admin-dashboard') }}" class="nav-link"><i data-feather="home"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="{{route('class-list')}}" class="nav-link"><i data-feather="list"></i><span>Class List</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user"></i><span>Student</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('student-registration')}}">Student Registration</a></li>
                <li><a class="nav-link" href="{{route('student-migration')}}">Student Migration</a></li>                
              </ul>
            </li>
            <li class="dropdown active">
              <a href="#" class="nav-link menu-toggle nav-link has-dropdown"><i data-feather="clipboard"></i><span>Result</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('result-entry')}}">Result Entry</a></li>
                <li><a class="nav-link" href="{{route('result-compute')}}">Result Computation</a></li>
                <li><a class="nav-link" href="{{route('semester-result')}}">Semester Result</a></li>
                <li><a class="nav-link" href="{{route('semester-summary')}}">Semester Result Summary</a></li>
                <li><a class="nav-link" href="{{route('cgpa-summary')}}">CGPA Summary</a></li>
                <li><a class="nav-link" href="{{route('student-transcript')}}">Student Transcript</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="{{route('course-setup')}}" class="nav-link"><i data-feather="book"></i><span>Course</span></a>
            </li>
            <li class="dropdown">
              <a href="{{route('hod-setup')}}" class="nav-link"><i data-feather="briefcase"></i><span>HOD</span></a>
            </li>
            <li class="dropdown">
              <a href="{{route('grading')}}" class="nav-link"><i data-feather="slack"></i><span>Grading System</span></a>
            </li>
            <li class="dropdown">
              <a href="{{route('score-sheet')}}" class="nav-link"><i data-feather="file-text"></i><span>Score Sheet</span></a>
            </li>
            <li class="dropdown">
              <a href="{{ route('transcript-request') }}" class="nav-link"><i data-feather="archive"></i><span>Transcript Requests</span></a>
            </li>
            <li class="dropdown">
              <a href="{{ route('admin-account-setting', ['id' => auth()->user()->id]) }}" class="nav-link"><i data-feather="settings"></i><span>Account Settings</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Users</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('users')}}">Admins</a></li>
                <li><a class="nav-link" href="{{route('instructors')}}">Instructors</a></li> 
                <li><a class="nav-link" href="{{route('student')}}">Students</a></li>                
              </ul>
            </li>           
            @elseif(auth()->user()->user_type_status == 2)
            <li class="dropdown">
              <a href="{{ route('admin-dashboard') }}" class="nav-link"><i data-feather="home"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="{{route('class-list')}}" class="nav-link"><i data-feather="list"></i><span>Class List</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user"></i><span>Student</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('student-registration')}}">Student Registration</a></li>
                <li><a class="nav-link" href="{{route('student-migration')}}">Student Migration</a></li>                
              </ul>
            </li>
            <li class="dropdown active">
              <a href="#" class="nav-link menu-toggle nav-link has-dropdown"><i data-feather="clipboard"></i><span>Result</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('result-entry')}}">Result Entry</a></li>
                <li><a class="nav-link" href="{{route('result-compute')}}">Result Computation</a></li>
                <li><a class="nav-link" href="{{route('semester-result')}}">Semester Result</a></li>
                <li><a class="nav-link" href="{{route('semester-summary')}}">Semester Result Summary</a></li>
                <li><a class="nav-link" href="{{route('cgpa-summary')}}">CGPA Summary</a></li>
                <li><a class="nav-link" href="{{route('student-transcript')}}">Student Transcript</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="{{route('course-setup')}}" class="nav-link"><i data-feather="book"></i><span>Course</span></a>
            </li>
            <li class="dropdown">
              <a href="{{route('hod-setup')}}" class="nav-link"><i data-feather="briefcase"></i><span>HOD</span></a>
            </li>
            <li class="dropdown">
              <a href="{{route('grading')}}" class="nav-link"><i data-feather="slack"></i><span>Grading System</span></a>
            </li>
            <li class="dropdown">
              <a href="{{route('score-sheet')}}" class="nav-link"><i data-feather="file-text"></i><span>Score Sheet</span></a>
            </li>
            <li class="dropdown">
              <a href="{{ route('transcript-request') }}" class="nav-link"><i data-feather="archive"></i><span>Transcript Requests</span></a>
            </li>
            <li class="dropdown">
              <a href="{{ route('admin-account-setting', ['id' => auth()->user()->id]) }}" class="nav-link"><i data-feather="settings"></i><span>Account Settings</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="users"></i><span>Users</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('users')}}">Admins</a></li>
                <li><a class="nav-link" href="{{route('instructors')}}">Instructors</a></li> 
                <li><a class="nav-link" href="{{route('student')}}">Students</a></li>                
              </ul>
            </li> 
            @elseif(auth()->user()->user_type_status == 3)  
            <li class="dropdown">
              <a href="{{ route('admin-dashboard') }}" class="nav-link"><i data-feather="home"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="{{route('class-list')}}" class="nav-link"><i data-feather="list"></i><span>Class List</span></a>
            </li>            
            <li class="dropdown active">
              <a href="#" class="nav-link menu-toggle nav-link has-dropdown"><i data-feather="clipboard"></i><span>Result</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{route('result-entry')}}">Result Entry</a></li>
                <li><a class="nav-link" href="{{route('result-compute')}}">Result Computation</a></li>
                <li><a class="nav-link" href="{{route('semester-result')}}">Semester Result</a></li>
                <li><a class="nav-link" href="{{route('semester-summary')}}">Semester Result Summary</a></li>
                <li><a class="nav-link" href="{{route('cgpa-summary')}}">CGPA Summary</a></li>                
              </ul>
            </li>
            <li class="dropdown">
              <a href="{{route('course-setup')}}" class="nav-link"><i data-feather="book"></i><span>Course</span></a>
            </li>
            <li class="dropdown">
              <a href="{{ route('admin-account-setting', ['id' => auth()->user()->id]) }}" class="nav-link"><i data-feather="settings"></i><span>Account Settings</span></a>
            </li>                 
            @elseif(auth()->user()->user_type_status == 4)            
            <li class="dropdown active">
              <a href="{{ route('dashboard') }}" class="nav-link"><i data-feather="home"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="{{route('student-result')}}" class="nav-link"><i data-feather="clipboard"></i><span>Result</span></a>
            </li>
            <li class="dropdown">
              <a href="{{ route('user-request') }}" class="nav-link"><i data-feather="archive"></i><span>Request Transcript</span></a>
            </li>
            <li class="dropdown">
              <a href="{{ route('account-setting', ['id' => auth()->user()->id]) }}" class="nav-link"><i data-feather="settings"></i><span>Account Settings</span></a>
            </li>
            <li class="dropdown">
              <a href="{{ route('contact-us') }}" class="nav-link"><i data-feather="mail"></i><span>Contact Us</span></a>
            </li>
            @endif
          </ul>
        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
        
                    <div class="row">
                    <div class="col-12">
                      <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-dark text-white-all d-flex justify-content-between overflow-auto" style="white-space: nowrap;">
                  @if(auth()->user()->user_type_status == 1)
                  <li class="breadcrumb-item active">
                    <a href="{{route('dashboard')}}"><i class="fas fa-home"></i> Dashboard</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="{{route('class-list')}}"><i class="fas fa-chalkboard-teacher"></i> Class List</a>
                  </li>
                  <li class="breadcrumb-item dropdown" aria-current="page">
                    <a href="{{route('student-menu')}}"><i class="fas fa-user-graduate"></i> Student</a>         
                  </li>
                  <li class="breadcrumb-item" aria-current="page">
                    <a href="{{route('result-menu')}}"><i class="fas fa-poll"></i> Result</a>                   
                  </li>
                  <li class="breadcrumb-item">
                    <a href="{{route('course-setup')}}"><i class="fas fa-book"></i> Course</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="{{route('hod-setup')}}"><i class="fas fa-user-tie"></i> HOD</a>
                  </li>        
                  <li class="breadcrumb-item">
                    <a href="{{route('grading')}}"><i class="fas fa-clipboard-list"></i> Grading System</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="{{route('score-sheet')}}"><i class="fas fa-file-alt"></i> Score Sheet</a>
                  </li>     
                  <li class="breadcrumb-item">
                    <a href="{{route('transcript-request')}}"><i class="fas fa-file-signature"></i> Transcript Request</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="{{ route('admin-account-setting', ['id' => auth()->user()->id]) }}"><i class="fas fa-cogs"></i> Account Setting</a>
                  </li>   
                  <li class="breadcrumb-item">
                    <a href="{{route('user-menu')}}"><i class="fas fa-users"></i> Users</a>
                  </li> 
                  @elseif(auth()->user()->user_type_status == 2)
                  <li class="breadcrumb-item active">
                    <a href="{{route('dashboard')}}"><i class="fas fa-home"></i> Dashboard</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="{{route('class-list')}}"><i class="fas fa-chalkboard-teacher"></i> Class List</a>
                  </li>
                  <li class="breadcrumb-item" aria-current="page">
                    <a href="{{route('student-menu')}}"><i class="fas fa-user-graduate"></i> Student</a>         
                  </li>
                  <li class="breadcrumb-item" aria-current="page">
                    <a href="{{route('result-menu')}}"><i class="fas fa-poll"></i> Result</a>                   
                  </li>
                  <li class="breadcrumb-item">
                    <a href="{{route('course-setup')}}"><i class="fas fa-book"></i> Course</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="{{route('hod-setup')}}"><i class="fas fa-user-tie"></i> HOD</a>
                  </li>        
                  <li class="breadcrumb-item">
                    <a href="{{route('grading')}}"><i class="fas fa-clipboard-list"></i> Grading System</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="{{route('score-sheet')}}"><i class="fas fa-file-alt"></i> Score Sheet</a>
                  </li>     
                  <li class="breadcrumb-item">
                    <a href="{{route('transcript-request')}}"><i class="fas fa-file-signature"></i> Transcript Request</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="{{ route('admin-account-setting', ['id' => auth()->user()->id]) }}"><i class="fas fa-cogs"></i> Account Setting</a>
                  </li>   
                  <li class="breadcrumb-item">
                    <a href="{{route('user-menu')}}"><i class="fas fa-users"></i> Users</a>
                  </li> 
                  @elseif(auth()->user()->user_type_status == 3)
                  <li class="breadcrumb-item active">
                    <a href="{{route('dashboard')}}"><i class="fas fa-home"></i> Dashboard</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="{{route('class-list')}}"><i class="fas fa-chalkboard-teacher"></i> Class List</a>
                  </li>                  
                  <li class="breadcrumb-item" aria-current="page">
                    <a href="{{route('result-menu')}}"><i class="fas fa-poll"></i> Result</a>                   
                  </li>
                  <li class="breadcrumb-item">
                    <a href="{{route('course-setup')}}"><i class="fas fa-book"></i> Course</a>
                  </li> 
                  <li class="breadcrumb-item">
                    <a href="{{ route('admin-account-setting', ['id' => auth()->user()->id]) }}"><i class="fas fa-cogs"></i> Account Setting</a>
                  </li>
                  @elseif(auth()->user()->user_type_status == 4)
                  <li class="breadcrumb-item active">
                    <a href="{{route('dashboard')}}"><i class="fas fa-home"></i> Dashboard</a>
                  </li>                  
                  <li class="breadcrumb-item" aria-current="page">
                    <a href="{{route('student-result')}}"><i class="fas fa-poll"></i> Result</a>                   
                  </li>                   
                  <li class="breadcrumb-item">
                    <a href="{{route('user-request')}}"><i class="fas fa-file-signature"></i> Request Transcript</a>
                  </li>
                  <li class="breadcrumb-item">
                    <a href="{{ route('account-setting', ['id' => auth()->user()->id]) }}"><i class="fas fa-cogs"></i> Account Setting</a>
                  </li>   
                  <li class="breadcrumb-item">
                    <a href="{{route('contact-us')}}"><i class="fas fa-mail"></i> Contact Us</a>
                  </li> 
                  @endif
                        </ol>
                      </nav>
                    </div>
                  </div>      
                  
          
          @if(session('success'))
                    <div class="alert alert-success">
                      {{ session('success') }}
                    </div>
                  @elseif(session('error'))
                    <div class="alert alert-danger">
                      {{ session('error') }}
                    </div>
                    @endif	
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>
                  <a href="{{route('result-compute')}}"  class="btn btn-outline-primary">
                      <i class="fas fa-print"></i> Back to Result Page
                  </a>
                  <!-- Print Current Page -->
                  <a href="javascript:void(0)" onclick="printReport()" class="btn btn-outline-primary">
                      <i class="fas fa-print"></i> Print Result
                  </a>

                  <!-- Print All Results -->
                  <!-- <a href="javascript:void(0)" onclick="printAllResults()" class="btn btn-outline-primary">
                      <i class="fas fa-print"></i> Print All Results
                  </a> -->
                  </h4>
                  <div class="card-header-form">
                  <!-- <form>
                      <div class="input-group">
                      <input type="text" id="searchInput" class="form-control" placeholder="Search by Full Name or Matric No" onkeyup="filterTable()">
                      </div>
                  </form> -->
                  {{-- Pagination --}}
                        <div class="pagination">
                            {{ $results->appends(request()->query())->links() }}
                        </div>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <br>                   
                    <div class="container">
                        <h4></h4>
                        <div class="container mt-4">
                        
                        {{-- Header --}}
                        <div class="text-center mb-4">
                            <img src="{{ asset('dashboard/assets/img/logo.png') }}" alt="College Logo" style="height: 100px;">
                            <h3 class="mt-2">{{ strtoupper('Oyo State College of Health Science and Technology') }}</h3>
                            <p>Eleyele, Ibadan, Oyo State, Nigeria.</p>
                        </div>                        

                        @foreach ($studentData as $student)
                        {{-- Student Info --}}
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title text-center font-weight-bold">
                                    {{ strtoupper("{$student['class']} Level {$semester} Semester Academic Report") }}
                                </h5>

                                <table class="table table-bordered align-middle">
                                    <tr>
                                        <td rowspan="4" style="width: 150px; text-align: center;">
                                        @php
                                            $imagePath = public_path('uploads/' . $student['studpicture'] . '.jpg');
                                            $imageUrl = file_exists($imagePath) 
                                                ? asset('uploads/' . $student['studpicture'] . '.jpg') 
                                                : asset('uploads/blank.jpg');
                                        @endphp

                                        <img 
                                            src="{{ $imageUrl }}" 
                                            alt="Student Picture" 
                                            class="img-thumbnail" 
                                            style="max-width: 130px;">
                                        </td>
                                        <th>Full Name:</th>
                                        <td>{{ $student['stusurname'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Matric No:</th>
                                        <td>{{ $student['stuno'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Level:</th>
                                        <td>{{ $student['class'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Programme:</th>
                                        <td>{{ $student['coursekeep'] }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        {{-- Results and GPA --}}
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-striped table-bordered text-center">
                                            <thead class="bg-dark text-white">
                                            <tr>
                                                    <th style="color: white;">Code</th>
                                                    <th style="color: white;">Course</th>
                                                    <th style="color: white;">Unit</th>
                                                    <th style="color: white;">Average(100)</th>
                                                    <th style="color: white;">Grade</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Check if subjects, grades, units, and scores are set and not null --}}
                                                @if(isset($student['subjects']) && is_array($student['subjects']) && count($student['subjects']) > 0)
                                                    @foreach ($student['subjects'] as $index => $subject)
                                                        @if(!empty($subject) && !is_null($subject) && !empty($student['subjectGrades'][$index]) && !is_null($student['subjectGrades'][$index]) && !empty($student['units'][$index]) && !is_null($student['units'][$index]) && !empty($student['scores'][$index]) && !is_null($student['scores'][$index]))
                                                        <tr>
                                                            <td style="font-size: 13px;">{{ $student['ctitles'][$index] }}</td>
                                                            <td style="text-align: left; font-size: 13px;">{{ $subject }}</td>
                                                            <td style="font-size: 13px;">{{ $student['units'][$index] }}</td>
                                                            <td style="font-size: 13px;">
                                                                @if (floor($student['scores'][$index]) == $student['scores'][$index])
                                                                    {{ (int) $student['scores'][$index] }}
                                                                @else
                                                                    {{ $student['scores'][$index] }}
                                                                @endif
                                                            </td>
                                                            <td style="font-size: 13px;">{{ $student['subjectGrades'][$index] }}</td>
                                                        </tr>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <tr><td colspan="4">No subjects available</td></tr>
                                                @endif
                                            </tbody>
                                        </table>

                                        {{-- GPA Summary --}}
                                        <div class="mt-4">
                                        <table class="table table-bordered table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>Total Grade Points:</strong></td>
                                                        <td style="font-size: 13px;">{{ $student['totalGradePoints'] }}</td>
                                                        <td>&nbsp;</td>
                                                        <td rowspan="3"><img src="{{asset('signature/' . $hod->sign)}}" alt="Hod Signature" width="160" height="60"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>Total Units:</strong></td>
                                                        <td style="font-size: 13px;">{{ $student['totalUnits'] }}</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>GPA:</strong></td>
                                                        <td style="font-size: 13px;">{{ $student['totalGPA'] ?? 'N/A' }}</td>
                                                        <td>&nbsp;</td>
                                                    </tr>                                
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>Remark:</strong></td>
                                                        <td style="font-size: 13px;">
                                                            <span class="{{ $student['remarks'] === 'PASSED ALL' ? 'text-success' : 'text-danger' }}">
                                                                {{ $student['remarks'] }}                                                            </span>                                                        </td>
                                                        <td>&nbsp;</td>
                                                        <td style="text-align: center; font-size: 13px;">{{ $hod->hod_name }}</td>
                                                    </tr>
                                                    
                                                    @if (!empty($student['failedRemarks']))
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>Courses with Carryover:</strong></td>
                                                        <td colspan="3" style="font-size: 12px;">{{ $student['failedRemarks'] }}</td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Grading System & Classification --}}
                            <div class="col-md-4">
                                <div class="row">
                                    {{-- Grading System --}}
                                    <div class="col-12 mb-2">
                                        <div class="card h-100">
                                            <div class="card-body p-1">
                                                <h6 class="card-title text-center font-weight-bold mb-1">Grading System</h6>
                                                <table class="table table-striped table-bordered text-center">
                                                    <thead class="bg-dark text-white">
                                                        <tr>
                                                            <th style="padding: 0.2rem; color: white; font-size: 13px;" >Score</th>
                                                            <th style="padding: 0.2rem; color: white; font-size: 13px;">Grade</th>
                                                            <th style="padding: 0.2rem; color: white; font-size: 13px;">Point</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($grades as $grade)
                                                        <tr>
                                                            <td style="padding: 0.1rem; font-size: 13px;">{{ $grade['min'] }} - {{ $grade['max'] }}</td>
                                                            <td style="padding: 0.1rem; font-size: 13px;">{{ $grade['letter_grade'] }}</td>
                                                            <td style="padding: 0.1rem; font-size: 13px;">{{ number_format($grade['unit'], 2) }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Classification --}}
                                    <div class="col-12 mb-2">
                                        <div class="card h-100">
                                            <div class="card-body p-1">
                                                <h6 class="card-title text-center font-weight-bold mb-1">Classification</h6>
                                                <table class="table table-striped table-bordered text-center">
                                                    <thead class="bg-dark text-white">
                                                        <tr>
                                                            <th style="padding: 0.2rem; color: white; font-size: 13px;">CGPA</th>
                                                            <th style="padding: 0.2rem; color: white; font-size: 13px;">Class</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr><td style="padding: 0.1rem; font-size: 13px;">3.5 - 4.0</td><td style="padding: 0.1rem;">Distinction</td></tr>
                                                        <tr><td style="padding: 0.1rem; font-size: 13px;">3.0 - 3.49</td><td style="padding: 0.1rem;">Upper Credit</td></tr>
                                                        <tr><td style="padding: 0.1rem; font-size: 13px;">2.5 - 2.9</td><td style="padding: 0.1rem;">Lower Credit</td></tr>
                                                        <tr><td style="padding: 0.1rem; font-size: 13px;">2.0 - 2.49</td><td style="padding: 0.1rem;">Pass</td></tr>
                                                        <tr><td style="padding: 0.1rem; font-size: 13px;">Below 2.0</td><td style="padding: 0.1rem;">Fail</td></tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div> <!-- end col-md-4 -->
                        </div> <!-- end row -->

                        {{-- Pagination --}}
                        <div class="pagination">
                            {{ $results->appends(request()->query())->links() }}
                        </div>

                        @endforeach
                    </div>
                  


                        <br>
                    </div>

                   
                  </div>
                </div>
              </div>
            </div>
          </div>   

        </section>

<!-- Hidden Container -->
<div id="reportToPrint" style="display: none;">
<div class="container mt-4">
                        {{-- Header --}}
                        <div class="text-center mb-4">
                            <img src="{{ asset('dashboard/assets/img/logo.png') }}" alt="College Logo" style="height: 100px;">
                            <h3 class="mt-2">{{ strtoupper('Oyo State College of Health Science and Technology') }}</h3>
                            <p>Eleyele, Ibadan, Oyo State, Nigeria.</p>
                        </div>

                        @foreach ($studentData as $student)
                        {{-- Student Info --}}
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title text-center font-weight-bold">
                                    {{ strtoupper("{$student['class']} Level {$semester} Semester Academic Report") }}
                                </h5>

                                <table class="table table-bordered align-middle">
                                    <tr>
                                        <td rowspan="4" style="width: 150px; text-align: center;">
                                        @php
                                            $imagePath = public_path('public/uploads/' . $student['studpicture'] . '.jpg');
                                            $imageUrl = file_exists($imagePath) 
                                                ? asset('public/uploads/' . $student['studpicture'] . '.jpg') 
                                                : asset('public/uploads/blank.jpg');
                                        @endphp

                                        <img 
                                            src="{{ $imageUrl }}" 
                                            alt="Student Picture" 
                                            class="img-thumbnail" 
                                            style="max-width: 130px;">
                                        </td>
                                        <th>Full Name:</th>
                                        <td>{{ $student['stusurname'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Matric No:</th>
                                        <td>{{ $student['stuno'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Level:</th>
                                        <td>{{ $student['class'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Programme:</th>
                                        <td>{{ $student['coursekeep'] }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        {{-- Results and GPA --}}
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-striped table-bordered text-center">
                                            <thead class="bg-dark text-white">
                                            <tr>
                                                    <th style="color: black;">Code</th>
                                                    <th style="color: black;">Course</th>
                                                    <th style="color: black;">Unit</th>
                                                    <th style="color: black;">Average(100)</th>
                                                    <th style="color: black;">Grade</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Check if subjects, grades, units, and scores are set and not null --}}
                                                @if(isset($student['subjects']) && is_array($student['subjects']) && count($student['subjects']) > 0)
                                                    @foreach ($student['subjects'] as $index => $subject)
                                                        @if(!empty($subject) && !is_null($subject) && !empty($student['subjectGrades'][$index]) && !is_null($student['subjectGrades'][$index]) && !empty($student['units'][$index]) && !is_null($student['units'][$index]) && !empty($student['scores'][$index]) && !is_null($student['scores'][$index]))
                                                        <tr>
                                                            <td style="font-size: 13px;">{{ $student['ctitles'][$index] }}</td>
                                                            <td style="text-align: left; font-size: 13px;">{{ $subject }}</td>
                                                            <td style="font-size: 13px;">{{ $student['units'][$index] }}</td>
                                                            <td style="font-size: 13px;">
                                                                @if (floor($student['scores'][$index]) == $student['scores'][$index])
                                                                    {{ (int) $student['scores'][$index] }}
                                                                @else
                                                                    {{ $student['scores'][$index] }}
                                                                @endif
                                                            </td>
                                                            <td style="font-size: 13px;">{{ $student['subjectGrades'][$index] }}</td>
                                                        </tr>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <tr><td colspan="4">No subjects available</td></tr>
                                                @endif
                                            </tbody>
                                        </table>

                                        {{-- GPA Summary --}}
                                        <div class="mt-4">
                                        <table class="table table-bordered table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>Total Grade Points:</strong></td>
                                                        <td style="font-size: 13px;">{{ $student['totalGradePoints'] }}</td>
                                                        <td>&nbsp;</td>
                                                        <td rowspan="3"><img src="{{asset('signature/' . $hod->sign)}}" alt="Hod Signature" width="160" height="60"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>Total Units:</strong></td>
                                                        <td style="font-size: 13px;">{{ $student['totalUnits'] }}</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>GPA:</strong></td>
                                                        <td style="font-size: 13px;">{{ $student['totalGPA'] ?? 'N/A' }}</td>
                                                        <td>&nbsp;</td>
                                                    </tr>                                
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>Remark:</strong></td>
                                                        <td style="font-size: 13px;">
                                                            <span class="{{ $student['remarks'] === 'PASSED ALL' ? 'text-success' : 'text-danger' }}">
                                                                {{ $student['remarks'] }}                                                            </span>                                                        </td>
                                                        <td>&nbsp;</td>
                                                        <td style="text-align: center; font-size: 13px;">{{ $hod->hod_name }}</td>
                                                    </tr>
                                                    
                                                    @if (!empty($student['failedRemarks']))
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>Courses with Carryover:</strong></td>
                                                        <td colspan="3" style="font-size: 13px;">{{ $student['failedRemarks'] }}</td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Grading System & Classification --}}
                            <!-- <div class="col-md-4">
                                <div class="row">
                                    {{-- Grading System --}}
                                    <div class="col-12 mb-2">
                                        <div class="card h-100">
                                            <div class="card-body p-1">
                                                <h6 class="card-title text-center font-weight-bold mb-1">Grading System</h6>
                                                <table class="table table-striped table-bordered text-center">
                                                    <thead class="bg-dark text-white">
                                                        <tr>
                                                            <th style="padding: 0.2rem; color: white;" >Score</th>
                                                            <th style="padding: 0.2rem; color: white;">Grade</th>
                                                            <th style="padding: 0.2rem; color: white;">Point</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($grades as $grade)
                                                        <tr>
                                                            <td style="padding: 0.1rem;">{{ $grade['min'] }} - {{ $grade['max'] }}</td>
                                                            <td style="padding: 0.1rem;">{{ $grade['letter_grade'] }}</td>
                                                            <td style="padding: 0.1rem;">{{ number_format($grade['unit'], 2) }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Classification --}}
                                    <div class="col-12 mb-2">
                                        <div class="card h-100">
                                            <div class="card-body p-1">
                                                <h6 class="card-title text-center font-weight-bold mb-1">Classification</h6>
                                                <table class="table table-striped table-bordered text-center">
                                                    <thead class="bg-dark text-white">
                                                        <tr>
                                                            <th style="padding: 0.2rem; color: white;">CGPA</th>
                                                            <th style="padding: 0.2rem; color: white;">Class</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr><td style="padding: 0.1rem;">3.5 - 4.0</td><td style="padding: 0.1rem;">Distinction</td></tr>
                                                        <tr><td style="padding: 0.1rem;">3.0 - 3.49</td><td style="padding: 0.1rem;">Upper Credit</td></tr>
                                                        <tr><td style="padding: 0.1rem;">2.5 - 2.9</td><td style="padding: 0.1rem;">Lower Credit</td></tr>
                                                        <tr><td style="padding: 0.1rem;">2.0 - 2.49</td><td style="padding: 0.1rem;">Pass</td></tr>
                                                        <tr><td style="padding: 0.1rem;">Below 2.0</td><td style="padding: 0.1rem;">Fail</td></tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>  -->
                        </div> <!-- end row -->
                        

                        @endforeach
                    </div>
  </div>
<!-- end -->
        <div class="settingSidebar">
          <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
          </a>
          <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
              <div class="setting-panel-header">Setting Panel
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                    <span class="selectgroup-button">Light</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                    <span class="selectgroup-button">Dark</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                  <ul class="choose-theme list-unstyled mb-0">
                    <li title="white" class="active">
                      <div class="white"></div>
                    </li>
                    <li title="cyan">
                      <div class="cyan"></div>
                    </li>
                    <li title="black">
                      <div class="black"></div>
                    </li>
                    <li title="purple">
                      <div class="purple"></div>
                    </li>
                    <li title="orange">
                      <div class="orange"></div>
                    </li>
                    <li title="green">
                      <div class="green"></div>
                    </li>
                    <li title="red">
                      <div class="red"></div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Mini Sidebar</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="sticky_header_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Sticky Header</span>
                  </label>
                </div>
              </div>
              <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                  <i class="fas fa-undo"></i> Restore Default
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          <a href="https://oyschst.edu.ng" target="_blank">Oyo State College of Health, Science and Technology</a></a>
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="{{asset('dashboard/assets/js/app.min.js')}}"></script>
  <!-- JS Libraies -->
  <script src="{{asset('dashboard/assets/bundles/apexcharts/apexcharts.min.js')}}"></script>
  <!-- Page Specific JS File -->
  <script src="{{asset('dashboard/assets/js/page/index.js')}}"></script>
  <!-- Template JS File -->
  <script src="{{asset('dashboard/assets/js/scripts.js')}}"></script>
  <!-- Custom JS File -->
  <script src="{{asset('dashboard/assets/js/custom.js')}}"></script>
</body>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->
</html>
<script>
function printReport() {
    const reportContent = document.getElementById('reportToPrint').innerHTML;

    const printWindow = window.open('', '', 'height=800,width=1000');

    printWindow.document.write(`
        <html>
        <head>
            <title>Print Academic Report</title>
            <link rel="stylesheet" href="{{ asset('dashboard/assets/css/bootstrap.min.css') }}">
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                img { max-height: 130px; }
                .table { width: 100%; border-collapse: collapse; }
                .table td, .table th { border: 1px solid #000; padding: 4px; }
                .text-center { text-align: center; }
                .text-success { color: green; }
                .text-danger { color: red; }
                .card { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; }
                .card-title { font-size: 18px; font-weight: bold; }
            </style>
        </head>
        <body onload="window.print(); window.close();">
            ${reportContent}
        </body>
        </html>
    `);

    printWindow.document.close();
}
</script>

<script>
    // Function to filter the table rows based on search input
    function filterTable() {
        const searchInput = document.getElementById('searchInput').value.toLowerCase();
        const tableRows = document.querySelectorAll('.table-striped tbody tr'); // Get all rows in the table

        tableRows.forEach(row => {
            // Get the student name and matric no columns. These are in the first and second columns.
            const studentName = row.cells[1].textContent.toLowerCase();  // Full Name column (second column)
            const matricNo = row.cells[2].textContent.toLowerCase();  // Matric No column (third column)

            // If the search term is found in the name or matric number, show the row. Otherwise, hide it.
            if (studentName.includes(searchInput) || matricNo.includes(searchInput)) {
                row.style.display = '';  // Show row
            } else {
                row.style.display = 'none';  // Hide row
            }
        });
    }
</script>






