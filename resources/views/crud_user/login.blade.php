
@section('content')
    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Login</h3>
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.authUser') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Email" id="email" class="form-control" name="email" required
                                           autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Signin</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Sign In</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            .login-container {
                background-color: white;
                padding: 40px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                width: 350px;
                text-align: center;
            }

            h1 {
                font-size: 24px;
                margin-bottom: 30px;
                color: #333;
            }

            .divider {
                margin: 20px 0;
                color: #999;
                font-size: 14px;
                position: relative;
            }

            .divider::before,
            .divider::after {
                content: "";
                position: absolute;
                top: 50%;
                width: 40%;
                height: 1px;
                background-color: #ddd;
            }

            .divider::before {
                left: 0;
            }

            .divider::after {
                right: 0;
            }

            .form-group {
                margin-bottom: 20px;
                text-align: left;
            }

            label {
                display: block;
                margin-bottom: 8px;
                font-size: 14px;
                color: #555;
            }

            input[type="email"],
            input[type="password"] {
                width: 100%;
                padding: 12px;
                border: 1px solid #ddd;
                border-radius: 4px;
                box-sizing: border-box;
                font-size: 14px;
            }

            .remember-me {
                display: flex;
                align-items: center;
                margin-bottom: 20px;
                font-size: 14px;
                color: #555;
            }

            .remember-me input {
                margin-right: 8px;
            }

            .signin-btn {
                width: 100%;
                padding: 12px;
                background-color: #4285f4;
                color: white;
                border: none;
                border-radius: 4px;
                font-size: 16px;
                font-weight: bold;
                cursor: pointer;
                margin-bottom: 20px;
            }

            .signin-btn:hover {
                background-color: #357ae8;
            }

            .signup-link {
                font-size: 14px;
                color: #555;
                margin-bottom: 15px;
                display: block;
            }

            .signup-link a {
                color: #4285f4;
                text-decoration: none;
            }

            .forgot-password {
                font-size: 14px;
                color: #4285f4;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <h1>Sign In</h1>

            <div class="divider">or sign in with:</div>

            <form method="POST" action="{{ route('user.authUser') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required />
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                    />
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember" />
                    <label for="remember">Remember password.</label>
                </div>

                <button type="submit" class="signin-btn">Sign In</button>
            </form>

            <span class="signup-link">
                Don't have an account? <a href="{{ route('user.createUser') }}">Sign Up</a>
            </span>

            <a href="#" class="forgot-password">Forgot Password</a>
        </div>
    </body>
</html>