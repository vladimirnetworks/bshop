@extends('main3')

@section('main')

<div class="container-fluid" >

    <div class="row justify-content-center">
    @foreach($products as $product)

        @include('productItem')

    @endforeach
    </div>

</div>
@stop