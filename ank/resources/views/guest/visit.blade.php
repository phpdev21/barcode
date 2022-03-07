@extends('user.layouts.app')
@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div>
    <div class="card">
        <div class="card-body">
          
            
                <table class="table table-bordered html_content" >
                    @foreach($data as $key=>$value)
                        
                            <tr style="background-color:{{$value->rep->color}} ">
                                <td style="color: white">{{$value->date}}</td>
                                <td style="color: white">{{$value->user_name}}</td>
                                <td style="color: white">{{$value->rep_name}}</td>
                            </tr>
                    @endforeach
            </table>
        
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script>
     $('.dataTables_processing').remove();
    window.setInterval(function(){
        ajaxForReload();
    }, 2000);

    function ajaxForReload(){
        $.ajax({
            type:'get',
            data:$(this).serialize(),
            url:"{{route('reload.listing')}}",
            success:function(data){
                html = "";
                $.each(data, function (i,v) {
                   // console.log(v);
                    html +='<tr style="background-color:'+v['rep']['color']+' ">\
                                <td style="color: white">'+v['date']+'</td>\
                                <td style="color: white">'+v['user_name']+'</td>\
                                <td style="color: white">'+v['rep_name']+'</td>\
                            </tr>'
                });

                $('.html_content').html(html);
                
            }
        })
    }
     
</script>
@endsection