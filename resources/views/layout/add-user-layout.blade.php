<!DOCTYPE html>
<html lang="en">


<!-- basic-form.html  21 Nov 2019 03:54:41 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('pageTitle')</title>
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
                    <h4>Add User | <a href="{{route('users')}}">Users List</a> | <a href="{{route('instructors')}}">Instructors List</a></h4>
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
                <form id="registerForm" action="{{route('add-user.action')}}" method="post" enctype="multipart/form-data">
                      @csrf   
                      
                      <div class="form-group">
                    <label>User Status</label>
                    <select name="user_status" id="" class="form-control" required>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>                       
                    </select>
                </div>
                @error('user_status')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                      <div class="form-group">
                    <label>User Type</label>
                    <select name="userType" id="userType" class="form-control" required>
                      @if(auth()->user()->user_type_status == 1)
                        <option value="Superadmin">Superadmin</option>
                        @endif
                        <option value="Admin">Admin</option>
                        <!-- <option value="Instructor">Instructor</option> -->
                        <!-- <option value="Student">Student</option> -->
                    </select>
                </div>
                @error('userType')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror

                <div class="form-group" id="departmentContainer" style="display: none;">
                    <label>Department</label>
                    <select name="department" id="department" class="form-control">
                        @foreach($allDepartment as $d)
                            <option value="{{$d->dept_name}}">{{$d->dept_name}}</option>
                        @endforeach
                    </select>
                </div>
                @error('department')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                </div>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
                </div>
                @error('last_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>
                </div>
                @error('first_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label>Phone No</label>
                    <input type="text" class="form-control" name="phone_no" value="{{ old('phone_no') }}" required>
                </div>
                @error('phone_no')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label>Password (Minimum of 8 characters)</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                    <span id="passwordError" class="text-danger" style="display: none;"></span>
                </div>
                
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="" required>
                </div>

                <!-- Show Password Toggle -->
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="showPasswordToggle">
                    <label class="form-check-label" for="showPasswordToggle">Show Password</label>
                </div>

                <div class="form-group">
                    <label>Profile Picture(Optional)</label>
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
                      <td width="31"><input type="checkbox" name="classList" id="classList" /></td>
                      <td width="214"><span class="style2"><i class="fas fa-list"></i> ClassList</span></td>
                      <td width="42"><input name="courseSetup" type="checkbox" class="style3" id="courseSetup" /></td>
                      <td width="209"><span class="style2"><i class="fas fa-cogs"></i> Course Setup</span></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="scoreSheet" id="scoreSheet" /></td>
                      <td><span class="style2"><i class="fas fa-chart-bar"></i> Score Sheet</span></td>
                      <td><input name="gradingSystem" type="checkbox" id="gradingSystem" /></td>
                      <td><span class="style2"><i class="fas fa-ruler"></i> Grading System</span></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="transcript" id="transcript" /></td>
                      <td><span class="style2"><i class="fas fa-file-signature"></i>Transcript Request</span></td>
                      <td><input name="hodSetup" type="checkbox" id="hodSetup" /></td>
                      <td><span class="style2"><i class="fas fa-user-tie"></i> Hod Setup</span></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="result" id="result" /></td>
                      <td><span class="style2"><i class="fas fa-file-alt"></i> Result Module</span></td>
                      <td><input type="checkbox" name="accessSetup" id="accessSetup" /></td>
                      <td><span class="style2"><i class="fas fa-unlock"></i> Access Setup</span></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="resultEntry" id="resultEntry" /></td>
                      <td><span class="style7"><i class="fas fa-keyboard"></i> Result Entry</span></td>
                      <td><input type="checkbox" name="admins" id="admins" /></td>
                      <td><span class="style7"><i class="fas fa-user-shield"></i> Admins</span></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="resultCompute" id="resultCompute" /></td>
                      <td><span class="style7"><i class="fas fa-calculator"></i> Result Compute</span></td>
                      <td><input type="checkbox" name="instructors" id="instructors" /></td>
                      <td><span class="style7"><i class="fas fa-chalkboard-teacher"> Instructors</span></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="semesterResult" id="semesterResult" /></td>
                      <td><span class="style7"><i class="fas fa-clipboard"></i> Semester Result</span></td>
                      <td><input type="checkbox" name="students" id="students" /></td>
                      <td><span class="style7"><i class="fas fa-user-graduate"> Students</span></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="semesterSummary" id="semesterSummary" /></td>
                      <td><span class="style7"><i class="fas fa-chart-line"></i> Semester Result Summary</span></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="cgpaSummary" id="cgpaSummary" /></td>
                      <td><span class="style7"><i class="fas fa-graduation-cap"></i> CGPA Summary</span></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="studentTranscript" id="studentTranscript" /></td>
                      <td><span class="style7"><i class="fas fa-file-signature"></i>Transcript</span></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><input name="student" type="checkbox" id="student" /></td>
                      <td><span class="style2"><i class="fas fa-user-graduate"></i> Student Module</span></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><input name="studentRegistration" type="checkbox" id="studentRegistration" /></td>
                      <td><span class="style7"><i class="fas fa-user-plus"></i> Student Registration</span></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><input name="studentMigration" type="checkbox" id="studentMigration" /></td>
                      <td><span class="style7"><i class="fas fa-exchange-alt"></i> Student Migration</span></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>


                  </div>
                  <div class="card-footer text-right"> 
                    <input class="btn btn-primary mr-1" type="submit" value="Submit"></input>
                    <!-- <input class="btn btn-secondary" type="reset" value="Reset"></input> -->
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

<script>
    document.getElementById('registerForm').addEventListener('submit', function (e) {
        const password = document.getElementById('password').value;
        const errorSpan = document.getElementById('passwordError');

        if (password.length < 8) {
            e.preventDefault(); // Prevent form from submitting
            errorSpan.textContent = 'Password must be at least 8 characters long.';
            errorSpan.style.display = 'block';
        } else {
            errorSpan.style.display = 'none'; // Hide error if valid
        }
    });
</script>

<script>
    // Wait for the DOM to be ready
    document.addEventListener('DOMContentLoaded', function () {
        // Get the userType select element and the department container
        var userTypeSelect = document.getElementById('userType');
        var departmentContainer = document.getElementById('departmentContainer');

        // Event listener to check changes in the userType select
        userTypeSelect.addEventListener('change', function () {
            if (userTypeSelect.value === 'Instructor') {
                departmentContainer.style.display = 'block';  // Show department dropdown if Instructor
            } else {
                departmentContainer.style.display = 'none';   // Hide department dropdown for other user types
            }
        });

        // Initial check on page load to ensure correct visibility
        if (userTypeSelect.value !== 'Instructor') {
            departmentContainer.style.display = 'none';
        } else {
            departmentContainer.style.display = 'block';
        }
    });
</script>
<script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const form = document.getElementById('registerForm');
                        const passwordInput = document.getElementById('password');
                        const passwordError = document.getElementById('passwordError');

                        form.addEventListener('submit', function (e) {
                            const password = passwordInput.value;

                            if (password.length < 8) {
                                e.preventDefault(); // Stop form submission
                                passwordError.textContent = 'Password must be at least 8 characters long.';
                                passwordError.style.display = 'block';
                                passwordInput.focus(); // 👈 Focus the field
                            } else {
                                passwordError.style.display = 'none';
                            }
                        });
                    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const showPasswordToggle = document.getElementById('showPasswordToggle');
        const passwordField = document.getElementById('password');
        const confirmPasswordField = document.getElementById('password_confirmation');

        showPasswordToggle.addEventListener('change', function () {
            const type = this.checked ? 'text' : 'password';
            passwordField.type = type;
            confirmPasswordField.type = type;
        });
    });
</script>