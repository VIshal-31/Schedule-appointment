<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
   <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    
    <title>@yield('title', 'Default Title')</title>

</head>
<body class="">

 <!-- nav bar -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#000;">
  <a class="navbar-brand" href="/">
    <img src="{{ asset('/logo/logo.png') }}" width="100">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" style="background: transparent !important;border: none;color: white;" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse d-flax justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav d-flex justify-content-center align-item-center">
      <li class="nav-item active">
        <a class="nav-link text-light" href="/">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="/aboutus">About Us</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-light" href="facebook.com" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Services
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Service</a>
          <a class="dropdown-item" href="#">Service 1</a>
          <a class="dropdown-item" href="#">Service 2</a>
        </div>
      </li>
   
    </ul>
  <button type="button" class="nav-item btn px-3 px-sm-3 px-md-3 px-lg-3  py-2 py-sm-2 py-md-2 py-lg-2  m-0 m-sm-0 m-md-0 m-lg-3" style="font-size: 18px;">Contact Us</button>
  </div>
</nav>

    @yield('slot')

<footer class= "bg-dark container-fluid p-5">
    <div class="row col-12">
    <div class="col-4">
        <div>
             <img src="{{ asset('/logo/logo.png') }}" width="200">
        </div>
    </div>
    <div class="col-4">
        <div class= "p-2 m-2 text-light">
          <ul>Services:</ul>
          <ul>Web Development</ul>
            <ul>UI / UX Design</ul>
            <ul>Digital Marketing</ul>
            <ul>App Development</ul>
        </div>
    </div>
    <div class="col-4">
        <div class= "p-2 m-2 text-light">
            <ul>Contact Details:</ul>
            <ul><a class="text-light" href="tel:8788365607">8788365607</a></ul>
            <ul><a class="text-light" href="mailto:vishal@webwideit.solutions">vishal@webwideit.solutions</a></ul>
            <ul><a class="text-light" href=""><img src="{{ asset('/logo/logo.png') }}" width="50"></a><a class="text-light" href=""><img src="{{ asset('/logo/logo.png') }}" width="50"></a><a class="text-light" href=""><img src="{{ asset('/logo/logo.png') }}" width="50"></a></ul>
          </div>
    </div>
    </div>
</footer>
</body>
</html>
