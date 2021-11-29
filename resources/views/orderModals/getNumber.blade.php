<div class="modal fade" id="getNumberModal">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
       
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body text-center">
            <div class="enternumber" >
               لطفا شماره تماستون رو وارد کنید 
               <br>
               <div>
                  <input type="hidden" id="myModal_next" value="address"/> 
                  <form id="reggetnumber" name="reggetnumberform"  action="/" method="post">
                     <input readonly class="ordernumber" style="font-size:24px;" type="hidden"  placeholder="شماره سفارش"> 
                     <div class="row p-3">
                        <input class="form-control col-10" style="font-size:24px;" type="number" id="getnumber" placeholder="شماره تماس"> 
                        <button type="submit" class="btn btn-success col-2">ثبت</button>
                     </div>
                  </form>
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
$( "#getNumberModal" ).on('shown.bs.modal', function(){
    console.log("shows");
 $("#getnumber").trigger('focus');

});


$("#reggetnumber").on('submit',function () {

    $( "#getNumberModal" ).modal("hide");
    $("#getAddressModal").modal("show");

     hpu("addednumber");

    return false;
});
</script>