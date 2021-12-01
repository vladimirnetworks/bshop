@extends('main3')

@section('main')

<div class="p-2" style="text-align:center;direction:rtl">

 <div class="row p-1 m-1 rounded" >
   کد سفارش : <span style="color:#c70046">{{$order->encoded_id}}</span>
</div>

   @foreach($order->cart['cart'] as $cartItem)
   <div class="row p-1 m-1 rounded" style="background-color:#fcd1a9">
      <div class="col">
         {{$cartItem['title']}}
      </div>

      <div class="col">
         ( {{$cartItem['count']}} عدد ) {{$cartItem['amount']}} تومان
      </div>

   </div>
   @endforeach

   <div class="row p-1 m-1 rounded" style="background-color:#b3dfff">
      زمان تحویل :

      {{$order->show_shipping['text']}}

   </div>

   <hr>

   مجموع فاکتور شما : {{$order->cart['amount']+$order->show_shipping['cost']}} <br>

   @if(isset($payment->id))

   @if($payment->status==1)
   پرداخت شده

   @else
   پرداخت نشده
   @endif

   @endif

</div>

<div class="bigprod" style="text-align:center"></div>

<div class="loader row justify-content-center" style="margin-left:0px;margin-right:0px"></div>

@stop