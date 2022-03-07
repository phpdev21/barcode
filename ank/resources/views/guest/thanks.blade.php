  <!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Lead_Scan_UI</title>
  </head>
  <body>
  <div id="second">
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

  <div class="img-bottomtext">
  {{$_REQUEST['name']}}
  <br>
  Assigned to
  <br>
  {{$_REQUEST['rep_name']}}
  </div>
  
  <div class="scan-nextlead">
   <a href="{{route('bar.code')}}" style="color: white"><p class="scan_next">Scan Next Lead</a></p></a>
  </div>
  
  </div>
  </div>

      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript">
      $(document).on('click','.scan-nextlead',function(){
        window.location.href = "{{route('bar.code')}}";
      });
    </script>
  </body>
</html>