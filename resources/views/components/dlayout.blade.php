<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title1', 'Default Title')</title>
    <!-- Bootstrap CSS -->
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Your Custom CSS -->
    <link href="styles.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Chart.js (if using charts) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Dashboard</a>
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
                        <a href="{{ route('dashboard.requests') }}"><ul class="list-group">
                            <li class="list-group-item">New Request</li>
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
            </div>
            <!-- Main Content Area -->
            @yield('dslot')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
