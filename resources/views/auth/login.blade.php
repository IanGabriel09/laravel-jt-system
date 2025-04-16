<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- CSS, Bootstrap, and BS icons hosted by VITE --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css', 'resources/css/styles.css']) 

    <title>{{ config('app.name') }}</title>
</head>
<body>
    <div class="container">
        <div class="h-100 d-flex justify-content-center align-items-center">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="bg-white p-5 bg-custom rounded auth-form"> 

                    <h3 class="text-center fw-bold">Sign In</h3>
                    <div class="mb-3">
                        <label for="">ID Number:</label>
                        <input type="text" name="id_num" id="id_num" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="">Password:</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <!-- Display session messages (success, error, etc.) -->
                    @if (session('message'))
                        <p class="text-success"><i>{{ session('message') }}</i></p>
                    @endif

                    <!-- Display centralized error message -->
                    @if ($errors->has('message'))
                        <p class="text-danger"><i>{{ $errors->first('message') }}</i></p>
                    @endif

                    <div class="d-flex justify-content-evenly align-items-center">
                        <a class="mx-2" href="{{ route('auth_register') }}">Don't have an account?</a>
                        <input type="submit" class="btn btn-custom" value="Login">
                        <a class="btn btn-custom" href="{{ route('auth_admin') }}">Admin</a>

                    </div>
                </div>
            </form>
        </div>

    </div>
</body>
</html>