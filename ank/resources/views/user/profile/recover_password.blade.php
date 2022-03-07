@extends('user.layouts.app')
@section('content')
<div class="card">
    <div class="card-body">
        <form class="form-horizontal form-material" action="{{route('user.change.password')}}" id="change-password">
            @csrf
            <input type="hidden" name="id" value="{{$id}}" />
            <div class="form-group">
                <label class="col-md-12">New Password</label>
                <div class="col-md-12 password">
                    <input type="password" placeholder="Enter New Password" class="form-control form-control-line"
                        name="password">
                    @if($errors->has('password'))
                        <div class="help-block">
                            <strong class="text-danger">{{ $errors->first('password') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="example-email password_confirmation" class="col-md-12">Confirm Password</label>
                <div class="col-md-12">
                    <input type="password" placeholder="Confirm Password" class="form-control form-control-line"
                        name="password_confirmation">
                    @if($errors->has('password_confirmation'))
                        <div class="help-block">
                            <strong class="text-danger">{{ $errors->first('password_confirmation') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <button class="btn btn-success">Changeeeeeeeeeeeeeeeee Password</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
<script>

</script>
@endsection