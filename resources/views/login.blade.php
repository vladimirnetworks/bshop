@extends('main')

@section('main')

<div class="container p-3" style="line-height:44px">

<h1>ورود کاربران</h1>

<form action="login" method="post">


<div class="container-fluid text-center">

 <div class="row">
    <div class="col">نام کاربری</div>
    <div class="col"><input name="user" type="text" class="form-control"></div>
 </div>

  <div class="row">
    <div class="col">رمز عبور</div>
    <div class="col"><input name="pass" type="password" class="form-control"></div>
 </div>


 <button class="btn btn-primary">ورود</button>
</div>

</form>

</div>
@stop