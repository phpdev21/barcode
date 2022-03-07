<!-- Right sidebar -->
<!-- ============================================================== -->
<!-- .right-sidebar -->
<div class="right-sidebar">
	<div class="slimscrollright">
		<div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
		<div class="r-panel-body">
			<ul id="themecolors" class="m-t-20">
				<li><b>With Light sidebar</b></li>
				<li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
				<li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
				<li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
				<li><a href="javascript:void(0)" data-theme="blue" class="blue-theme working">4</a></li>
				<li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
				<li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
				<li class="d-block m-t-30"><b>With Dark sidebar</b></li>
				<li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
				<li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
				<li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
				<li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
				<li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
				<li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
			</ul>
		</div>
	</div>
</div>
<!-- ============================================================== -->
<!-- End Right sidebar -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer" style="left: 0px !important"> {{ env('APP_NAME') }} &copy; Copyright {{ date('Y') }}, All rights
	reserved </footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{asset('js/jquery.slimscroll.js')}}"></script>
<!--Wave Effects -->
<script src="{{asset('js/waves.js')}}"></script>
<!--Menu sidebar -->
<script src="{{asset('js/sidebarmenu.js')}}"></script>
<!--stickey kit -->
<script src="{{asset('assets/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
<script src="{{asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

<!--Custom JavaScript -->
<script src="{{asset('js/custom.min.js')}}"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!--c3 JavaScript -->
<script src="{{asset('assets/plugins/d3/d3.min.js')}}"></script>
<script src="{{asset('assets/plugins/c3-master/c3.min.js')}}"></script>
<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->
<script src="{{asset('assets/plugins/styleswitcher/jQuery.style.switcher.js')}}"></script>
<script src="{{ asset('js/jquery-ui.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/pnotify.custom.min.js') }}" type="text/javascript"></script>
<!-- Waitme JS -->
<script src="{{ asset('js/waitMe.min.js') }}" type="text/javascript"></script>

<!-- developer js common function functions -->
<script src="{{ asset('js/developer.js') }}" type="text/javascript"></script>
<script>
	$.ajaxSetup({
		    beforeSend: function() {
                //$('.preloader').css('display','block')
            },
            complete: function() {
                $('.preloader').css('display','none')
            },
		    error: function(error) {
				$('.preloader').css('display','none')
		    	$(document).find('span.error').empty();
	            if(error.status == 0 || error.readyState == 0) {
	                return;
	            }
	            else if(error.status == 401){
	            	errors = $.parseJSON(error.responseText);
	                window.location = errors.redirectTo;
	            }
	            else if(error.status == 422) {
					errors = error.responseJSON;
					console.log(errors)
	                $.each(errors.errors, function(key, value) {
						$('.'+key).find('span.error').empty().addClass('text-danger').text(value).finish().fadeIn();
	                });

	                $('html, body').animate({
				         scrollTop: ($('.error').offset().top - 300)
				    }, 2000);
	                
	            }
	            else if(error.status == 400) {
	                errors = error.responseJSON;
	                if(errors.hasOwnProperty('message')) {
	                    show_FlashMessage(errors.message, 'error');
	                }
	                else {
	                    show_FlashMessage('Something went wrong!', 'error');
	                }
	            }
	            else if(error.status == 500){
					console.log(typeof error.responseJSON.message)
					if(typeof error.responseJSON.message == 'string') {
	                    show_FlashMessage(error.responseJSON.message, 'error');
	                }else{
						show_FlashMessage('Something went wrong!', 'error');
					}
	                
	            }
	            //stop ajax loader
	            $('.preloader').css('display','none')
	        }
		});
</script>
@yield('js')
</body>

</html>