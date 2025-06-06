<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>E-Result :: Instructors</title>
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
            <li class="dropdown active">
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
            <li class="dropdown active">
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
                      <h4 class="card-title">Assigned Course/s - {{$instructor->count()}}</h4>
                      <span><strong></strong></span>
                      <div class="progress mt-1 mb-1" data-height="8">
                        <div class="progress-bar l-bg-purple" role="progressbar" data-width="{{$instructor->count()}}" aria-valuenow="{{$instructor->count()}}"
                          aria-valuemin="0" aria-valuemax="{{$instructor->count()}}"></div>
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
                  <h4><span style="color:green;">
                  <img 
                                    alt="Profile Picture" 
                                    src="{{ file_exists(public_path('profile_pictures/' . $instructorInfo->image)) ? asset('profile_pictures/' . $instructorInfo->image) : asset('uploads/blank.jpg') }}" 
                                    class="user-img-radious-style" 
                                    width="50" 
                                    height="50">   
                  {{$instructorInfo->last_name . ' ' . $instructorInfo->first_name}}</span>  
                  Assigned Course/s | <a href="{{route('instructors')}}">Instructor List</a> | 
                  <a href="javascript:void(0)" onclick="printAllUsers()" class="btn btn-outline-primary">
        <i class="fas fa-print"></i> Print
    </a></h4>
                  <div class="card-header-form">
                    <form>                    
                      <div class="input-group">
                      <button type="button" class="btn btn-primary" data-toggle="modal"
                      data-target=".bd-example-modal-lg"><i class="fas fa-user-plus"></i> Assign Course</button>
                        
                      </div>
                    </form>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                  <table class="table table-bordered" id="allUsersTable">
                  <thead>
                          <tr>
                              <th>#</th>             
                              <th>Department</th>
                              <th>Programme</th>
                              <th>Level</th>
                              <th>Semester</th>
                              <th>Academic Session</th>
                              <th>Course</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          @if ($instructor->count() > 0)
                              @foreach ($instructor as $key => $i)
                              <tr> 
                                  <td>{{ $key + 1 }}</td> 
                                  <td>{{ $i->department }}</td>
                                  <td>{{ $i->programme }}</td>
                                  <td>{{ $i->level}}</td>
                                  <td>{{ $i->semester}}</td>
                                  <td>{{ $i->session1}}</td>
                                  <td>{{ $i->course_title . ' - ' . $i->course_code}}</td>                                  
                                  <td>
                                      <a href="{{route('instructor-unassign', ['id' => $i->id])}}" class="btn btn-outline-danger">
                                      <i class="fas fa-user-minus"></i> Unassign</i>
                                      </a>
                                                                        
                                  </td>                                    
                                </tr>  
                              @endforeach
                          @else
                          <tr>
                              <td colspan="5">No course/s assigned to this instructor.</td>
                          </tr>
                          @endif                                   
                      </tbody>
                  </table>
                    {{ $instructor->links() }}
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          
        </section>        

       <!-- Large modal -->
       <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Assign Course for 
                  <span style="color:green;">{{$instructorInfo->last_name}} {{$instructorInfo->first_name}}</span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- Content goes here.... -->
                <form action="{{route('instructor-assign.action')}}" method="POST">
                    @csrf   
                    @php
                        $startYear = 2018;
                        $currentYear = date('Y');
                        $endYear = $currentYear + 1; // Include the current year in the loop
                    @endphp

                    <div class="form-group">
                        <label>Academic Session</label>
                        <select name="acadSession" id="acadSession" class="form-control" required>
                            <option value="">Select Academic Session</option>
                            @for ($year = $startYear; $year < $endYear; $year++)
                                @php
                                    $nextYear = $year + 1;
                                @endphp
                                <option value="{{ $year }}/{{ $nextYear }}">{{ $year }}/{{ $nextYear }}</option>
                            @endfor
                        </select>
                    </div>
                    @error('acadSession')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror                
                    <div class="form-group">
                        <label>Department</label>
                        <select name="department" id="department" class="form-control" required>
                        <option value="">Select Department</option> 
                          <!-- <option value="{{$instructorInfo->department}}">{{$instructorInfo->department}}</option> -->
                        <option value="">Select Department</option> 
                            @foreach($allDepartment as $department)
                                <option value="{{$department->dept_name}}">{{$department->dept_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('department')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <label>Programme</label>
                        <select name="programme" id="programme" class="form-control">
                            <option value="">Select a programme</option>
                        </select>
                    </div>
                    @error('programme')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror                   

                    <div class="form-group">
                        <label>Academic Level</label>
                        <select name="stdLevel" id="stdLevel" class="form-control">                            
                            <!-- Loop through levels -->
                            @foreach($allLevel as $d)
                                <option value="{{ $d->level }}">{{ $d->level }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('stdLevel')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror   
                    
                    <div class="form-group">
                        <label>Semester</label>
                        <select name="semester" id="semesterDropdown" class="form-control"> 
                        <option value="">Select Semester</option> 
                                <option value="FIRST">FIRST</option> 
                                <option value="SECOND">SECOND</option>                          
                        </select>
                    </div>
                    @error('semester')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    
                    <div class="form-group">
                        <label>Available Courses</label>
                        <select name="courseId" id="courseDropdown" class="form-control">                            
                                <option value=""></option>                            
                        </select>
                    </div>
                    @error('course')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror   

                    <div class="modal-footer bg-whitesmoke br">
                        <input type="hidden" name="instructorId" value="{{ $instructorInfo->id }}">
                        <button type="submit" class="btn btn-primary">Assign</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>                   
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Hidden table for printing -->
        <div id="printableTable" style="display: none;">
         <h4>Assigned Course/s for {{$instructorInfo->last_name . ' ' . $instructorInfo->first_name}}</h4>
         <table class="table table-striped">
                  <thead>
                          <tr>
                              <th>#</th>             
                              <th>Department</th>
                              <th>Programme</th>
                              <th>Level</th>
                              <th>Semester</th>
                              <th>Academic Session</th>
                              <th>Course</th>                              
                          </tr>
                      </thead>
                      <tbody>
                          @if ($instructor->count() > 0)
                              @foreach ($instructor as $key => $i)
                              <tr> 
                                  <td>{{ $key + 1 }}</td> 
                                  <td>{{ $i->department }}</td>
                                  <td>{{ $i->programme }}</td>
                                  <td>{{ $i->level}}</td>
                                  <td>{{ $i->semester}}</td>
                                  <td>{{ $i->session1}}</td>
                                  <td>{{ $i->course_title . ' - ' . $i->course_code}}</td> 
                                </tr>  
                              @endforeach
                          @else
                          <tr>
                              <td colspan="5">No course/s assigned to this instructor.</td>
                          </tr>
                          @endif                                   
                      </tbody>
                  </table>
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
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<!-- <script src="{{asset('js/jquery-3.5.1.min.js') }}"></script> -->
<script>
function printAllUsers() {
    // Get the content of the hidden table
    var printContents = document.getElementById('printableTable').innerHTML;

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
                <title>Assigned Course/s</title>
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
<script>
    $(document).ready(function () {
        // Listen for changes on the semester dropdown
        $('select[name="semester"]').on('change', function () {
            // Get selected values
            let department = $('select[name="department"]').val();
            let programme = $('select[name="programme"]').val();
            let stdLevel = $('select[name="stdLevel"]').val();
            let semester = $(this).val(); // Current semester selection

            // Log the selected values for debugging
            console.log("Selected Values:");
            console.log("Department:", department);
            console.log("Programme:", programme);
            console.log("Student Level:", stdLevel);
            console.log("Semester:", semester);

            // Check if all fields are selected
            if (department && programme && stdLevel && semester) {
                console.log("All fields selected. Sending AJAX request...");
                // Send AJAX request
                $.ajax({
                    url: "{{ route('get-courses') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        department: department,
                        programme: programme,
                        stdLevel: stdLevel,
                        semester: semester,
                    },
                    success: function (data) {
                        console.log("AJAX request successful. Data received:");
                        console.log(data);

                        // Clear previous options
                        let courseDropdown = $('#courseDropdown');
                        courseDropdown.empty();
                        courseDropdown.append('<option value="">Select a course</option>');

                        // Populate with new options
                        $.each(data, function (key, course) {
                            courseDropdown.append('<option value="' + course.id + '">' + course.course_title + ' - ' + course.course_code + '</option>');
                        });
                    },
                    error: function (xhr) {
                        console.error("AJAX request failed. Error:");
                        console.error(xhr.responseText);
                    },
                });
            } else {
                console.log("Missing fields. Clearing the dropdown...");
                // Clear the dropdown if any field is missing
                $('#courseDropdown').empty().append('<option value="">Select a course</option>');
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#department').on('change', function () {
            let department = $(this).val();

            // Clear the programme dropdown
            $('#programme').empty().append('<option value="">Select a programme</option>');

            if (department) {
                $.ajax({
                    url: "{{ route('get-programmes') }}", // Define route in web.php
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        department: department
                    },
                    success: function (data) {
                        // Populate the programme dropdown
                        $.each(data, function (key, programme) {
                            $('#programme').append('<option value="' + programme.dept_name + '">' + programme.dept_name + '</option>');
                        });
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
