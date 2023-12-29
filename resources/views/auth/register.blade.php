<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration Page</title>
  <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex justify-content-center align-items-center" style="height:100vh;">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title text-center">Register</h2>
            <form id="registerForm" method="POST" action="{{ route('register') }}">
            @csrf
              <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
              </div>
              <div class="form-group text-center">
                <p>Already have an account? <a href="/login">Login here</a></p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS (Optional - for some features that require JS) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
