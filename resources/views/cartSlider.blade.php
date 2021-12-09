<div
   style="display:none;opacity:0.5;position:fixed;bottom:0px;left:0px;width:100%;background-color:black;height:100%;z-index:1000"
   class="cartslider_dim">

</div>

<div
   style="box-shadow:rgb(136 136 136) 0px 0px 10px;transition:height 0.3s;direction:rtl;position:fixed;bottom:0px;left:0px;width:100%;background-color:white;z-index:1001"
   id="mcartslider" class="text-left cartslider border-top ">
   <div class="cartslider_smallview"
      style="transition:all 0.3s;display:flex;height:100%;align-items: center">




<div id="gotomain" class="bottommenuitem mr-2 TransFormAnim">
         <img src="/icons/home.png" style="height:60%"/><small>صفحه‌اول</small>
</div>


<div id="enamd" class="bottommenuitem mr-2 TransFormAnim">
   <img src="/icons/enamad.png" style="height:60%"/></a><small>نماد اعتماد</small>
</div>

<script>


$("#enamd").click(function() {

window.location = "https://trustseal.enamad.ir/?id=244136&Code=NAYvp5VDiHI1pstposy1";

});


   $("#gotomain").click(function() {

      window.location = "/";

      /*
       cartdown();
       $(".modal").modal("hide");   
       $('.bigprod').empty();
       showtop();
       loadtoloader(".loader","index");
       loadcat(".catmain","catload",{"type":"index"});
       hpu({act: "gotomain"});
       */
   });
   </script>

<div id="totoorders" style="margin-left: auto;" class="bottommenuitem mr-2 TransFormAnim">

        <img src="/icons/orders.png" style="height:60%"/><small>سفارشات‌من</small>
</div>


<script>
   $("#totoorders").click(function() {
      window.location = "/myorders";
   });
   </script>


         <div class="ml-2 text-center"
   style="height:100%;display:flex;flex-direction: column;align-items: center;justify-content: center">
   <div class="cartslider_smallview_text" style=""></div>

   <button style="position: relative;line-height: 1.1;height:50%;max-height:5vh" class="font-weight-bold w-100 btn btn-danger  showsabad">

      <span style="position: relative;height:100%;">
         <img src="/icons/cart.png" style="height:100%;" />



      </span>

      <span class="showsabadcount" style="
      position: absolute;
      right:-1px;
      top:-14%;
      background-color: red;
      padding: 1px;
      border-radius: 50%;
      font-size: 0.7em;
  "></span>

      <span class="showsabadtxt">سبد خرید</span>

   </button>

</div>






   </div>

   <div class="cartslider_bigview text-center" style="display:none">

      <div class="cartslider_bigview_cart"></div>
       <div class="cartslider_bigview_cart_total"></div>
      <div class="w-100 text-center p-2 m-2">
         <button style="display:none" class="finishshop btn btn-primary">تایید و ثبت سفارش</button>
        
         
        
         <div style="display:none" class="khalie">سبد خریدتون خالیه 🖐<br>  </div>
      </div>

   </div>

</div>

<script>
   $(".showsabad").click(function() {
      cartup();

      
    

      hpu({ act: "cartup"});


   });
   $(".cartslider_dim").click(function() {
      //window.history.back();
      cartdown();
   });
   $(".finishshop").click(function() {
      cartdown();
      $("#getNumberModal").modal("show");
    
      hpu({ act: "finishcart"});
      toyou("preorder", xcart.items(), function(res) {
         console.log(res);
      
         myorder.orderid = res.data.id;
         myorder.shipping = res.data.shipping;
         $("#shippingx").empty();
         for (var i = 0; i < myorder.shipping.length; i++) {
            var maindiv = $("<div></div>");
            var labelx = $('<label ></label>');
            if (i === 0) {
               var inputx = $('<input checked type="radio" class="m-2" name="shiptype" value="' + i + '">');
            } else {
               var inputx = $('<input type="radio" class="m-2" name="shiptype" value="' + i + '">');
            }
            var textx = $('<span>' + myorder.shipping[i].text + '</span>');
            labelx.append(inputx);


            
            labelx.append(textx);
            maindiv.append(labelx);
            $("#shippingx").append(maindiv);
         }
      });
   });
</script>