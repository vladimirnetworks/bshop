@extends('main')

@section('main')

<h1>سفارشات من</h1>



<div class="container-fluid" >

    <div class="row">
    @foreach($orders as $order)

    <div class="border">
      {{implode("<br>",$order->titles)}}
    </div>
    @endforeach
    </div>

</div>






@stop