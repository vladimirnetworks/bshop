<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Webpage description goes here" />
  <meta charset="utf-8">
  <title>{{$pageTitle}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">



  <link rel="stylesheet" href="/bs4/bootstrap.min.css">
  <script src="/bs4/jquery.min.js"></script>
  <script src="/bs4/popper.min.js"></script>
  <script src="/bs4/bootstrap.min.js"></script>
  <script src="/bs4/cook.js?{{time()}}"></script>

   </head>

<style>
body {

}
a,a:visited {
  text-decoration:none;
}


input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}


input[type=number] {
  -moz-appearance: textfield;
}
</style>
<body>

<script>

</script>

<div class="p-0 p-md-4 p-lg-5 text-white bg-dark text-center text-md-end">
behkiana - phone : 066-42448787
</div>


<div class="container">
@yield('main')  
</div>



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
لطفا شماره تماستون رو وارد کنید 
 <br>
                 <button  id="reggetnumber" type="button" class="btn btn-success" data-dismiss="modal">ثبت</button>  <input class="form-control" style="font-size:24px;" type="number" id="getnumber" placeholder="شماره تماس"> 

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

 <br>
                 <button  id="reggetaddress" type="button" class="btn btn-success" data-dismiss="modal">ثبت</button>  <input class="form-control" style="font-size:22px;" type="text" id="getaddress" placeholder="آدرس"> 

        </div>
        
        <!-- Modal footer -->

        
      </div>
    </div>
  </div>












<div class="modal fade" id="myModal3">
    <div class="modal-dialog">
      <div class="modal-content">
      

        <div class="modal-body text-center">

مجموع : ۱۶۵۴۰۰۰ تومان
                <br>
                  <br>
                 <button  id="" type="button" class="btn btn-success" data-dismissx="modal">پرداخت آنلاین</button>   
                 <br>
                   <br>
                 <button  id="" type="button" class="btn btn-success" data-dismissx="modal">پرداخت در محل</button>   
                 <br>
                   <br>
                 زمان تحویل :
                 <select>
                  <option>قبل از ظهر</option>
                  <option>بعد از ظهر</option>
                  <option>همین الان</option>
                 
                 </select>
        </div>
        
        <!-- Modal footer -->

        
      </div>
    </div>
  </div>


<script>

///////////////////////////////////////////

cartsliderdata = {};
cartsliderdata.isup = false;
cartsliderdata.userwording = false;

function cartup() {

cartsliderdata.userwording = false;
cartsliderdata.isup = true;
$(".cartslider").animate({"height":"80vh"},100)
$(".cartslider_dim").fadeIn(200);

$(".cartslider_smallview").hide(200);
setTimeout(function() {

$(".cartslider_bigview").fadeIn(200);

},300);


}


function cartdown() {
cartsliderdata.userwording = false;
 cartsliderdata.isup = false; 

  $(".cartslider").animate({"height":"10vh"},100)
  $(".cartslider_dim").fadeOut(200);

 $(".cartslider_smallview").fadeIn(200);
 $(".cartslider_bigview").fadeOut(200);

}




function cartlistener() {
    var cart = JSON.parse(readCookie("cart"));
    
    var tot = 0;
    var num = 0;

    $.each(cart, function (i) {
      //num++;
      tot = tot+parseInt(cart[i]['price']*cart[i]['count']);
      num=num+parseInt(cart[i]['count']);
    }
    );

    tot = tot.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    var sabadtext = topersiannumber(num+' مورد '+tot+' تومان');
    $(".cartslider_smallview_text").html(sabadtext);
    $(".cartslider_underfinal").html(sabadtext);
  
    renderbigviewcart();
}

function addtocart(prod) {
  var mycart = cart();

  if (mycart[prod['id']] == null) {
          prod['count'] = 1;
          mycart[prod['id']] = prod;
          cart(mycart);
  }

 //cartlistener();

}

function cartchangecount(id, count) {
 var mycart = cart();
         if (mycart[id] != null) {

         

            if (parseInt(count) > 0) {
                mycart[id]['count'] = count;
            } 
            if (count === '0' || count === 0) {
                delete mycart[id];
            }
            cart(mycart);
         }

     //cartlistener();   
}



$('.addtocart').click(function() {

    var prod = JSON.parse($(this).attr('data-prod'));


    addtocart(prod);
    cartup();

    if (cartsliderdata.timer) {
      clearTimeout(cartsliderdata.timer);
    }

    cartsliderdata.timer = setTimeout(function() {
      if (!cartsliderdata.userwording) {

           console.log("i am false "+cartsliderdata.userwording);
           cartdown();

      }
    },4000);

});








function renderbigviewcart() {
console.log('called');
    var cart = JSON.parse(readCookie("cart"));
    
    var tot = 0;

    var ords = $('<div></div>');
    ords.empty();

    $.each(cart, function (i) {
    tot = tot+parseInt(cart[i]['price']*cart[i]['count']);

      var elem  = $('<div class="p-2"></div>');

      var tedad = $('<input type="number">').css({"width":"40px","text-align":"center"}).on('click touchstart',function(){
       
        setTimeout(function() {tedad.focus();},50);
      });

   

      tedad.val(cart[i]['count']);
      var pricev = $("<span>"+cart[i]['price']*cart[i]['count']+"</span>");


      tedad.on('keyup',function() {
        cartchangecount(i,tedad.val());
        pricev.text(cart[i]['price']*tedad.val());
        setTimeout(function() {tedad.focus();},50);
      });

        elem.append(pricev);
        elem.append($("<span>"+cart[i]['title']+"</span>"));
        elem.append(tedad);
        
         elem.append($("<button class=\"btn btn-danger\">x</button>").on("touchstart click",function() {
          elem.remove();
          cartchangecount(i,0);
        }));

      ords.append(elem);



    // ords = '<div>'+cart[i]['title']+'<input class="form-controll" style="width:40px;" value="5">'+'</div>'+ords;

    });


//$(".cartslider_bigview").html(ords+"<hr> مجموع : "+tot+" تومان");
$(".cartslider_bigview").empty();
$(".cartslider_bigview").append(ords);


var finalorder = $('<button class="btn btn-primary">تایید و ثبت نهایی</button>');

finalorder.on('touchstart click',function() {
  
toyou("preorder",readCookie("cart"),null);

setTimeout(function() {

  $("#myModal").modal('toggle');

  setTimeout(function() {
  $("#getnumber").focus();
  },1000);

},100);


setTimeout(function() {

      $(".cartslider_dim").css({"display":"none"});  
      $(".cartslider").css({"display":"none"});  


},50);

setTimeout(function() {


//$(".cartslider").show();  
//$(".cartslider_dim").show();  



},2000);


 //cartdown();

});

$(".cartslider_bigview").append(finalorder);

$(".cartslider_bigview").append($('<div class="cartslider_underfinal"></div>'));



}


</script>


<div style="display:none;opacity:0.5;position:fixed;bottom:0px;left:0px;width:100%;background-color:black;height:100%;z-index:9998" class="cartslider_dim">

</div>


<div style="direction:rtl;position:fixed;bottom:0px;left:0px;height:10vh;width:100%;background-color:white;z-index:9999" id="mcartslider" class="text-center cartslider p-3 border-top  p-3  bg-white">
 <div class="cartslider_smallview">
 سبد خرید [<span class="cartslider_smallview_text"></span>]
 <button class="btn btn-success m-2">
 ثبت سفارش
 </button></div>

 <div class="cartslider_bigview text-center" style="display:none">this is big view</div>

</div>

<script>
$( document ).ready(function() {
    cartlistener();
});


    $(window).focus(function() {
         cartlistener();
    });

    $(window).blur(function() {
        cartlistener();
    });


var interval = setInterval(function () {
 // cartlistener();
}, 2000);




/////////////////////

$(".cartslider_dim").click(function() {
  cartdown();
});



//$(".cartslider").click(function() {
 // cartup();
//});


var cs = document.getElementById('mcartslider');

self = {};

    swipStart = function(e) {



        e.preventDefault();
        self.mousedown = true;
      
        
        if (typeof e.changedTouches !== 'undefined') {
            self.start = e.changedTouches[0].pageY;
        } else {
            self.start = e.pageY;
        }

    }


 swipEnd = function(e) {
        self.mousedown = false;

       if (typeof e.changedTouches !== 'undefined') {
            var dif = e.changedTouches[0].pageY - self.start;
        } else {
            var dif = e.pageY - self.start;
        }




        if (dif <=0) {
          cartup();
        } else {
          cartdown();
        }

         cartsliderdata.userwording = true;

 }

   cs.addEventListener("mousedown", this.swipStart, true)
        //cs.addEventListener("mousemove", this.swiping, true)
    cs.addEventListener("mouseup", this.swipEnd, true)
    cs.addEventListener("mouseout", function(e) {

        if (self.mousedown) {
            swipEnd(e);
        }

    }, true)


    cs.addEventListener("touchstart", this.swipStart, true)
        // cs.addEventListener("touchmove", this.swiping, true)
    cs.addEventListener("touchend", this.swipEnd, true)






$("#reggetnumber").click(function () {

$('#myModal2').modal("show");

toyou("reguserdata",$("#getnumber").val(),null);
sc("phone",$("#getnumber").val());

});


$("#reggetaddress").click(function () {

$('#myModal3').modal("show");


toyou("reguserdata",$("#getaddress").val(),null);
sc("address",$("#getaddress").val());



});




</script>
</body>
</html>