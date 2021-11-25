@extends('main')

@section('main')

<div style="text-align:right;direction:rtl">

<h1>{{$product->title}}</h1>

<div class="row">
 <div class="col-6">
   <img style="width:200px;" src="{{$product->photos}}" style="max-width:100%"><br>
   <h4> مشخصات محصول 
   </h4>
   <ul>
   {!!lize($product->caption)!!}
   </ul>
 </div>
</div>

</div>
@stop