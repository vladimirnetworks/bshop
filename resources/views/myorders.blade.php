@extends('main')

@section('main')

<h1>سفارشات من</h1>



<div class="container-fluid" style="direction:rtl" >



    
     @foreach($orders as $order)
     <div class="row border justify-content-center align-items-center">
       
       <div class="col">
          @foreach($order['items'] as $item)
           {{$item['text']}} ( {{$item['count']}} عدد ) <br>
          @endforeach
       </div>

       <div class="col">
        {{number_format($order['total'])}} تومان
       </div>

       <div class="col">
       وضعیت : 

       @if($order['shipping_status'] === 0)
          در حال بررسی
       @endif

       @if($order['shipping_status'] === 1)
        ارسال شده
       @endif

       @if($order['shipping_status'] === 2)
       تحویل داده شده
       @endif

       </div>



     <div class="col">
       @if($order['payment_status'] === 0)
        پرداخت نشده
       @endif

       @if($order['payment_status'] === 1)
       پرداخت شده
       @endif
     </div>



     </div>
     @endforeach


</div>






@stop