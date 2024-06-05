<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <!-- <a class="navbar-brand" href="#">YourSiteName</a> -->
            <div class="text-center text-sm-start ms-4">
                <div class="main-logo">
                    <a href="index">
                    <img src="image/JISOONlogo.png" alt="logo" class="logo img-fluid">
                    </a>
                </div>
            </div>
            <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
            <div>
                <ul class="navbar-nav ms-auto me-5">
                    <li class="nav-item">
                        <a class="nav-link header-text" href="{{ route('index') }}">Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-4 pt-4">
                <div class="card mt-3 border-0">
                    <div class="header pt-5 pb-3 text-center">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body px-5 py-4">
                        <form method="post">
                            @csrf
                            <!-- @if ($errors->any())
                                <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                        <span>{{ $error }}</span>
                                        @endforeach
                                </div>
                            @endif -->
                            <div class="form-group">
                                <label for="email">Email</label> <br>
                                <input class="" type="email" name="email" id="email" placeholder="Enter your email" required> <br> <br>
                            </div>
                            <div class="form-group password-con">
                                <label for="password">Password</label> <br>
                                <input class="" type="password" name="password" id="password" placeholder="Enter your password" required>
                                <i class="fa-solid fa-eye-slash" id="show-password"></i>
                                <br>
                                <a class="float-end link" href="forgot-password.php">Forgot password?</a> <br> <br>
                            </div>
                            <div>
                                <button type="submit" class="py-2">Log in</button> <br> <br>
                            </div>
                            <div class="form-group">
                                <div class="text-center link">
                                    Don't have an account yet? <a href="{{ route('signup') }}">Sign up</a> <br>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const showPassword = document.querySelector("#show-password");
            const passwordField = document.querySelector("#password");

            showPassword.addEventListener("click", function() {
                this.classList.toggle("fa-eye-slash");
                this.classList.toggle("fa-eye", !this.classList.contains("fa-eye-slash"));
                const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
                passwordField.setAttribute("type", type);
            });

            @if($errors->any())
                // Message
                swal({
                    title: "Invalid email or password",
                    icon: "warning",
                    button: true,
                });
            @endif
        });
    </script>
</body>
</html>
