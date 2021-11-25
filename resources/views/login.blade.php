@extends('main')

@section('main')

<div class="container p-3" style="line-height:44px">

<h1>ورود کاربران</h1>

<form action="login" method="post">


<div class="container-fluid text-center border rounded p-3 ">

<div class="w-50 mx-auto">

@if(isset($error))
 <div class="text-danger">نام کاربری و یا رمز عبور اشتباه است</div>
@endif

 <div class="row p-1">
    <div class="col text-left">نام کاربری</div>
    <div class="col text-right"><input class="border border-secondary rounded" style="text-align:left;direction:ltr" name="user" type="text" class="form-control"></div>
 </div>

  <div class="row p-1">
    <div class="col text-left">رمز عبور</div>
    <div class="col text-right"><input class="border border-secondary rounded" style="text-align:left;direction:ltr" name="pass" type="password" class="form-control"></div>
 </div>
</div>

 <button class="btn btn-primary m-3 ">ورود</button>
</div>

</form>

</div>
@stop