<div
   style="display:none;opacity:0.5;position:fixed;bottom:0px;left:0px;width:100%;background-color:black;height:100%;z-index:1000"
   class="cartslider_dim">

</div>

<div
   style="box-shadow:rgb(136 136 136) 0px 0px 10px;transition:height 0.3s;height:9vh;direction:rtl;position:fixed;bottom:0px;left:0px;width:100%;background-color:white;z-index:1001"
   id="mcartslider" class="text-left cartslider border-top ">
   <div class="cartslider_smallview"
      style="transition:all 0.3s;display:flex;height:100%;align-items: center">




<div>
         <img src="/icons/menu.png" style="height:100%"/>
</div>

<div style="margin-left: auto">
         <img src="/icons/mag.png" style="height:100%"/>
</div>



         <div>
            <div class="cartslider_smallview_text" style="font-size:90%;"></div>
             
            <button style="font-size:90%;" class="w-100 btn btn-info  showsabad">

               سبد خرید

            </button>

         </div>






   </div>

   <div class="cartslider_bigview text-center" style="display:none">

      <div class="cartslider_bigview_cart"></div>

      <div class="w-100 text-center p-2 m-2">
         <button class="finishshop btn btn-primary">finish</button>
      </div>

   </div>

</div>

<script>
   $(".showsabad").click(function() {
      cartup();

      
    

      hpu({ act: "cartup"});


   });
   $(".cartslider_dim").click(function() {
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
            var labelx = $('<label></label>');
            if (i === 0) {
               var inputx = $('<input checked type="radio" class="" name="shiptype" value="' + i + '">');
            } else {
               var inputx = $('<input type="radio" class="" name="shiptype" value="' + i + '">');
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