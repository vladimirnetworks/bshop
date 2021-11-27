<div class="col-4 col-sm-3  p-1 text-center">

<div class=" h-100 " style="direction:rtl">
         

         <a href="product/{{$product->id}}">  <img class="mw-100" src="{{$product->photo}}"/></a>
       

<br>
      

        <a href="product/{{$product->id}}" class="d-block">{{$product->title}}</a>

         {{number_format($product->price)}} تومان

</div>

</div>