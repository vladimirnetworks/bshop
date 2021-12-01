@extends('main3')

@section('main')


<div class="" style="text-align:center;direction:rtl">


    @foreach($order->cart['cart'] as $cartItem)
    {{$cartItem['title']}} ( {{$cartItem['count']}} عدد ) {{$cartItem['amount']}} تومان  <br>
    @endforeach



    {{$order->shipping['text']}}

    <hr>


   مجموع فاکتور شما : {{$order->cart['amount']+$order->shipping['cost']}} <br>

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