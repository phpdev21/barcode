@extends('user.layouts.app')
@section('content')
<div class="card">
    <div class="card-body">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs profile-tab" role="tablist">
        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Basic Information</a>
        </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Password</a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Privacy</a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#subscription" role="tab">Subscription</a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="home" role="tabpanel">
            <div class="card-body">
                <form class="form-horizontal form-material" id="basic_info">
                    @csrf
                    <div class="form-group first_name">
                        <label class="col-md-12">First Name</label>
                        <div class="col-md-12">
                            <input type="text" name="first_name" value="{{Auth::user()->first_name}}"
                                placeholder="Enter First Name" class="form-control form-control-line">
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Last Name</label>
                        <div class="col-md-12 last_name">
                            <input type="text" name="last_name" value="{{Auth::user()->last_name}}"
                                placeholder="Enter Last Name" class="form-control form-control-line">
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-email" class="col-md-12">Email</label>
                        <div class="col-md-12 email">
                            <input type="email" value="{{Auth::user()->email}}" placeholder="Enter Email"
                                class="form-control form-control-line" name="email" id="example-email">
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox checkbox-primary col-md-12">
                                <input value="1" id="checkbox1" @if(Auth::user()->is_product_update) checked @endif name="is_product_update" type="checkbox">
                                <label for="checkbox1"> Send me important Ghostery product updates. </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox checkbox-primary col-md-12">
                                <input value="1" id="checkbox2" @if(Auth::user()->is_promo) checked @endif name="is_promo" type="checkbox">
                                <label for="checkbox2"> Send me Ghostery tips and promos. </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--second tab-->
        <div class="tab-pane" id="profile" role="tabpanel">
            <div class="card-body">
                <form class="form-horizontal form-material" id="change-password">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-12">Password</label>
                        <div class="col-md-12 old_password">
                            <input type="password" placeholder="Enter Current Password"
                                class="form-control form-control-line" name="old_password">
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">New Password</label>
                        <div class="col-md-12 password">
                            <input type="password" placeholder="Enter New Password"
                                class="form-control form-control-line" name="password">
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-email password_confirmation" class="col-md-12">Confirm Password</label>
                        <div class="col-md-12">
                            <input type="password" placeholder="Confirm Password" class="form-control form-control-line"
                                name="password_confirmation">
                            <span class="error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane" id="settings" role="tabpanel">
            <div class="card-body">
                <h3>Comming soon !</h3>
            </div>
        </div>
        <div class="tab-pane" id="subscription" role="tabpanel">
            <div class="card-body">
                <h3>Comming Soon !</h3>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function(){
        $(document).on('submit','#basic_info',function(e){
            e.preventDefault();
            $.ajax({
                type:'put',
                data:$(this).serialize(),
                url:"{{route('user.profile.update')}}",
                success:function(data){
                    $(document).find('span.error').empty();
                    $('.header_name').html(data.name);
                    show_FlashMessage(data.message, 'success');
                }
            })

        });
        
        $(document).on('submit','#change-password',function(e){
            e.preventDefault();
            $.ajax({
                type:'put',
                data:$(this).serialize(),
                url:"{{route('user.password.update')}}",
                success:function(data){
                    $(document).find('span.error').empty();
                    show_FlashMessage(data.message, 'success');
                }
            })

        });
    });
</script>
@endsection