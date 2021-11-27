<div class="col-4 col-sm-3  p-2 text-center miniproduct" data-me='{{$product->jsondata}}' >

<div class=" h-100 " style="direction:rtl;flex-direction:column;display:flex">
         

         <a href="#product/{{$product->id}}">  <img class="mw-100" src="{{$product->photo}}"/></a>
       

<div style="margin-top:auto">
 <a style="color:#535353" href="product/{{$product->id}}" class="d-block">{{$product->tinytitle}}</a>
</div>
      
<div  style="margin-top:auto">
       
       <span style="color:#232933">  {{persiannumber(number_format($product->price))}} </span><span style="font-size:.714rem ; color:#232933">تومان
         </span>
</div>

</div>

</div>