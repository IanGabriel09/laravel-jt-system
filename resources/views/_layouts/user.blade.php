<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- CSS, Bootstrap, and BS icons hosted by VITE --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css', 'resources/css/styles.css']) 
    

    <title>{{ config('app.name') }}</title>
</head>
<body>


    <div class="navbar px-4 bg-white border shadow-sm z-index-2 position-fixed top-0 left-0 w-100">
        <div class="d-flex justify-content-between">
            <div class="navbar-brand d-flex align-items-center">
                <img src="{{ asset('img/KoufuLogo.webp') }}" alt="" class="img-fluid" width="50" height="50">
                <p class="my-0 mx-3 lead">KFCP MIS JT</p>
            </div>
            <button class="btn btn-primary mx-5" data-toggle="collapse" id="menu-toggle-2"><i class="bi bi-grid-3x3-gap fs-3"></i>
            </button>
        </div>
    
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-muted"><i class="bi bi-power"></i> Logout</button>
        </form>
    </div>
    

    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
                <li class="{{ request()->routeIs('userHome') ? 'active' : '' }}">
                    <a href="{{ route('userHome') }}">
                        <span class="fa-stack fa-lg pull-left"><i class="fa fa-dashboard fa-stack-1x"></i></span> Dashboard
                    </a>
                </li>
                <li class="{{ request()->routeIs('userCreateTicket') ? 'active' : '' }}">
                    <a href="{{ route('userCreateTicket') }}">
                        <span class="fa-stack fa-lg pull-left"><i class="fa fa-wrench fa-stack-1x "></i></span> Create Ticket
                    </a>
                </li>
                <li class="{{ request()->routeIs('userHistory') ? 'active' : '' }}">
                    <a href="{{ route('userHistory') }}">
                        <span class="fa-stack fa-lg pull-left"><i class="fa-solid fa-clock-rotate-left fa-stack-1x"></i></span> History
                    </a>
                </li>
                <li class="{{ request()->routeIs('userHelpCenter') ? 'active' : '' }}">
                    <a href="{{ route('userHelpCenter') }}">
                        <span class="fa-stack fa-lg pull-left"><i class="fa fa-question-circle fa-stack-1x"></i></span> Help Center
                    </a>
                </li>
            </ul>
        
            <!-- Sidebar Footer -->
            <div class="sidebar-footer d-none d-md-block">
                <small>&copy; {{ date('Y') }} Kou Fu Printing Corp<br>v1.0</small>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="content">
                @yield('content')
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    @yield('scripts')


    
</body>
</html>