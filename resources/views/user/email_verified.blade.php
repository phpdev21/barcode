@extends('user.layouts.app')
@section('content')
<div class="alert alert-success" role="alert">
  your email {{$user->email}} is verified successfully !
</div>
@endsection