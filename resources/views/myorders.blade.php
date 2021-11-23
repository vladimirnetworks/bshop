@extends('main')

@section('main')

<h1>سفارشات من</h1>



<div class="container-fluid" >

    <div class="row">
    @foreach($orders as $order)

    <div class="border">
      {!!implode("<br>",$order['titles'])!!}
    </div>

    <div class="border">
      {{number_format($order['total'])}} تومان
    </div>

    <div class="border">
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


    @endforeach
    </div>






    <div class="border">
     
       @if($order['payment_status'] === 0)
   پرداخت نشده
       @endif

     @if($order['payment_status'] === 1)
    پرداخت شده
       @endif


    </div>


    @endforeach
    </div>






</div>






@stop