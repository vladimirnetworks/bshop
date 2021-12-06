<div class="modal fade" id="getAddressModal">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">

            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body text-center">
            <div class="enternumber">
               <h5>
               آدرستو رو وارد کنید
               </h5>
               <div>
                  <input type="hidden" id="myModal_next" value="address" />
                  <form id="reggaddress" name="reggaddressform" action="/" method="post">
                     <input readonly class="ordernumber" style="font-size:24px;" type="hidden"
                        placeholder="شماره سفارش">
                     <div class="row p-3">
                        <input class="form-control col-10" style="font-size:24px;text-align:right;direction:rtl"
                           type="text" id="getaddress" placeholder="آدرس">
                        <button type="submit" class="btn btn-success col-2">ثبت</button>
                     </div>

                     <h5> زمان ارسال </h5>
                     <div id="shippingx" class="p-1" style="direction: rtl;text-align:right"></div>


                  </form>
               </div>
            </div>
            <div class="waitinnumber" style="display:none">



            </div>
         </div>
         <!-- Modal footer -->
      </div>
   </div>
</div>
<script>
   $("#getAddressModal").on('shown.bs.modal', function() {
      $("#getaddress").trigger('focus');

     
   });
   $("#reggaddress").on('submit', function() {


      if ($('#getaddress').val() == "") {
         shakeAnim($('#getaddress'));
      } else {
      
      $("#getAddressModal").modal("hide");
      $("#successOrderModal").modal("show");
 
      hpu({ act: "addedaddress"});


      var selectedshipping = $('input[name=shiptype]:checked').val();

      toyou("setshipping",{orderid:myorder.orderid,shipping:selectedshipping});
      toyou("reguserdata",{orderid:myorder.orderid,type:"address",data:$('#getaddress').val()});


     var shippingcost = myorder.shipping[selectedshipping].cost;

      $("#orderfinalx").empty();

      $("#orderfinalx").append('<div class=""> کد سفارش : '+myorder.orderid+'</div>'); 

      var tot = xcart.total();
      $("#orderfinalx").append('<div class="mb-2">مبلغ فاکتور : '+farsi_price(tot.amount+shippingcost)+' تومان <br> <small class="text-secondary">( '+Num2persian(tot.amount+shippingcost)+' )</small></div>'); 


      xcart.empty();
      }


      return false;
   });
</script>