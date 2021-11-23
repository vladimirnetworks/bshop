@extends('main')

@section('main')

<h1>سفارشات من</h1>



<div class="container-fluid" >

    <div class="row">
    @foreach($orders as $order)

      {{$order->data}}
<hr>
    @endforeach
    </div>

</div>






@stop