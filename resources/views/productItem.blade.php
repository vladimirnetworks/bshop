<div class="col-4 col-sm-3  p-1 text-center"  >

<div class=" h-100 " style="direction:rtl;flex-direction:column;display:flex">
         

         <a href="product/{{$product->id}}">  <img class="mw-100" src="{{$product->photo}}"/></a>
       

<div style="margin-top:auto">
 <a style="color:#2a2a2a" href="product/{{$product->id}}" class="d-block">{{$product->tinytitle}}</a>
</div>
      
<div  style="margin-top:auto">
       
         {{number_format($product->price)}} تومان
</div>

</div>

</div>