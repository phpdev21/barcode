<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
	<title>Admin</title>
	<!-- Bootstrap Core CSS -->
	<link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

	<!-- chartist CSS -->
	<link href="{{asset('assets/plugins/chartist-js/dist/chartist.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/plugins/chartist-js/dist/chartist-init.css')}}" rel="stylesheet">
	<link href="{{asset('assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css')}}"
		rel="stylesheet">
	<!--This page css - Morris CSS -->
	<link href="{{asset('assets/plugins/c3-master/c3.min.css')}}" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="{{asset('css/style.css')}}" rel="stylesheet">
	<!-- You can change the theme colors from here -->
	<link href="{{asset('css/colors/blue.css')}}" id="theme" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.css" rel="stylesheet">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border">
	<!-- ============================================================== -->
	<!-- Preloader - style you can find in spinners.css -->
	<!-- ============================================================== -->
	<div class="preloader">
		<svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
	</div>
	<!-- ============================================================== -->
	<!-- Main wrapper - style you can find in pages.scss -->
	<!-- ============================================================== -->
	<div id="main-wrapper">
		<!-- ============================================================== -->
		<!-- Topbar header - style you can find in pages.scss -->
		<!-- ============================================================== -->
		<header class="topbar">
			<nav class="navbar top-navbar navbar-expand-md navbar-light">
				<!-- ============================================================== -->
				<!-- Logo -->
				<!-- ============================================================== -->
				<div class="navbar-header">
					<a class="navbar-brand" >
						<!-- Logo icon --><b>
							<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
							<!-- Dark Logo icon -->
							<img src="{{asset('assets/images/logo-icon.png')}}" alt="homepage" class="dark-logo" />
							<!-- Light Logo icon -->
							<img src="{{asset('assets/images/logo-light-icon.png')}}" alt="homepage"
								class="light-logo" />
						</b>
						<!--End Logo icon -->
						<!-- Logo text --><span>
							<!-- dark Logo text -->
							<img src="{{asset('assets/images/logo-text.png')}}" alt="homepage" class="dark-logo" />
							<!-- Light Logo text -->
							<img src="{{asset('assets/images/logo-light-text.png')}}" class="light-logo"
								alt="homepage" /></span>
					</a>
				</div>
				<!-- ============================================================== -->
				<!-- End Logo -->
				<!-- ============================================================== -->
				<div class="navbar-collapse">
					<!-- ============================================================== -->
					<!-- toggle and nav items -->
					<!-- ============================================================== -->
					<ul class="navbar-nav mr-auto mt-md-0">
						<!-- This is  -->
						<li class="nav-item"> <a
								class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark"
								href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
						<li class="nav-item"> <a
								class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark"
								href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
						<!-- ============================================================== -->
						<!-- Search -->
						<!-- ============================================================== -->


					</ul>
					<!-- ============================================================== -->
					<!-- User profile and search -->
					<!-- ============================================================== -->
					<ul class="navbar-nav my-lg-0">

						<!-- ============================================================== -->
						<!-- Profile -->
						<!-- ============================================================== -->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href=""
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
									style="color:white">{{Auth::user()->first_name.' '.Auth::user()->last_name}}</span>&nbsp;<img
									src="{{asset('assets/images/users/1.jpg')}}" alt="user" class="profile-pic" /></a>
							<div class="dropdown-menu dropdown-menu-right scale-up">
								<ul class="dropdown-user">
									<li><a href="{{route('logout')}}"><i class="fa fa-power-off"></i> Logout</a></li>
								</ul>
							</div>
						</li>

					</ul>
				</div>
			</nav>
		</header>
		<!-- ============================================================== -->
		<!-- End Topbar header -->
		<!-- ============================================================== -->