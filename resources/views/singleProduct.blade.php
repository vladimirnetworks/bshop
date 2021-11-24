@extends('main')

@section('main')

<h1>{{$product->title}}</h1>

<div>
 <img src="{{$product->thumb}}" style="max-width:100%"><br>
{{$product->caption}}
</div>

قیمت : {{number_format($product->price)}}

<!--
   <button type="button" class="btn btn-info btn-lg addtocartx" data-prod="{{$product->cartnfo()}}" data-toggle="modal" data-target="#myModal">خرید</button>
-->
 <button type="button" class="btn btn-info btn-lg addtocart" data-prod="{{$product->cartnfo()}}" >خرید</button>


@stop