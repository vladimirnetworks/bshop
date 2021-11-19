@extends('main')

@section('main')

<div class="container-fluid" >

    <div class="row">
    @foreach($products as $product)

        @include('productItem')

    @endforeach
    </div>

</div>
@stop