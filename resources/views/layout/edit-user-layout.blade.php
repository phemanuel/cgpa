<!DOCTYPE html>
<html lang="en">


<!-- basic-form.html  21 Nov 2019 03:54:41 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>E-Result :: Edit User</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('dashboard/assets/css/app.min.css')}}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('dashboard/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/assets/css/components.css')}}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{asset('dashboard/assets/css/custom.css')}}">
  <link rel='shortcut icon' type='image/x-icon' href="{{asset('dashboard/assets/img/favicon.png')}}" />
  <style>
    /* Success Alert */
    .alert.alert-success {
        background-color: #28a745; /* Green background color */
        color: #fff; /* White text color */
        padding: 10px; /* Padding around the text */
        border-radius: 5px; /* Rounded corners */
    }

    /* Error Alert */
    .alert.alert-danger {
        background-color: #dc3545; /* Red background color */
        color: #fff; /* White text color */
        padding: 10px; /* Padding around the text */
        border-radius: 5px; /* Rounded corners */
    }
</style>
<style type="text/css">
.style2 {
	color: #006600;
	font-weight: bold;
}
.style3 {font-weight: bold}
.style7 {color: #0000FF; font-weight: bold; }
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
            <a href="{{route('dashboard')}}"> <img alt="image" src="{{asset('dashboard/assets/img/logo.png')}}" class="header-logo" /> <span
                class="logo-name">E-Result</span>
            </a>
          </div>
          @include('partials.sidebar')
        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
          <div class="row">
                    <div class="col-12">
                      <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-dark text-white-all d-flex justify-content-between overflow-auto" style="white-space: nowrap;">
                  @if(auth()->user()->user_type_status == 1)
                  <li class="breadcrumb-item active">
                    <a href="{{route('admin-dashboard')}}"><i class="fas fa-home"></i> Dashboard</a>
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
                    <a href="{{route('admin-dashboard')}}"><i class="fas fa-home"></i> Dashboard</a>
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
                    <a href="{{route('admin-dashboard')}}"><i class="fas fa-home"></i> Dashboard</a>
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
                    <a href="{{route('admin-dashboard')}}"><i class="fas fa-home"></i> Dashboard</a>
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
            <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                  <h4>Edit User | <a href="{{route('users')}}">Users List</a> | <a href="{{route('instructors')}}">Instructors List</a></h4>
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
                  <div class="card-body">
                  <form action="{{ route('edit-user.action', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>User Status</label>
                        <select name="user_status" id="" class="form-control" required>
                            <option value="Active" {{ $user->user_status == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ $user->user_status == 'Inactive' ? 'selected' : '' }}>Inactive</option>                            
                        </select>
                    </div>
                @error('user_status')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror

                    <div class="form-group">
                        <label>User Type</label>
                        <select name="userType" id="" class="form-control" required>
                            <option value="Superadmin" {{ $user->user_type == 'Superadmin' ? 'selected' : '' }}>Superadmin</option>
                            <option value="Admin" {{ $user->user_type == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Instructor" {{ $user->user_type == 'Instructor' ? 'selected' : '' }}>Instructor</option>
                            <option value="Student" {{ $user->user_type == 'Student' ? 'selected' : '' }}>Student</option>
                        </select>
                    </div>
                @error('userType')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror

                @if($user->user_type_status == 3)
                <div class="form-group">
                    <label>Department</label>
                    <select name="department" id="department" class="form-control">
                        @if(isset($user->department))
                            <option value="{{ $user->department }}" selected>{{ $user->department }}</option>
                        @endif
                        @foreach($allDepartment as $d)
                            @if(!isset($user->department) || $user->department !== $d->dept_name)
                                <option value="{{ $d->dept_name }}">{{ $d->dept_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                @endif
                @error('department')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" disabled>
                    </div>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                    </div>
                    @error('last_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $user->first_name) }}" required>
                    </div>
                    @error('first_name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label>Password <span style="color:red;">(Leave blank if you are not changing the password.)</span></label>
                        <input type="password" class="form-control" name="password" value="" autocomplete="new-password">
                    </div>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" value="">
                    </div>

                    <div class="form-group">
                    <label>Profile Picture <span style="color:red;">(Leave blank if you are not uploading image.)</span></label>
                    <input type="file" class="form-control" name="image">
                    </div>
                    @error('image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                    <hr>
                    <h5>User Roles</h5>
                    <span class="style2">Module</span> : <span class="style7">Sub-module</span>
                    <table width="516" class="table table-bordered">
                        <tr>
                            <td width="31">
                                <input type="checkbox" name="classList" id="classList" {{ $user->class_list ? 'checked' : '' }} />
                            </td>
                            <td width="214">
                                <span class="style2"><i class="fas fa-list"></i> ClassList</span>
                            </td>
                            <td width="42">
                                <input name="courseSetup" type="checkbox" class="style3" id="courseSetup" {{ $user->course_setup ? 'checked' : '' }} />
                            </td>
                            <td width="209">
                                <span class="style2"><i class="fas fa-cogs"></i> Course Setup</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="scoreSheet" id="scoreSheet" {{ $user->score_sheet ? 'checked' : '' }} />
                            </td>
                            <td>
                                <span class="style2"><i class="fas fa-chart-bar"></i> Score Sheet</span>
                            </td>
                            <td>
                                <input name="gradingSystem" type="checkbox" id="gradingSystem" {{ $user->grading_system ? 'checked' : '' }} />
                            </td>
                            <td>
                                <span class="style2"><i class="fas fa-ruler"></i> Grading System</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="transcript" id="transcript" {{ $user->transcript ? 'checked' : '' }} />
                            </td>
                            <td>
                                <span class="style2"><i class="fas fa-file-signature"></i> Transcript Request</span>
                            </td>
                            <td>
                                <input name="hodSetup" type="checkbox" id="hodSetup" {{ $user->hod_setup ? 'checked' : '' }} />
                            </td>
                            <td>
                                <span class="style2"><i class="fas fa-user-tie"></i> Hod Setup</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="result" id="result" {{ $user->result ? 'checked' : '' }} />
                            </td>
                            <td>
                                <span class="style2"><i class="fas fa-file-alt"></i> Result Module</span>
                            </td>
                            <td>
                                <input type="checkbox" name="accessSetup" id="accessSetup" {{ $user->access_setup ? 'checked' : '' }} />
                            </td>
                            <td>
                                <span class="style2"><i class="fas fa-unlock"></i> Access Setup</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="resultEntry" id="resultEntry" {{ $user->result_entry ? 'checked' : '' }} />
                            </td>
                            <td>
                                <span class="style7"><i class="fas fa-keyboard"></i> Result Entry</span>
                            </td>
                            <td>
                                <input type="checkbox" name="admins" id="admins" {{ $user->admins ? 'checked' : '' }} />
                            </td>
                            <td>
                                <span class="style7"><i class="fas fa-user-shield"></i> Admins</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="resultCompute" id="resultCompute" {{ $user->result_compute ? 'checked' : '' }} />
                            </td>
                            <td>
                                <span class="style7"><i class="fas fa-calculator"></i> Result Compute</span>
                            </td>
                            <td>
                                <input type="checkbox" name="instructors" id="instructors" {{ $user->instructors ? 'checked' : '' }} />
                            </td>
                            <td>
                                <span class="style7"><i class="fas fa-chalkboard-teacher"></i> Instructors</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="semesterResult" id="semesterResult" {{ $user->semester_result ? 'checked' : '' }} />
                            </td>
                            <td>
                                <span class="style7"><i class="fas fa-clipboard"></i> Semester Result</span>
                            </td>
                            <td>
                                <input type="checkbox" name="students" id="students" {{ $user->students ? 'checked' : '' }} />
                            </td>
                            <td>
                                <span class="style7"><i class="fas fa-user-graduate"></i> Students</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="semesterSummary" id="semesterSummary" {{ $user->semester_summary ? 'checked' : '' }} />
                            </td>
                            <td>
                                <span class="style7"><i class="fas fa-chart-line"></i> Semester Result Summary</span>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="cgpaSummary" id="cgpaSummary" {{ $user->cgpa_summary ? 'checked' : '' }} />
                            </td>
                            <td>
                                <span class="style7"><i class="fas fa-graduation-cap"></i> CGPA Summary</span>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="studentTranscript" id="studentTranscript" {{ $user->student_transcript ? 'checked' : '' }} />
                            </td>
                            <td>
                                <span class="style7"><i class="fas fa-file-signature"></i> Transcript</span>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <input name="student" type="checkbox" id="student" {{ $user->student ? 'checked' : '' }} />
                            </td>
                            <td>
                                <span class="style2"><i class="fas fa-user-graduate"></i> Student Module</span>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <input name="studentRegistration" type="checkbox" id="studentRegistration" {{ $user->student_registration ? 'checked' : '' }} />
                            </td>
                            <td>
                                <span class="style7"><i class="fas fa-user-plus"></i> Student Registration</span>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <input name="studentMigration" type="checkbox" id="studentMigration" {{ $user->student_migration ? 'checked' : '' }} />
                            </td>
                            <td>
                                <span class="style7"><i class="fas fa-exchange-alt"></i> Student Migration</span>
                            </td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>

                  
                    <div class="card-footer text-right">
                      <input type="hidden" name="email" value="{{$user->email}}">
                        <input class="btn btn-primary mr-1" type="submit" value="Update" />
                        <!-- <input class="btn btn-secondary" type="reset" value="Reset" /> -->
                    </div>
                </form>

                  
                </div>               

              </div>
            </div>
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


<!-- basic-form.html  21 Nov 2019 03:54:41 GMT -->
</html>