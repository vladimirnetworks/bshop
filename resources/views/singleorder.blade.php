@extends('main3')

@section('main')


<div class="" style="text-align:center">

   مجموع فاکتور شما : {{$order->total_amount}} <br>

   @if(isset($payment->id))

      @if($payment->status==1)
       پرداخت شده
      @else
      پرداخت شده نشده
      @endif
      
   @endif  

</div>

<div class="bigprod" style="text-align:center"></div>

<div class="loader row justify-content-center" style="margin-left:0px;margin-right:0px"></div>


@stop