@include('user.layouts.header')
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
		@yield('content')
	</div>
</div>
<!-- END CONTENT -->
<div class="page-content-wrapper">
	<div class="page-content">
	@include('user.layouts.footer')
	</div>
</div>