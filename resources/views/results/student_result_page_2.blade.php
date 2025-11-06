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
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="{{ asset('profile_pictures/'. 'blank.jpg') }}"  alt="Profile Picture"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello {{Auth::guard('student')->user()->student_full_name}}</div> 
              <a href="{{ route('student-account-setting', ['id' => Auth::guard('student')->user()->id]) }}" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
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
            <a href="{{route('admin-dashboard')}}"> <img alt="image" src="{{asset('dashboard/assets/img/logo.png')}}" class="header-logo" /> <span
                class="logo-name">E-Result</span>
            </a>
          </div>
           @include('partials.student-sidebar')
        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
        
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
                    <a href="{{route('student-result')}}"  class="btn btn-outline-primary">
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

                       
                        {{-- Student Info --}}
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title text-center font-weight-bold">
                                    {{ strtoupper("{$studentData['class']} Level {$semester} Semester Academic Report") }}
                                </h5>

                                <table class="table table-bordered align-middle">
                                    <tr>
                                        <td rowspan="4" style="width: 150px; text-align: center;">
                                            @php
                                                $imagePath = public_path('uploads/' . $studentData['studpicture'] . '.jpg');
                                                $imageUrl = file_exists($imagePath)
                                                    ? asset('uploads/' . $studentData['studpicture'] . '.jpg')
                                                    : asset('uploads/blank.jpg');
                                            @endphp

                                            <img 
                                                src="{{ $imageUrl }}" 
                                                alt="Student Picture" 
                                                class="img-thumbnail" 
                                                style="max-width: 130px;">
                                        </td>
                                        <th>Full Name:</th>
                                        <td>{{ $studentData['stusurname'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Matric No:</th>
                                        <td>{{ $studentData['stuno'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Level:</th>
                                        <td>{{ $studentData['class'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Programme:</th>
                                        <td>{{ $studentData['coursekeep'] }}</td>
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
                                                    <th style="color: white;">Average (100)</th>
                                                    <th style="color: white;">Grade</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Check if subjects data exists --}}
                                                @if(isset($studentData['subjects']) && is_array($studentData['subjects']) && count($studentData['subjects']) > 0)
                                                    @foreach ($studentData['subjects'] as $index => $subject)
                                                        @php
                                                            $score = $studentData['scores'][$index] ?? null;
                                                            $grade = $studentData['subjectGrades'][$index] ?? null;
                                                            $unit = $studentData['units'][$index] ?? null;
                                                            $code = $studentData['ctitles'][$index] ?? null;
                                                        @endphp

                                                        {{-- Display only if score is not 0 or null --}}
                                                        @if(!empty($subject) && $score > 0 && !empty($grade) && !empty($unit))
                                                            <tr>
                                                                <td style="font-size: 13px;">{{ $code }}</td>
                                                                <td style="text-align: left; font-size: 13px;">{{ $subject }}</td>
                                                                <td style="font-size: 13px;">{{ $unit }}</td>
                                                                <td style="font-size: 13px;">
                                                                    @if (floor($score) == $score)
                                                                        {{ (int) $score }}
                                                                    @else
                                                                        {{ $score }}
                                                                    @endif
                                                                </td>
                                                                <td style="font-size: 13px;">{{ $grade }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <tr><td colspan="5">No subjects available</td></tr>
                                                @endif
                                            </tbody>
                                        </table>


                                        {{-- GPA Summary --}}
                                        <div class="mt-4">
                                        <table class="table table-bordered table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>Total Grade Points:</strong></td>
                                                        <td style="font-size: 13px;">{{ $studentData['totalGradePoints'] }}</td>
                                                        <td style="font-size: 13px;"><strong>Remark:</strong></td>
                                                        <td style="font-size: 13px;"><span class="{{ $studentData['remarks'] === 'PASSED ALL' ? 'text-success' : 'text-danger' }}">{{ $studentData['remarks'] }} </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>Total Units:</strong></td>
                                                        <td style="font-size: 13px;">{{ $studentData['totalUnits'] }}</td>
                                                        <td style="font-size: 13px;"><strong>Grade:</strong></td>
                                                        <td style="font-size: 13px;">
                                                            @php
                                                                $cgpa = $studentData['totalCGPA'];
                                                            @endphp

                                                            @if($cgpa < 2.0)
                                                                <span class="badge bg-danger">Fail</span>
                                                            @elseif($cgpa >= 2.0 && $cgpa <= 2.49)
                                                                <span class="badge bg-warning text-dark">Pass</span>
                                                            @elseif($cgpa >= 2.5 && $cgpa <= 2.9)
                                                                <span class="badge bg-info text-dark">Lower Credit</span>
                                                            @elseif($cgpa >= 3.0 && $cgpa <= 3.49)
                                                                <span class="badge bg-primary">Upper Credit</span>
                                                            @elseif($cgpa >= 3.5 && $cgpa <= 4.0)
                                                                <span class="badge bg-success">Distinction</span>
                                                            @endif
                                                        </td>                                                         
                                                          
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>GPA(First):</strong></td>
                                                        <td style="font-size: 13px;">{{ $studentData['totalGPA'] ?? 'N/A' }}</td>
                                                        <td><strong></strong></td>
                                                        <td rowspan="2" style="text-align: center; font-size: 13px;"><img src="{{asset('signature/' . $hod->sign)}}" alt="Hod Signature" width="160" height="60"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>GPA(Second):</strong></td>
                                                        <td style="font-size: 13px;">{{ $studentData['totalGPA2'] ?? 'N/A' }}</td>
                                                        <td>&nbsp;</td>
                                                    </tr>                                
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>CGPA:</strong></td>
                                                        <td style="font-size: 13px;">{{ $studentData['totalCGPA'] ?? 'N/A' }}</td>
                                                        <td>&nbsp;</td>
                                                        <td style="text-align: center; font-size: 13px;">{{ $hod->hod_name }}</td>
                                                    </tr>
                                                    
                                                    @if (!empty($studentData['failedRemarks']))
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>Courses with Carryover:</strong></td>
                                                        <td colspan="3" style="font-size: 13px;">{{ $studentData['failedRemarks'] }}</td>
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
                                                            <th style="padding: 0.2rem; color: white;">Class</th>
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
                            
                        </div>

                       
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

                        {{-- Student Info --}}
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title text-center font-weight-bold">
                                    {{ strtoupper("{$studentData['class']} Level {$semester} Semester Academic Report") }}
                                </h5>

                                <table class="table table-bordered align-middle">
                                    <tr>
                                        <td rowspan="4" style="width: 150px; text-align: center;">
                                            @php
                                                $imagePath = public_path('uploads/' . $studentData['studpicture'] . '.jpg');
                                                $imageUrl = file_exists($imagePath)
                                                    ? asset('uploads/' . $studentData['studpicture'] . '.jpg')
                                                    : asset('uploads/blank.jpg');
                                            @endphp

                                            <img 
                                                src="{{ $imageUrl }}" 
                                                alt="Student Picture" 
                                                class="img-thumbnail" 
                                                style="max-width: 130px;">
                                        </td>
                                        <th>Full Name:</th>
                                        <td>{{ $studentData['stusurname'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Matric No:</th>
                                        <td>{{ $studentData['stuno'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Level:</th>
                                        <td>{{ $studentData['class'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Programme:</th>
                                        <td>{{ $studentData['coursekeep'] }}</td>
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
                                                    <th style="color: white;">Average (100)</th>
                                                    <th style="color: white;">Grade</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- Check if subjects data exists --}}
                                                @if(isset($studentData['subjects']) && is_array($studentData['subjects']) && count($studentData['subjects']) > 0)
                                                    @foreach ($studentData['subjects'] as $index => $subject)
                                                        @php
                                                            $score = $studentData['scores'][$index] ?? null;
                                                            $grade = $studentData['subjectGrades'][$index] ?? null;
                                                            $unit = $studentData['units'][$index] ?? null;
                                                            $code = $studentData['ctitles'][$index] ?? null;
                                                        @endphp

                                                        {{-- Display only if score is not 0 or null --}}
                                                        @if(!empty($subject) && $score > 0 && !empty($grade) && !empty($unit))
                                                            <tr>
                                                                <td style="font-size: 13px;">{{ $code }}</td>
                                                                <td style="text-align: left; font-size: 13px;">{{ $subject }}</td>
                                                                <td style="font-size: 13px;">{{ $unit }}</td>
                                                                <td style="font-size: 13px;">
                                                                    @if (floor($score) == $score)
                                                                        {{ (int) $score }}
                                                                    @else
                                                                        {{ $score }}
                                                                    @endif
                                                                </td>
                                                                <td style="font-size: 13px;">{{ $grade }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <tr><td colspan="5">No subjects available</td></tr>
                                                @endif
                                            </tbody>
                                        </table>


                                        {{-- GPA Summary --}}
                                        <div class="mt-4">
                                        <table class="table table-bordered table-sm">
                                                <tbody>
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>Total Grade Points:</strong></td>
                                                        <td style="font-size: 13px;">{{ $studentData['totalGradePoints'] }}</td>
                                                        <td style="font-size: 13px;"><strong>Remark:</strong></td>
                                                        <td style="font-size: 13px;"><span class="{{ $studentData['remarks'] === 'PASSED ALL' ? 'text-success' : 'text-danger' }}">{{ $studentData['remarks'] }} </span></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>Total Units:</strong></td>
                                                        <td style="font-size: 13px;">{{ $studentData['totalUnits'] }}</td>
                                                        <td style="font-size: 13px;"><strong>Grade:</strong></td>
                                                        <td style="font-size: 13px;">
                                                            @php
                                                                $cgpa = $studentData['totalCGPA'];
                                                            @endphp

                                                            @if($cgpa < 2.0)
                                                                <span class="badge bg-danger">Fail</span>
                                                            @elseif($cgpa >= 2.0 && $cgpa <= 2.49)
                                                                <span class="badge bg-warning text-dark">Pass</span>
                                                            @elseif($cgpa >= 2.5 && $cgpa <= 2.9)
                                                                <span class="badge bg-info text-dark">Lower Credit</span>
                                                            @elseif($cgpa >= 3.0 && $cgpa <= 3.49)
                                                                <span class="badge bg-primary">Upper Credit</span>
                                                            @elseif($cgpa >= 3.5 && $cgpa <= 4.0)
                                                                <span class="badge bg-success">Distinction</span>
                                                            @endif
                                                        </td>                                                         
                                                          
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>GPA(First):</strong></td>
                                                        <td style="font-size: 13px;">{{ $studentData['totalGPA'] ?? 'N/A' }}</td>
                                                        <td><strong></strong></td>
                                                        <td rowspan="2" style="text-align: center; font-size: 13px;"><img src="{{asset('signature/' . $hod->sign)}}" alt="Hod Signature" width="160" height="60"></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>GPA(Second):</strong></td>
                                                        <td style="font-size: 13px;">{{ $studentData['totalGPA2'] ?? 'N/A' }}</td>
                                                        <td>&nbsp;</td>
                                                    </tr>                                
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>CGPA:</strong></td>
                                                        <td style="font-size: 13px;">{{ $studentData['totalCGPA'] ?? 'N/A' }}</td>
                                                        <td>&nbsp;</td>
                                                        <td style="text-align: center; font-size: 13px;">{{ $hod->hod_name }}</td>
                                                    </tr>
                                                    
                                                    @if (!empty($studentData['failedRemarks']))
                                                    <tr>
                                                        <td style="font-size: 13px;"><strong>Courses with Carryover:</strong></td>
                                                        <td colspan="3" style="font-size: 13px;">{{ $studentData['failedRemarks'] }}</td>
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






