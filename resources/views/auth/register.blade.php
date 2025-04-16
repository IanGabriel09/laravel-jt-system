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
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="bg-white px-3 p-5 bg-custom rounded auth-form"> 
                    <div class="row mb-3">
                        <h3 class="text-center fw-bold">Register</h3>
                        <div class="col-12 mb-3">
                            <label for="">ID Number:</label>
                            <input type="text" name="id_num" id="id_num" class="form-control" required>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="">Email<i class="fs-small">(Where Notifcations will be sent)</i>:</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="col-lg-6 col-md-12 mb-3">
                            <label for="">First Name:</label>
                            <input type="text" id="fName" name="fName" class="form-control" required>
                        </div>

                        <div class="col-lg-6 col-md-12 mb-3">
                            <label for="">Last Name:</label>
                            <input type="text" id="lName" name="lName" class="form-control" required>
                        </div>

                        <div class="col-lg-6 col-md-12 mb-3">
                            <label for="">Department:</label>
                            <select name="department" id="department" class="form-select">
                                <option value="" disabled selected>--Select--</option>
                                <option value="Accounting">Accounting</option>
                                <option value="Compliance">Compliance</option>
                                <option value="General Admin">General Admin</option>
                                <option value="HR">HR</option>
                                <option value="Impex">Impex</option>
                                <option value="Logistics">Logistics</option>
                                <option value="Marketing">Marketing</option>
                                <option value="MIS">MIS</option>
                                <option value="Owner">Owner</option>
                                <option value="Others">Others</option>
                                <option value="Prepress">Prepress</option>
                                <option value="Production">Production</option>
                                <option value="Purchasing">Purchasing</option>
                                <option value="Quality Assurance">Quality Assurance</option>
                                <option value="Sales">Sales</option>
                                <option value="Warehouse">Woodmould</option>
                                <option value="Woodmould">Woodmould</option>
                            </select>
                        </div>

                        <div class="col-lg-6 col-md-12 mb-3">
                            <label for="title">Title:</label>
                            <select id="title" name="title" class="form-select" required>
                                <option value="" disabled selected>Select Title</option>
                                <option value="Manager">Manager</option>
                                <option value="Supervisor">Supervisor</option>
                                <option value="Staff">Staff</option>
                                <option value="In-Charge">In-Charge</option>
                                <option value="Operator">Operator</option>
                            </select>
                        </div>
    
                        <div class="col-12 mb-3">
                            <label for="">Password:</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label for="">Confirm Password:</label>
                            <input type="password" name="password_confirmation" id="confirmPassword" class="form-control" required>
                        </div>
                        
    
                        <div class="d-flex justify-content-end align-items-center">
                            <a class="mx-2" href="{{ route('auth_login') }}">Already have an account?</a>
                            <input type="submit" class="btn btn-custom" value="Register">
                        </div>
                    </div>

                    <!-- Display general error message from session -->
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show rounded-0 left-border-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show rounded-0 left-border-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                
                

                </div>



            </form>


        </div>

    </div>
</body>
</html>