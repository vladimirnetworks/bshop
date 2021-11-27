<div class="col-4 col-sm-3 dev p-5 p-2 text-center">

<div class="border border-secondary h-100 rounded">
         
         <a href="product/{{$product->id}}" class="d-block">{{$product->title}}</a>

<br>
      <a href="product/{{$product->id}}">  <img class="mw-100" src="{{$product->photo}}"/></a>

         {{number_format($product->price)}} تومان

</div>

</div>