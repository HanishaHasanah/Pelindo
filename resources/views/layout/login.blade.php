<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SB Admin 2 - Login</title>

    <!-- Fonts & Styles -->
    <link href="{{ asset('tamplate/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('tamplate/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <!-- Centered Login Card -->
    <div class="min-vh-100 d-flex justify-content-center align-items-center">
        <div class="card o-hidden border-0 shadow-lg" style="max-width: 900px; width: 100%;">
            <div class="card-body p-0">
                <div class="row" style="height: 100%;">
                    <!-- Gambar -->
                    <div class="col-lg-6 d-none d-lg-block p-0">
                        <img src="{{ asset('tamplate/img/img_login.jpg') }}" 
                             alt="Login Image" 
                             class="img-fluid h-100 w-100" 
                             style="object-fit: cover;">
                    </div>

                    <!-- Form Login -->
                    <div class="col-lg-6">
                        <div class="p-5 d-flex flex-column justify-content-center h-100">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                            </div>
                            <form class="user" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user"
                                        placeholder="Enter Email Address...">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user"
                                        placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                <hr>
                                <a href="#" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Login with Google
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="#">Forgot Password?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Scripts -->
    <script src="{{ asset('tamplate/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('tamplate/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('tamplate/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('tamplate/js/sb-admin-2.min.js') }}"></script>
</body>
</html>
