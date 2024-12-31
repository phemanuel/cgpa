<!DOCTYPE html>
<html lang="en">


<!-- errors-404.html  21 Nov 2019 04:05:02 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>E-Result</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('dashboard/assets/css/app.min.css')}}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('dashboard/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('dashboard/assets/css/components.css')}}">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="{{asset('dashboard/assets/css/custom.css')}}">
  <link rel='shortcut icon' type='image/x-icon' href="{{asset('dashboard/assets/img/favicon.png')}}" />
  <style>
    .page-under-development {
    text-align: center;
    background-color: #f8f9fa;
    padding: 50px 20px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  }

  .page-inner h1 {
    font-size: 3rem;
    font-weight: bold;
    color: #f39c12; /* Bright yellow for attention */
  }

  .page-description p {
    font-size: 1.2rem;
    color: #555;
    margin-top: 10px;
    margin-bottom: 20px;
  }

  .btn-primary {
    background-color: #3498db;
    color: white;
    padding: 10px 20px;
    font-size: 1.1rem;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease;
  }

  .btn-primary:hover {
    background-color: #2980b9;
  }

  img {
    max-width: 100%;
    height: auto;
  }

  .container {
    max-width: 1200px;
  }
  </style>
</head>

<body>
  
  <div id="app">
  <section class="section">
  <div class="container mt-5">
    <div class="page-under-development">
      <div class="page-inner">
        <h1 class="text-center">🚧 Under Development 🚧</h1>
        <div class="page-description text-center">
          <p>Oops! The page you're looking for is currently under construction. We're working hard to bring you something amazing!</p>
          <p>Stay tuned for updates!</p>
        </div>

        <!-- Under Development Image -->
        <div class="text-center mt-4">
          <img src="{{asset('dashboard/assets/img/development.jpg')}}" alt="Under Construction" class="img-fluid" style="max-width: 60%; height: auto;">
        </div>

        <!-- Redirect or Actions -->
        <div class="mt-3 text-center">
          <a href="{{ route('admin-dashboard') }}" class="btn btn-primary">Back to Home</a>
        </div>
      </div>
    </div>
  </div>
</section>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
</body>


<!-- errors-404.html  21 Nov 2019 04:05:02 GMT -->
</html>