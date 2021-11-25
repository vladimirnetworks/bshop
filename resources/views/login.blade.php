@extends('main')

@section('main')

<div class="container p-3" style="line-height:44px">

<h1>ورود کاربران</h1>

<form action="login" method="post">


<div class="container-fluid text-center border rounded p-3 ">

 <div class="row">
    <div class="col text-left">نام کاربری</div>
    <div class="col text-right"><input name="user" type="text" class="form-control"></div>
 </div>

  <div class="row ">
    <div class="col text-left">رمز عبور</div>
    <div class="col text-right"><input name="pass" type="password" class="form-control"></div>
 </div>


 <button class="btn btn-primary m-3 p-3">ورود</button>
</div>

</form>

</div>
@stop