@extends('main')

@section('main')

<div style="text-align:right;direction:rtl">

<hr>

<h1>{{$product->title}}</h1>

<div class="row">
 <div class="col-6">
   <img style="width:200px;" src="/{{$photo}}" style="max-width:100%"><br>
   <h4> مشخصات محصول 
   </h4>
   <ul>
   {!!lize($product->caption)!!}
   </ul>
 </div>

 <div class="col-6">

   <div class="p-3 text-success" style="font-size:150%;font-weight:bold">
   قیمت : {{number_format($product->price)}} تومان
   </div>

    <button type="button" class="btn btn-success btn-lg addtocart" data-prod="{{$product->cartnfo()}}" >افزودن به سبد خرید</button>

 </div>

</div>

</div>
@stop