<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
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
                  
          <div class="row ">
      
      <div class="col-xl-3 col-lg-6">
              <div class="card l-bg-green">
                <div class="card-statistic-3">
                  <div class="card-icon card-icon-large"><i class="fa fa-briefcase"></i></div>
                  <div class="card-content">
                    <h4 class="card-title">No of Students - {{$students->count()}}</h4>
                    <span><strong></strong></span>
                    <div class="progress mt-1 mb-1" data-height="8">
                      <div class="progress-bar l-bg-orange" role="progressbar" data-width="{{$students->count()}}" aria-valuenow="{{$students->count()}}"
                        aria-valuemin="0" aria-valuemax="{{$students->count()}}"></div>
                    </div>
                    <!-- <div> <a href="" class="black-link">Check list of Students</a></div> -->
                  </div>
                </div>
              </div>
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
                  <h4>Result Entry for {{ $programme }} - {{ $stdLevel }} Level - {{$semester}} Semester |
                  <a href="javascript:void(0)" onclick="printAllStudents()" class="btn btn-outline-primary">
                        <i class="fas fa-print"></i> Print Score Sheet
                    </a>
                  </h4>
                  <div class="card-header-form">
                  <form>
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary" onclick="filterTable()"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <br>                    
                    <div class="container">
                        <h4></h4>
                        <form method="POST" action="">
                                @csrf
                                <div class="table-wrapper">
                                    <table class="table table-bordered" id="classListTable">
                                        <thead>
                                            <tr>
                                                <th>Admission No</th>
                                                <th>Name</th>
                                                <!-- <th>Level</th>
                                                <th>Semester</th> -->
                                                @foreach ($courses as $course)
                                                    <th>
                                                        {{ $course->course_title }} <br>
                                                        <strong><small><span style="color:green">{{ $course->course_code }}</span></small></strong>
                                                    </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $student)
                                                <tr>
                                                    <td>{{ $student->admission_no }}</td>
                                                    <td>{{ $student->surname }} {{ $student->first_name }} {{ $student->other_name }}</td>
                                                    <!-- <td>{{ $student->class }}</td>
                                                    <td>{{ $semester }}</td> -->

                                                    @foreach ($courses as $course)
                                                        @php
                                                            // Get the score for the student and course from the $studentScores array
                                                            $score = $studentScores[$student->admission_no][$course->id] ?? 0;
                                                        @endphp
                                                        
                                                        <td>
                                                        @php
                                                            // Format the score to remove the decimal part if it's a whole number
                                                            $formattedScore = (float)$score == (int)$score ? (int)$score : $score;
                                                        @endphp

                                                        <input 
                                                            type="text" 
                                                            name="scores[{{ $student->id }}][{{ $course->id }}]" 
                                                            class="form-control" 
                                                            maxlength="4"
                                                            value="{{ $formattedScore }}"
                                                            
                                                        >
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Results</button>
                            </form>
                        <br>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>  
          
           <!-- Hidden Table for Printing All Students -->
            <div id="allStudentsTable" style="display: none;">
            <h4>Score Sheet for {{ $programme }} - {{ $stdLevel }} Level - {{$semester}} Semester </h4>
            <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Admission No</th>
                                                <th>Name</th>
                                                <!-- <th>Level</th>
                                                <th>Semester</th> -->
                                                @foreach ($courses as $course)
                                                    <th>
                                                        {{ $course->course_title }} <br>
                                                        <strong><small><span style="color:green">{{ $course->course_code }}</span></small></strong>
                                                    </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $student)
                                                <tr>
                                                    <td>{{ $student->admission_no }}</td>
                                                    <td>{{ $student->surname }} {{ $student->first_name }} {{ $student->other_name }}</td>
                                                    <!-- <td>{{ $student->class }}</td>
                                                    <td>{{ $semester }}</td> -->

                                                    @foreach ($courses as $course)
                                                        @php
                                                            // Get the score for the student and course from the $studentScores array
                                                            $score = $studentScores[$student->admission_no][$course->id] ?? 0;
                                                        @endphp
                                                        
                                                        <td>
                                                        @php
                                                            // Format the score to remove the decimal part if it's a whole number
                                                            $formattedScore = (float)$score == (int)$score ? (int)$score : $score;
                                                        @endphp
                                                       {{ $formattedScore}}
                                                        
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

            </div>
          
        </section>
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
    // JavaScript for filtering the table
    function filterTable() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const table = document.getElementById('classListTable');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) { // Start from 1 to skip the header row
            const cells = rows[i].getElementsByTagName('td');
            let match = false;

            // Loop through all cells in the row
            for (let j = 0; j < cells.length; j++) {
                if (cells[j] && cells[j].innerText.toLowerCase().includes(input)) {
                    match = true;
                    break;
                }
            }

            // Toggle row visibility based on the match
            rows[i].style.display = match ? '' : 'none';
        }
    }

    // Optional: Add an event listener for real-time search
    document.getElementById('searchInput').addEventListener('input', filterTable);
</script>

<script>
function printAllStudents() {
    // Get the content of the hidden table
    var printContents = document.getElementById('allStudentsTable').innerHTML;

    // Create a hidden iframe
    var iframe = document.createElement('iframe');
    iframe.style.position = 'absolute';
    iframe.style.top = '-10000px';
    iframe.style.left = '-10000px';
    document.body.appendChild(iframe);

    // Write the content into the iframe
    var doc = iframe.contentWindow.document;
    doc.open();
    doc.write(`
        <html>
            <head>
                <title>Score Sheet</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                    th, td { border: 1px solid black; padding: 8px; text-align: left; }
                    th { background-color: #f2f2f2; }
                </style>
            </head>
            <body>                
                ${printContents}
            </body>
        </html>
    `);
    doc.close();

    // Trigger the print dialog
    iframe.contentWindow.focus();
    iframe.contentWindow.print();

    // Remove the iframe after printing
    setTimeout(() => {
        document.body.removeChild(iframe);
    }, 1000);
}
</script>
