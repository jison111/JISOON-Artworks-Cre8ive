<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-4 pt-4">
                <div class="card mt-4 border-0">
                    <div class="header pt-4 pb-2 text-center">
                        <h3>Signup</h3>
                    </div>
                    <div class="card-body px-5 py-4">
                        @if(session('signup_success'))
                            <div class="alert alert-success" role="alert">
                                Signup Successful. You can now log in.
                            </div>
                        @endif
                        <form action="{{ route('signup') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label> <br>
                                <input type="text" id="name" name="name" placeholder="Enter your name" required> <br>
                            </div>
                            <div class="form-group mt-3">
                                <label for="email">Email</label> <br>
                                <input class="" type="email" name="email" id="email" placeholder="Enter your email" required> <br>
                            </div>
                            <div class="form-group mt-3">
                                <label for="password">Password</label> <br>
                                <input class="" type="password" name="password" id="password" placeholder="Enter your password" required>
                                <br> <br>
                            </div>
                            <div>
                                <button class="py-2" type="submit">Signup</button> <br> <br>
                            </div>
                                Already have an account? <a href="{{ route('login') }}">Login</a> <br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
