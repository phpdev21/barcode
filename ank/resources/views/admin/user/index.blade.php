@extends('admin.layouts.app')
@section('content')

<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor">Manage Users</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Manage Users</li>
        </ol>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Manage Users</h4>
            <div class="table-responsive m-t-40">
                 <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Full Name</th>
                            <th>Color</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Select Color</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="color-form">
            @csrf
            <input id="demo" type="text" class="form-control"  name="color" value="rgb(255, 128, 0)" />
            <input  type="hidden" name="id" id="id-inp" />
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <div class="float-left w-100">
        <button type="button" class="btn btn-success save-color" >Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      </div>

    </div>
  </div>
</div>

@endsection
@section('js')

<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="//cdn.rawgit.com/twbs/bootstrap/v4.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.js"></script>
<script>
    // $(document).ready(function() {
    //     $('#myTable').DataTable();
    // });
     var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('admin.rep')}}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'first_name', name: 'first_name'},
            {data: 'last_name', name: 'last_name'},
            {data: 'full_name', name: 'full_name'},
            {data: 'colors', name: 'colors'},
            {data: 'action', name: 'action'},

        ]
    });
     $('#demo').colorpicker();

      // Example using an event, to change the color of the .jumbotron background:
      $('#demo').on('colorpickerChange', function(event) {
        $('.jumbotron').css('background-color', event.color.toString());
      });
    
    $(document).on('click','.color',function(){
        $('#id-inp').val($(this).attr('data-id'));
        $('#demo').val($(this).attr('data-color'));
        $('#myModal').modal('toggle');
    });

    $(document).on('click','.save-color',function(){
        $('#myModal').modal('toggle');
        $.ajax({
            type:'post',
            data:$('#color-form').serialize(),
            url:"{{route('post.rep.color')}}",
            success:function(data){
                $(document).find('span.error').empty();
                //show_FlashMessage(data.message, 'success');
                table.ajax.reload( null, false);
                 $('#myModal').modal('hide');
            }
        })
    });

</script>
@endsection