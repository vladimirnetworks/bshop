
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">سفارش شما با موفقیت ثبت شد</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body text-center">

<div class="enternumber" style="display:none">        
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


<div class="modal fade" id="myModal2">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">آدرس تحویل</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body text-center">

 <div>



<form id="reggetaddress" name="reggetaddressform"  action="/" method="post">
 <input readonly class="ordernumber" style="font-size:24px;" type="hidden"  placeholder="شماره سفارش"> 

 <div class="row p-3">
 <input class="form-control col-12" style="font-size:24px;text-align:right;direction:rtl" type="text" id="getaddress" placeholder="آدرس"> 

 </div>

 <div id="zamantahvilsection" class=" p-3  border rounded" style="direction:rtl;text-align:right">

<div style="color:grey">زمان تحویل </div><hr>


 <div id="shipping_radio">
<div class="">
  <label class="">
    <input type="radio" class="" name="shiptype" value="0">
    فردا قبل از ظهر
(ارسال رایگان)
  </label>
</div>

<div class="">
  <label class="">
    <input type="radio" class="" name="shiptype" value="1">
    فردا بعد از ظهر
(ارسال رایگان)
  </label>
</div>

<div class="">
  <label class="">
    <input type="radio" class="" name="shiptype" value="2">
    همین الان (۵۰۰۰ تومان هزینه)
  </label>
</div>

</div>

 </div>

  <div id="reggetaddressedame" class="row p-3">
   <button type="button" class="btn btn-success col m-4">ادامه</button>
  </div>

</form>
</div>




        </div>
        
        <!-- Modal footer -->

        
      </div>
    </div>
  </div>




<div class="modal fade" id="myModal3">
    <div class="modal-dialog">
      <div class="modal-content">
      

        <div class="modal-body text-center">


<div id="modal3successcart"></div>

<div id="modal3successtext"></div>







                <br>
                 
                 <button  id="onlinepayment" type="button" class="btn btn-success" data-dismissx="modal">پرداخت آنلاین</button>   
                 <br>
                   <br>
                 <button  id="offlinepayment" type="button" class="btn btn-success" data-dismissx="modal">پرداخت در محل</button>   
                 <br>
<hr>

<div style="direction:rtl">
<hr>
<h4>
مشخصات خریدار : 
</h4><br>
شماره تماس خریدار : <span id="myModal3_phone"></span> <button id="myModal3_phone_change" class="btn btn-primary">تغییر</button>
<br>
آدرس خریدار : <span id="myModal3_address"></span> , تحویل در <span  id="myModal3_shipping"></span> <button id="myModal3_address_change" class="btn btn-primary">تغییر</button>
<br>
<br>
</div>

        </div>
        
        <!-- Modal footer -->

        
      </div>
    </div>
  </div>



