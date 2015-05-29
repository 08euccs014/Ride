@extends('layouts/main')
@section('content')

@if(isset($request) && $request)
<div class="col-sm-offset-3 col-sm-5 gap-top-20">
    <form id="loginform" action="{{ url('password/remind/request') }}" method="post"class="form-horizontal">

        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" name="email" placeholder="email" />
            </div>
        </div>

        <div class="form-group gap-top-20">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-primary btn-block">Reset</button>
            </div>
        </div>

    </form>
</div>
@endif

@if(isset($reset) && $reset)
<div class="col-sm-offset-3 col-sm-5 gap-top-20">
    <form id="loginform" action="{{ url('password/resetdone') }}" method="post"class="form-horizontal">

        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
                <span></span>
                <input type="email" class="form-control" name="email" placeholder="email" />
            </div>
        </div>

        <div class="form-group">
            <label for="password" class="col-sm-3 control-label">New Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" name="password" placeholder="New Password" />
            </div>
        </div>


        <div class="form-group">
            <label for="password_confirmation" class="col-sm-3 control-label">Confirm Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" />
            </div>
        </div>

        <div class="form-group gap-top-20">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-primary btn-block">Confirm</button>
            </div>
        </div>
        <input type="hidden" name="token" value="{{$token}}" />

    </form>
</div>
@endif

@stop