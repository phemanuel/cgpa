<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('pageTitle')</title>
  <link rel="stylesheet" href="{{ asset('dashboard/assets/css/app.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/assets/css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('dashboard/assets/css/custom.css') }}">
  <link rel="shortcut icon" href="{{ asset('dashboard/assets/img/favicon.png') }}">
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
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      @include('partials.navbar')
      @include('partials.sidebar')
      
      <div class="main-content">
      @yield('content')
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
</html>
