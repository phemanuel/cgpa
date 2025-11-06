<!DOCTYPE html>
<html lang="en">


<!-- basic-form.html  21 Nov 2019 03:54:41 GMT -->
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
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="{{ asset('profile_pictures/'. 'blank.jpg') }}"  alt="Profile Picture"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello {{Auth::guard('student')->user()->student_full_name}}</div> 
              <a href="{{ route('account-setting', ['id' => Auth::guard('student')->user()->id]) }}" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Account Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="{{route('student-logout')}}" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
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
          @include('partials.student-sidebar')
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
                    <a href="{{ route('student-account-setting', ['id' => Auth::guard('student')->user()->id]) }}"><i class="fas fa-cogs"></i> Account Setting</a>
                  </li>   
                  <li class="breadcrumb-item">
                    <a href="{{route('contact-us')}}"><i class="fas fa-mail"></i> Contact Us</a>
                  </li> 
                        </ol>
                      </nav>
                    </div>
                  </div>
            <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header d-flex justify-content-between align-items-center">
                      <h4 class="mb-0">Result Checker</h4>
                      <!-- Button -->
                        
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
                  <form action="" method="GET">
                    <!-- @csrf  -->

                    <div class="form-group">
                        <label>Programme</label>
                        <select name="programme" id="programme" class="form-control">   
                                <option value="{{ Auth::guard('student')->user()->course }}">{{ Auth::guard('student')->user()->course }}</option>                            
                        </select>
                    </div>
                    @error('programme')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label>Admission Year</label>
                        <select name="acad_session" id="acad_session" class="form-control">   
                                <option value="{{ Auth::guard('student')->user()->admission_year }}">{{ Auth::guard('student')->user()->admission_year }}</option>                            
                        </select>
                    </div>
                    @error('acad_session')
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
                        <select name="semester" id="semester" class="form-control">
                                <option value="FIRST">FIRST</option>
                                <option value="SECOND">SECOND</option>                           
                        </select>
                    </div>
                    @error('semester')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror

                    <div class="card-footer text-right">
                    <!-- <button type="submit" class="btn btn-primary mr-1">
                        <i class="fas fa-arrow-right"></i> Proceed                    </button> -->
                   
                   <a href="#" class="btn btn-info mr-1" id="previewBtn">
                    <i class="fas fa-eye"></i> Preview Result
                    </a>
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


  <!-- Summary Modal -->
<div class="modal fade" id="summaryModal" tabindex="-1" aria-labelledby="summaryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="summaryModalLabel">Result Entry Summary</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
          <!-- Academic Session Selector -->
          <div class="mb-3">
              <label for="sessionFilter" class="mr-2">Select Session</label>
              <select id="sessionFilter" name="session1" class="form-control">
                  <option value="">-- Select Academic Session --</option>
                  @php $currentYear = date('Y'); @endphp
                  @for ($year = 2018; $year <= $currentYear; $year++)
                      <option value="{{ $year }}">{{ $year }}</option>
                  @endfor
              </select>
          </div>

          <!-- Results content -->
          <div id="summaryContent" class="mt-3">
              <div class="text-center p-3">
                  <i class="fa fa-info-circle"></i> Select a session to view summary
              </div>
          </div>
      </div>
    </div>
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
    document.getElementById('previewBtn').addEventListener('click', function(e) {
        e.preventDefault(); // Prevent default anchor behavior
        console.log('Preview button clicked'); // Debugging line

        // Get the selected parameters (check if the element exists)
        const programme = document.getElementById('programme');
        const acadSession = document.getElementById('acad_session');
        const stdLevel = document.getElementById('stdLevel');
        const semester = document.getElementById('semester');

        // Ensure the elements exist before trying to get their values
        if (!programme || !acadSession || !stdLevel || !semester) {
            console.error('One or more elements not found!');
            return;
        }

        // Log the selected values to debug
        console.log(`Programme: ${programme.value}, Session: ${acadSession.value}, Level: ${stdLevel.value}, Semester: ${semester.value}`);

        // Construct the URL dynamically
        const url = `{{ route('student-result-preview') }}?programme=${programme.value}&acad_session=${acadSession.value}&stdLevel=${stdLevel.value}&semester=${semester.value}`;

        // Log the constructed URL
        console.log('Constructed URL:', url);

        // Redirect the user to the generated URL
        window.location.href = url;
    });
</script>

<script>
$(document).on('change', '#sessionFilter', function() {
    let session = $(this).val();

    if (!session) {
        $('#summaryContent').html('<div class="alert alert-warning">Please select a session.</div>');
        return;
    }

    $('#summaryContent').html('<div class="text-center p-3"><i class="fa fa-spinner fa-spin"></i> Loading...</div>');

    $.ajax({
        url: "{{ route('admin.results.summary') }}",
        type: "GET",
        data: { session1: session },
        success: function(response) {
            $('#summaryContent').html(response);
        },
        error: function(xhr) {
            console.log(xhr.responseText);
            $('#summaryContent').html('<div class="alert alert-danger">Unable to load summary.</div>');
        }
    });
});
</script>
