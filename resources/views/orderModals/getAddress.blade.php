<div class="modal fade" id="getAddressModal">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Header -->
         <div class="modal-header">
       
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <!-- Modal body -->
         <div class="modal-body text-center">
            <div class="enternumber" >
آدرستو رو وارد کنید
               <br>
               <div>
                  <input type="hidden" id="myModal_next" value="address"/> 
                  <form id="reggaddress" name="reggaddressform"  action="/" method="post">
                     <input readonly class="ordernumber" style="font-size:24px;" type="hidden"  placeholder="شماره سفارش"> 
                     <div class="row p-3">
                        <input class="form-control col-12" style="font-size:24px;text-align:right;direction:rtl" type="text" id="getaddress" placeholder="آدرس"> 
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
$( "#getAddressModal" ).on('shown.bs.modal', function(){

 $("#getaddress").trigger('focus');
});


$("#reggaddress").on('submit',function () {

    $( "#getAddressModal" ).modal("hide");
  
    
    return false;
});
</script>