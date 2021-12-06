<div class="modal fade" id="successOrderModal">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body text-center">
            <div class="enternumber">
               سفارش شما  ثبت شد
                  
               <div id="orderfinalx" style="line-height: 250%"> </div>
              
              <button id="onlinepay" class="btn btn-primary">پرداخت آنلاین</button> 
              <button id="offlinepay" class="btn btn-primary">پرداخت در محل</button> 
               <div>
                  <input type="hidden" id="myModal_next" value="address" />

               </div>
            </div>
            <div class="waitinnumber" style="display:none">
               ...
            </div>
         </div>
         <!-- Modal footer -->
      </div>
   </div>
</div>

<script>
$("#onlinepay").on('click',function () {
  window.location = "/onlinepay/"+myorder.orderid;
});

$("#offlinepay").on('click',function () {
  window.location = "/myorders/"+myorder.orderid;
});





</script>