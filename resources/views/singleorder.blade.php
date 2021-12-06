@extends('main')

@section('main')

<script>


$('.whitetopbar').hide();
$( document ).ready(function() {
    $('.whitetopbar').hide();
});

   </script>

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


   <div class=" p-2 m-1 rounded" style="background-color:white;border:1px solid grey;text-align:right">
    

      {{$order->address}} @if($order->shipping_status != 3) <button style="display:none" class="btn btn-info btn-sm">تغییر</button> @endif
         <br>
      {{$order->phone}}   @if($order->shipping_status != 3)<button style="display:none" class="btn btn-info btn-sm">تغییر</button> @endif

   </div>

   
<div class="p-1">
   مجموع فاکتور : {{number_format($order->cart['amount']+$order->show_shipping['cost'])}} تومان <br>

</div>
   

   @if(isset($payment->id) && $payment->status==1)

 


<span class="btn btn-success">پرداخت شده</span>


   @else

   پرداخت نشده <a class="btn btn-primary" href="/onlinepay/{{$order->encoded_id}}">پراخت آنلاین</a>
 
 
   @endif


   <hr>
</div>



@stop