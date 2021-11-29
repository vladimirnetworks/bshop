<div style="display:none;opacity:0.5;position:fixed;bottom:0px;left:0px;width:100%;background-color:black;height:100%;z-index:1000" class="cartslider_dim">

</div>


<div style="direction:rtl;position:fixed;bottom:0px;left:0px;width:100%;background-color:white;z-index:1001" id="mcartslider" class="text-left cartslider border-top   ">
 <div class="cartslider_smallview">

<span class="cartslider_smallview_text"></span><br>

 <button class="btn btn-info  showsabad">

مشاهده سبد خرید

 </button>
 </div>

 <div class="cartslider_bigview text-center" style="display:none">
 
 <div class="cartslider_bigview_cart"></div>
 
  <button class="finishshop">finish</button>

 </div>

</div>


<script>

$(".showsabad").click(function() {
   cartup(); 
   hpu("cartup");
});

$(".cartslider_dim").click(function() {
   cartdown(); 
});

$(".finishshop").click(function() {
   cartdown(); 
   $("#getNumberModal").modal("show");
    hpu("finishcart");

});

</script>