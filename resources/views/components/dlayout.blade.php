<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title1', 'Default Title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Your Custom CSS -->
    <!-- <link href="styles.css" rel="stylesheet"> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Chart.js (if using charts) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


</head>
<body style="padding-bottom:12vh;">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/dashboard">Dashboard</a>
        <!-- Navigation items -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                 @csrf
             <button class="btn bg-light" type="submit">Logout</button>
            </form>

                
            </li>
            
            <!-- Add more navigation items -->
        </ul>
    </nav>

    <!-- Content -->
    <div class="container-fluid">
        <div class="row mt-4">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <!-- Sidebar content -->
                        <a href="{{ route('dashboard.enquire') }}"><ul class="list-group">
                            <li class="list-group-item">New Enquire</li>
                            <!-- Add more sidebar items -->
                        </ul></a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- Sidebar content -->
                        <a href="{{ route('dashboard.shop') }}"><ul class="list-group">
                            <li class="list-group-item">Shop Details</li>
                            <!-- Add more sidebar items -->
                        </ul></a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- Sidebar content -->
                        <a href="{{ route('dashboard.categories') }}"><ul class="list-group">
                            <li class="list-group-item">Category</li>
                            <!-- Add more sidebar items -->
                        </ul></a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- Sidebar content -->
                        <a href="{{ route('dashboard.services') }}"><ul class="list-group">
                            <li class="list-group-item">Service</li>
                            <!-- Add more sidebar items -->
                        </ul></a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- Sidebar content -->
                        <a href="{{ route('dashboard.calendar') }}"><ul class="list-group">
                            <li class="list-group-item">Calendar</li>
                            <!-- Add more sidebar items -->
                        </ul></a>
                    </div>
                </div>
            </div>
            <!-- Main Content Area -->
            @yield('dslot')
        </div>
    </div>
    </div>

    <div class="bg-dark col-12 m-0 p-0 fixed-bottom d-flex align-items-center justify-content-center" style="height:5vh;"><a class="text-light" href="https://webwideit.solutions/" target="_blank">Webwide It Solutions</a></div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
