<!DOCTYPE html>
<html lang="pt-br">
<head>
    @php
        $nav = explode("/", Request::path())[0];
    @endphp 

    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ImportCSVs - {{ __("navbar.".$nav)  }}</title>
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/font-awesome.min.css" rel="stylesheet">
	<link href="/css/datepicker3.css" rel="stylesheet">
	<link href="/css/styles.css" rel="stylesheet">
    
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->

    @livewireStyles
    
</head>
<body>
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
                <a class="navbar-brand" href="#"><span>Import</span>CSV</a>

                <ul class="nav navbar-top-links navbar-right">
            </div>
        </div><!-- /.container-fluid -->
    </nav>

    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <div class="profile-userpic">
                <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
            </div>
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">{{ Auth::user()->name }}</div>
                <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
            </div>
            <div class="clear"></div>
        </div>

        <ul class="nav menu">
            <li class="{{ str_contains(Request::path(), 'customers') ? 'active' : '' }}" id="customers"><a href="/customers"><em class="fa fa-user-circle-o">&nbsp;</em> {{ __("navbar.customers") }} </a></li>
            <li class="{{ str_contains(Request::path(), 'import-files') ? 'active' : '' }}" id="import-files"><a href="/import-files"><em class="fa fa-upload">&nbsp;</em> {{ __("navbar.import-files") }} </a></li>
            <li><a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                              <em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div><!--/.sidebar-->


    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li id ="breadcumb" class="active"> {{ __("navbar.".$nav) }} </li> 
            </ol>
        </div><!--/.row-->
        

        @yield('content')


        <div class="row">
            <div class="col-sm-12">
                <p class="back-link">Lumino Theme by <a href="https://www.medialoot.com">Medialoot</a></p>
            </div>
        </div><!--/.row-->
    </div>	<!--/.main-->

    <script src="/js/jquery-1.11.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/bootstrap-datepicker.js"></script>
    <script src="/js/custom.js"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>    

    @yield('extra_js')

    @livewireScripts

</body>
</html>
