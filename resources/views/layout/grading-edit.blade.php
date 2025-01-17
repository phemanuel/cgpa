<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>E-result :: Grading System</title>
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
        </div><ul class="navbar-nav navbar-right">        
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
            <li class="dropdown">
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
            <li class="dropdown active">
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
            <li class="dropdown">
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
            <li class="dropdown active">
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
            <li class="dropdown">
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
              <a href="{{route('course-setup')}}" class="nav-link"><i data-feather="book"></i><span>Course Setup</span></a>
            </li>
            <li class="dropdown">
              <a href="{{ route('admin-account-setting', ['id' => auth()->user()->id]) }}" class="nav-link"><i data-feather="settings"></i><span>Account Settings</span></a>
            </li>                 
            @elseif(auth()->user()->user_type_status == 4)            
            <li class="dropdown">
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
                    <div class="card-icon card-icon-large"><i class="fa fa-award"></i></div>
                    <div class="card-content">
                      <h4 class="card-title">Grading System</h4>
                      <span><strong></strong></span>
                      <div class="progress mt-1 mb-1" data-height="8">
                        <div class="progress-bar l-bg-purple" role="progressbar" data-width="{{$grading->count()}}" aria-valuenow="{{$grading->count()}}"
                          aria-valuemin="0" aria-valuemax="{{$grading->count()}}"></div>
                      </div>
                      
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
                  <h4>Grading System  
                    <!-- <a href="javascript:void(0)" onclick="printAllStudents()" class="btn btn-outline-primary">
        <i class="fas fa-print"></i> Print
    </a> -->
</h4>
                  <div class="card-header-form">
                    <form>                    
                      <div class="input-group">
                      <a href="{{route('grading')}}" class="btn btn-primary"><i class="fas fa-edit"></i> Grading System</a>
                        <!-- <input type="text" class="form-control" placeholder="Search"> -->
                        <!-- <div class="input-group-btn">
                          <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div> -->
                      </div>
                    </form>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                  
           <form action="{{route('grading-edit.action')}}" method="POST">
           @csrf
           @method('PUT')
           <table class="table table-bordered" id="hodListTable">
                        <thead>
                            <tr>
                                <th width="37">&nbsp;</th>
                                <th colspan="3">
                                    <div align="center">Score(%)</div>            </th>
                                <th width="64">
                                    <div align="center">Unit</div>            </th>
                                <th width="72">
                                    <div align="center">Grade</div>            </th>
                                <th width="60">&nbsp;</th>
                            </tr>
                            <tr>
                                <th width="37">&nbsp;</th>
                                <th width="60">From</th>
                                <th width="6">&nbsp;</th>
                                <th width="60">To</th>
                                <th width="64"></th>
                                <th width="72"></th>
                                <th width="60"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th><div align="center">1</div></th>
                            <td><input name="grade01" type="text" id="grade01" size="10" maxlength="3" value="{{ $grading->grade01 ?? '' }}" class="form-control" /></td>
                            <td><div align="center">-</div></td>
                            <td><input name="grade02" type="text" id="grade02" size="10" maxlength="3" value="{{ $grading->grade02 ?? '' }}" class="form-control" /></td>
                            <td><input name="unit01" type="text" id="unit01" size="10" maxlength="4" value="{{ $grading->unit01 ?? '' }}" class="form-control" /></td>
                            <td><input name="lgrade1" type="text" id="lgrade1" size="10" maxlength="4" value="{{ $grading->lgrade1 ?? '' }}" class="form-control" /></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <th><div align="center">2</div></th>
                            <td><input name="grade11" type="text" id="grade11" size="10" maxlength="3" value="{{ $grading->grade11 ?? '' }}" class="form-control" /></td>
                            <td><div align="center">-</div></td>
                            <td><input name="grade12" type="text" id="grade12" size="10" maxlength="3" value="{{ $grading->grade12 ?? '' }}" class="form-control" /></td>
                            <td><input name="unit02" type="text" id="unit02" size="10" maxlength="4" value="{{ $grading->unit02 ?? '' }}" class="form-control" /></td>
                            <td><input name="lgrade2" type="text" id="lgrade2" size="10" maxlength="4" value="{{ $grading->lgrade2 ?? '' }}" class="form-control" /></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <th><div align="center">3</div></th>
                            <td><input name="grade21" type="text" id="grade21" size="10" maxlength="3" value="{{ $grading->grade21 ?? '' }}" class="form-control" /></td>
                            <td><div align="center">-</div></td>
                            <td><input name="grade22" type="text" id="grade22" size="10" maxlength="3" value="{{ $grading->grade22 ?? '' }}" class="form-control" /></td>
                            <td><input name="unit03" type="text" id="unit03" size="10" maxlength="4" value="{{ $grading->unit03 ?? '' }}" class="form-control" /></td>
                            <td><input name="lgrade3" type="text" id="lgrade3" size="10" maxlength="4" value="{{ $grading->lgrade3 ?? '' }}" class="form-control" /></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <th><div align="center">4</div></th>
                            <td><input name="grade31" type="text" id="grade31" size="10" maxlength="3" value="{{ $grading->grade31 ?? '' }}" class="form-control" /></td>
                            <td><div align="center">-</div></td>
                            <td><input name="grade32" type="text" id="grade32" size="10" maxlength="3" value="{{ $grading->grade32 ?? '' }}" class="form-control" /></td>
                            <td><input name="unit04" type="text" id="unit04" size="10" maxlength="4" value="{{ $grading->unit04 ?? '' }}" class="form-control" /></td>
                            <td><input name="lgrade4" type="text" id="lgrade4" size="10" maxlength="4" value="{{ $grading->lgrade4 ?? '' }}" class="form-control" /></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <th><div align="center">5</div></th>
                            <td><input name="grade41" type="text" id="grade41" size="10" maxlength="3" value="{{ $grading->grade41 ?? '' }}" class="form-control" /></td>
                            <td><div align="center">-</div></td>
                            <td><input name="grade42" type="text" id="grade42" size="10" maxlength="3" value="{{ $grading->grade42 ?? '' }}" class="form-control" /></td>
                            <td><input name="unit05" type="text" id="unit05" size="10" maxlength="4" value="{{ $grading->unit05 ?? '' }}" class="form-control" /></td>
                            <td><input name="lgrade5" type="text" id="lgrade5" size="10" maxlength="4" value="{{ $grading->lgrade5 ?? '' }}" class="form-control" /></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <th><div align="center">6</div></th>
                            <td><input name="grade51" type="text" id="grade51" size="10" maxlength="3" value="{{ $grading->grade51 ?? '' }}" class="form-control" /></td>
                            <td><div align="center">-</div></td>
                            <td><input name="grade52" type="text" id="grade52" size="10" maxlength="3" value="{{ $grading->grade52 ?? '' }}" class="form-control" /></td>
                            <td><input name="unit06" type="text" id="unit06" size="10" maxlength="4" value="{{ $grading->unit06 ?? '' }}" class="form-control" /></td>
                            <td><input name="lgrade6" type="text" id="lgrade6" size="10" maxlength="4" value="{{ $grading->lgrade6 ?? '' }}" class="form-control" /></td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                    </table>
                    <div class="card-footer text-right">
                                            <input class="btn btn-primary mr-1" type="submit" value="Update" />
                                            <!-- <input class="btn btn-secondary" type="reset" value="Reset" /> -->
                                        </div>
           </form>

                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          
        </section>

        <!-- hidden table -->
        <div id="allGradingTable" style="display: none;">
        <table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="5"> <strong>Grading System</strong> </th>
        </tr>
        <tr>
            <th colspan="3">
                <div align="center">Score(%)</div>
            </th>
            <th width="25">
                <div align="center">Unit</div>
            </th>
            <th width="166">
                <div align="center">Grade</div>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="45">
                <div align="center">{{$grading->grade01}}</div>
            </td>
            <td width="7">
                <div align="center">-</div>
            </td>
            <td width="55">
                <div align="center">{{$grading->grade02}}</div>
            </td>
            <td>
                <div align="center">{{$grading->unit01}}</div>
            </td>
            <td>
                <div align="center">{{$grading->lgrade1}}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div align="center">{{$grading->grade11}}</div>
            </td>
            <td>
                <div align="center">-</div>
            </td>
            <td>
                <div align="center">{{$grading->grade12}}</div>
            </td>
            <td>
                <div align="center">{{$grading->unit02}}</div>
            </td>
            <td>
                <div align="center">{{$grading->lgrade2}}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div align="center">{{$grading->grade21}}</div>
            </td>
            <td>
                <div align="center">-</div>
            </td>
            <td>
                <div align="center">{{$grading->grade22}}</div>
            </td>
            <td>
                <div align="center">{{$grading->unit03}}</div>
            </td>
            <td>
                <div align="center">{{$grading->lgrade3}}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div align="center">{{$grading->grade31}}</div>
            </td>
            <td>
                <div align="center">-</div>
            </td>
            <td>
                <div align="center">{{$grading->grade32}}</div>
            </td>
            <td>
                <div align="center">{{$grading->unit04}}</div>
            </td>
            <td>
                <div align="center">{{$grading->lgrade4}}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div align="center">{{$grading->grade41}}</div>
            </td>
            <td>
                <div align="center">-</div>
            </td>
            <td>
                <div align="center">{{$grading->grade42}}</div>
            </td>
            <td>
                <div align="center">{{$grading->unit05}}</div>
            </td>
            <td>
                <div align="center">{{$grading->lgrade5}}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div align="center">{{$grading->grade51}}</div>
            </td>
            <td>
                <div align="center">-</div>
            </td>
            <td>
                <div align="center">{{$grading->grade52}}</div>
            </td>
            <td>
                <div align="center">{{$grading->unit06}}</div>
            </td>
            <td>
                <div align="center">{{$grading->lgrade6}}</div>
            </td>
        </tr>
    </tbody>
</table>
        </div>
</div>

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
function printAllStudents() {
    // Get the content of the hidden table
    var printContents = document.getElementById('allGradingTable').innerHTML;

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
                <title>Grading System</title>
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

