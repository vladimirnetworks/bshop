@extends('main')

@section('main')

<h1>{{$product->title}}</h1>

<div class="row">
<div class="col-8">
<div>
 <img style="width:200px;" src="{{$product->photos}}" style="max-width:100%"><br>

<h4> مشخصات محصول 
</h4>
<ul>
{!!lize($product->caption)!!}
</ul>
</div>
</div>
<div class="col-4">
قیمت : {{number_format($product->price)}}

<!--
   <button type="button" class="btn btn-info btn-lg addtocartx" data-prod="{{$product->cartnfo()}}" data-toggle="modal" data-target="#myModal">خرید</button>
-->
<br>
 <button type="button" class="btn btn-success btn-lg addtocart" data-prod="{{$product->cartnfo()}}" >خرید</button>
</div>
</div>

@stop