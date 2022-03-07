<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- User profile -->
		<div class="user-profile"
			style="background: url({{asset('assets/images/background/user-info.jpg')}}) no-repeat;">
			<!-- User profile image -->
			<div class="profile-img"> <img src="{{asset('assets/images/users/profile.png')}}" alt="user" /> </div>
			<!-- User profile text-->
			<div class="profile-text"> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown"
					role="button" aria-haspopup="true" aria-expanded="true">{{Auth::user()->first_name.' '.Auth::user()->last_name}}</a>
				<div class="dropdown-menu animated flipInY">
					<a href="{{route('logout')}}" class="dropdown-item"><i
							class="fa fa-power-off"></i> Logout</a>
				</div>
			</div>
		</div>
		<!-- End User profile text-->
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav">
				<li>
					<!-- <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li> -->
					<li><a href="{{route('admin.rep')}}">Color Settings</a></li>
					<li><a href="{{route('admin.lead')}}">Lead Listing</a></li>
				</li>


			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
	<!-- Bottom points-->
	<div class="sidebar-footer">
		<a href="{{route('logout')}}" class="link" data-toggle="tooltip" title="Logout"><i
				class="mdi mdi-power"></i></a>
	</div>
	<!-- End Bottom points-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Container fluid  -->
	<!-- ============================================================== -->
	<div class="container-fluid">