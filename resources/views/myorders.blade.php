@extends('main')

@section('main')


<script>
  $('.whitetopbar').hide();
$( document ).ready(function() {
    $('.whitetopbar').hide();
});
  </script>


<div class="container-fluid text-right" style="direction:rtl" >

  <h1>سفارشات من</h1>

    
     @foreach($orders as $order)
     <div class="row border justify-content-center align-items-center">
       
       <div class="col">
        <a href="/myorders/{{$order['encoded_id']}}">
          @foreach($order['items'] as $item)
           <small>{{$item['text']}} ( {{$item['count']}} عدد ) </a><br>
          @endforeach
           </small>
       </div>

       <div class="col">
        {{number_format($order['total'])}} تومان
       </div>

       <div class="col">
   

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
        <a href="/onlinepay/{{$order['encoded_id']}}" class="btn btn-primary">پرداخت</a>
       @endif

       @if($order['payment_status'] === 1)
       <button class="btn btn-success">پرداخت شده</button>
       
       @endif
     </div>



     </div>
     @endforeach


</div>


@if(isset($_COOKIE['zcart']))
<script>

  $(document).ready(function() {

    cartup();
   });
</script>
@endif



@stop