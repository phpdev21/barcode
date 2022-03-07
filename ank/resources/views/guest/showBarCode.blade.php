<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta meta name="apple-mobile-web-app-capable" content="yes">

	<meta name="description" content="">
	<meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css')}}">
    
    	<link href="{{ asset('css/pnotify.custom.min.css') }}" rel="stylesheet" type="text/css" />
	<!-- Waitme Css -->
	<link href="{{ asset('css/waitMe.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- Bootstrap Core CSS -->
  <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- You can change the theme colors from here -->
  
    <title>Lead_Scan_UI</title>
  </head>
  <body>
  <div id="first">
  <div class="container-inner">
  <div class="images-top">
  <div class="images-topinner">
   <img src="{{asset('frontend/images/howard-miller-logo.png')}}">
  </div>
  <div class="images-topinner">
   <img src="{{asset('frontend/images/hekam.png')}}">
  </div>
  <div class="images-topinner">
   <img src="{{asset('frontend/images/Ridgeway.png')}}">
  </div>
  </div>
  <h5>summer 2019 las vegas market lead scan</h5>
  <div class="centerimg">
    <a href="" class="click_to_qr"><img src="{{asset('frontend/images/center-img.png')}}"></a>
    <div class="camera_div" style="display: none;">
     <video style="width: 100%;" class="video-back" id="preview" playsinline></video><a class="btn btn-default rotate"> <img style="width: 50px" src="{{asset('rotate.png')}}"></a>  
    </div>
     
  </div>
  <div class="img-bottomtext">
  Click here to scan badge <br>or enter badge<br> info below.
  </div>
  <form id="info_form">
  <div class="inputbox-outer badge_id">
  <label for="username">Badge ID:</label>
  <br>
  <input class="text-box single-line"  id="badge_id" name="badge_id" type="text" value="">
  <span class="error"></span>
  </div>
  <div class="inputbox-outer last_name">
  	@csrf
	<label for="username">Last Name:</label>
    <input type="text" id="last_name" name="last_name">
    <span class="error"></span>
</div>
<input type="submit" class="submit" value="Submit">
</form>
  </div>
  </div>
  
  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery-ui.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/pnotify.custom.min.js') }}" type="text/javascript"></script>
	<!-- Waitme JS -->
	<script src="{{ asset('js/waitMe.min.js') }}" type="text/javascript"></script>
	<!-- developer js common function functions -->
  <script src="{{ asset('js/developer.js') }}" type="text/javascript"></script>
  <!-- <script type="text/javascript" src="https://webrtc.github.io/adapter/adapter-latest.js"></script> -->
  <script src="{{ asset('js/instascan.min.js') }}" type="text/javascript"></script> 
  <!-- <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> -->
  <script type="text/javascript" src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
    <script type="text/javascript">
      
      cameraLength = 0;
      var currentCamera =1;
      $(document).on('click','.click_to_qr',function(e){
        e.preventDefault();
        $('.camera_div').show();
        $(this).hide();
         scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false,facingMode: 'environment' });
        scanner.addListener('scan', function (content) {
          scanListener(content);
        
        });
      Instascan.Camera.getCameras().then(function (cameras) {
        cameraLength = cameras.length;
        if (cameras.length > 0) {
          if (cameras.length == 1) {
            scanner.start(cameras[0]);  
          }else{
            scanner.start(cameras[1]);
            currentCamera = 2;  
          }
          
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
      });
      
    $(document).on('submit','#info_form',function(e){
        e.preventDefault();
        $(document).find('span.error').empty();
        
        badge_id = $('#badge_id').val();
        last_name = $('#last_name').val();
        ajaxForHitApi(badge_id,last_name);

    });

  function ajaxForHitApi(b,l){
    startLoader()
    $.ajax({
            type:'post',
            data:{"_token": "{{ csrf_token() }}",'badge_id':b,'last_name':l},
            url:"{{route('post.badge')}}",
            success:function(data){
              console.log(data);
              stopLoader();
              if (data.indexOf('DOCTYPE') != -1) {
                show_FlashMessage("Data is incorrect", 'error');
              }
              res = JSON.parse(data);
              console.log(typeof res['Results']['First Name']);
                if (typeof res['Results']['First Name'] == "undefined") {
                  show_FlashMessage("Data is incorrect", 'error');  
                }else{
                  company_name = res['Results']['Company'];
                  //last_name = res['Results']['Last Name'];
                  zip_code = res['Results']['Zip Code'];
                  country = res['Results']['Country'];
                  prov = res['Results']['State/Province'];
                  saveToListing(company_name, zip_code, country, prov);
                }
                
            },
            error: function(error) {
              stopLoader()
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
        })
  }

  function scanListener(content){
    if(content.indexOf('$') != -1){
          arr = content.split("$");
          if (arr.length > 4) {
              ajaxForHitApi(arr[0],arr[3]);
          }
        }
  }

 function saveToListing(name ,zip,country,prov){
 	startLoader()
 	var name=  name;
 	if (country == "Canada") {
 		var zip = prov;
 	}else{
 		var zip = zip;	
 	}
 	
 	$.ajax({
        type:'post',
        data:{"_token": "{{ csrf_token() }}",'name':name,'zip':zip},
        url:"{{route('save.listing')}}",
        success:function(data){
        	console.log(data.rep_name);
		      window.location = "{{route('thanks.message')}}?rep_name="+data.rep_name+"&name="+name;
		      stopLoader();     	
            
        },
        error:function(error){
        	stopLoader()
        }
    });
 }

 $(document).on('click','.rotate',function(){
        
  scanner.stop().then(function(){
    scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false });
    scanner.addListener('scan', function (content) {
      scanListener(content);
    });
    Instascan.Camera.getCameras().then(function (cameras) {
      
        if(cameraLength  == currentCamera){
          currentCamera =1;
        }else{
          ++currentCamera;
        }

          scanner.start(cameras[currentCamera-1]);
      

    }).catch(function (e) {
      alert(e)
    });
  });
});
 function getPlatform(){
  if(navigator.platform == "iPhone"){
    $('.rotate').hide();
  }
}
getPlatform();
 </script>
  </body>
</html>