@extends('main')

@section('main')





<div class="container-fluid text-right" style="direction:rtl" >

  <h1>سفارشات من</h1>

    
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


@if($_COOKIE['zcart'])
<script>

  $(document).ready(function() {
    cartup();
   });
</script>
@endif



@stop