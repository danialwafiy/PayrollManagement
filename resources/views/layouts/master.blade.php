<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="wrapper" id="app">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header text-center">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="img img-fluid w-50" src="/img/logo.png">
                </a>
            </div>

            <ul class="list-unstyled components mx-3">
                <li>
                    <router-link to="/"><span><i class="fas fa-chalkboard mr-3 fa-lg"></i></span>DASHBOARD</router-link>
                </li>
                @role('admin')
                <li>
                    <router-link to="/employees"><span><i class="fas fas fa-users mr-3 fa-lg"></i></span>EMPLOYEES</router-link>
                </li>
                <li>
                    <router-link to="/salaries"><span><i class="fas fas fa-hand-holding-usd mr-3 fa-lg"></i></span>SALARIES</router-link>
                </li>
                @else
                <li>
                    <router-link to="/employees/{{auth()->user()->id}}"><span><i class="fas fas fa-user mr-3 fa-lg"></i></span>EMPLOYEE DETAIL</router-link>
                </li> 
                <li>
                    <router-link to="/salaries"><span><i class="fas fas fa-hand-holding-usd mr-3 fa-lg"></i></span>SALARY DETAIL</router-link>
                </li>
                @endrole

<!--                 <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><span><i class="fas fa-cogs mr-3 fa-lg"></i>SETTINGS</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <router-link to="/reset-password"><span><i class="fas fa-clipboard-list mr-3 fa-lg"></i></span>RESET PASSWORD</router-link>
                        </li>
                    </ul>
                </li> -->
            </ul>
            <ul class="list-unstyled mx-3">
                <li>
                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <span><i class="fas fa-sign-out-alt mr-3 fa-lg"></i></span>LOGOUT
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="w-100">
            <!--  Navbar  -->
            <nav class="navbar navbar-expand-md navbar-light" style="background-color:#EDEDED;padding:20px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.3);">
                <button type="button" id="sidebarCollapse" class="btn text-dark font-weight-bold float-left">
                <i class="fas fa-bars fa-lg"></i>
                </button>
                <button class="navbar-toggler border-white float-right  text-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <div id="navbarDropdown" class="nav-link text-muted text-uppercase text-center  font-weight-bold" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span><i class="fas fa-user-circle mr-2"></i>Welcome </span>{{ Auth::user()->name }} 
                                </div>

<!--                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        
                                    </a>
                                </div> -->
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="p-5">
                <router-view></router-view>
            </div>

        </div>

    </div> <!--wrapper -->
<script>
@auth
window.laravel = @json(['user'=> auth()->user()])
@endauth
</script>

<script src="{{ asset('js/app.js') }}" ></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>

<style>
body {
    font-family: "Aeonik Regular", sans-serif;
    background: #F7F7F7;
}
p {
    font-family: 'Gill Sans', sans-serif;
    font-size: 1.1em;
    font-weight: 300;
    line-height: 1.7em;
    color: #999;
}
a, a:hover, a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}
#sidebar {
    background: #2A3F54;
    color: #fff;
    transition: all 0.3s;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0 rgba(0, 0, 0, 0.3);
}
#sidebar .sidebar-header {
    padding: 20px;
    background: #2A3F54;
}
#sidebar ul.components {
    padding: 20px 0;
    border-bottom: 1px solid white;
    border-top: 1px solid white;
}
#sidebar ul p {
    color: #fff;
    padding: 10px;
}
#sidebar ul li a {
    padding: 10px;
    font-size: 12px;
    display: block;
    margin-top:15px;
}
#sidebar ul li a:hover {
    color: white;
    background: rgba(0,0,0,0.1);
    border-radius: 200px;
}
#sidebar ul li.active > a{
    color: #2A3F54 !important;
    background: white;
    border-radius: 200px;
}
ul ul a {
    padding: 10px;
    font-size: 12px;
    display: block;
    margin-top:15px;
}
.wrapper {
    display: flex;
    width: 100%;
    align-items: stretch;
}
#sidebar {
    min-width: 260px;
    max-width: 260px;
    min-height: 100vh;
}
#sidebar.active {
    margin-left: -260px;
}
a[data-toggle="collapse"] {
    position: relative;
}
.dropdown-menu.active{
    color:black !important;
}

.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
}
@media (max-width: 768px) {
    #sidebar {
        margin-left: -260px;
    }
    #sidebar.active {
        margin-left: 0;
    }
}
.router-link-exact-active  {
    color: #2A3F54 !important;
    background: white;
    border-radius: 200px;}
</style>

</body>
</html>
