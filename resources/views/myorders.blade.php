@extends('main')

@section('main')

<h1>سفارشات من</h1>



<div class="container-fluid" >



    
     @foreach($orders as $order)
     <div class="row border">
       
       <div>
        {!!implode("<br>",$order['titles'])!!}
       </div>

       <div>
        {{number_format($order['total'])}} تومان
       </div>

       <div>
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



     <div class="border">
     
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