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
   </head>


<body>

<script>
tdata = {};
</script>

<div  style="text-align:right;direction:rtl" class="p-0 p-md-2 p-lg-3 text-white bg-dark text-center text-md-end">




<div class="row justify-content-center align-items-center">

 <div class="col">
 فروشگاه اینترنی محصولات بهداشتی بهکیانا
<br>
ارسال فقط در شهر بروجرد
 </div>

<div class="col" >
 <img src="https://s4.uupload.ir/files/new_project_(1)_zt1i.png" style="max-height:90px" class="m-2"/>
</div>


</div>


<div class="text-right">
<a class="btn btn-primary" href="/">صفحه اول</a>
<a class="btn btn-primary" href="/myorders">سفارشات من</a>
<a class="btn btn-primary" href="/contact-us">تماس با ما</a>
<a class="btn btn-primary" href="/login">ورود کاربران</a>
</div>

</div>

<div class="text-center m-2">
<a class="btn btn-warning" href="/cat/1">بهداشت و مراقبت بدن</a>
<a class="btn btn-warning" href="/cat/2">بهداشت دهان و دندان</a>
<a class="btn btn-warning" href="/cat/3">مراقبت پوست</a>
<a class="btn btn-warning" href="/cat/4">صابون شستشو</a>
<a class="btn btn-warning" href="/cat/5">انواع شامپو</a>
</div>



<div class="container" style="text-align:right;">
@yield('main')  
</div>

















  @include('orderModals')

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


function cart_gen_tot_and_num() {
    var cart = JSON.parse(readCookie("cart"));
    
    var tot = 0;
    var num = 0;

    $.each(cart, function (i) {
      //num++;
      tot = tot+parseInt(cart[i]['price']*cart[i]['count']);
      num=num+parseInt(cart[i]['count']);
    }
    );

    var ret = {};
    ret['tot'] = tot;
    ret['num'] = num;
    ret['farsi'] = Num2persian(tot);
    return ret;

}

function farsi_price(inp) {
var inpc = inp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
return topersiannumber(inpc);
}

function gen_sabad_text() {
  
    var totnum = cart_gen_tot_and_num();
    var totcm = farsi_price(totnum.tot);
    var sabadtext = topersiannumber(totnum.num+' مورد '+totcm+' تومان');
    return sabadtext;

}
function cartlistener() {


    $(".cartslider_smallview_text").html(gen_sabad_text());

  
    renderbigviewcart();
}

function addtocart(prod) {
  var mycart = cart();

  if (mycart[prod['id']] == null) {
          prod['count'] = 1;
          mycart[prod['id']] = prod;
          cart(mycart);
  }

cartlistener();

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

cartlistener();   
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





   var cont = $('<div style="width:100%;float:right;" class="border rounded p-2"></div>');


    



        cont.append($("<span style=\"float:right;\">"+cart[i]['title']+"</span>"));
        cont.append($("<span style=\"float:right\">"+farsi_price(cart[i]['price']*cart[i]['count'])+"</span>"));     



        var countsection = $('<div class="" style="white-space:nowrap;float:left"></div>')  

        countsection.append($("<button class=\"btn btn-danger \" style=\"  border-top-right-radius: 5px;border-bottom-right-radius: 5px;\">+</button>").on("click touchstart",function(e) {
            e.preventDefault()
            e.stopPropagation()

          cartchangecount(i,cart[i]['count']+1);
        }));


        countsection.append($("<span>"+cart[i]['count']+"</span>"));


        countsection.append($("<button  class=\"btn btn-danger\" style=\"border-top-left-radius: 5px;border-bottom-left-radius: 5px;\">-</button>").on("click touchstart",function(e) {
                     e.preventDefault()
            e.stopPropagation()
          cartchangecount(i,cart[i]['count']-1);
        }));

        cont.append(countsection);
        
        /*elem.append($("<button class=\"btn btn-danger\">x</button>").on("touchstart click",function() {
          elem.remove();
          cartchangecount(i,0);
        }));
        */

      ords.append(cont);



    // ords = '<div>'+cart[i]['title']+'<input class="form-controll" style="width:40px;" value="5">'+'</div>'+ords;

    });


//$(".cartslider_bigview").html(ords+"<hr> مجموع : "+tot+" تومان");
$(".cartslider_bigview").empty();
$(".cartslider_bigview").append(ords);


var finalorder = $('<button class="btn btn-primary m-2">تایید و ثبت نهایی</button>');

finalorder.on('touchstart click',function() {
  
toyou("preorder",readCookie("cart"),function(res) {
 var ress = JSON.parse(res);
 $(".waitinnumber").hide();
 $(".enternumber").show();
 sc("tordernumber",ress.data.id);

 $(".ordernumber").each(function (index) {
   $(this).val(ress.data.id);
 });


$("#shipping_radio").empty();
tdata.shippingcost = [];
for (var i=0 ; i < ress.data.shipping.length ; i++) {
  console.log(ress.data.shipping[i]);

tdata.shippingcost.push(ress.data.shipping[i].cost);

var maindiv = $("<div></div>");
var labelx = $('<label></label>');
if (i === 0 ) {
var inputx = $('<input checked type="radio" class="" name="shiptype" value="'+i+'">');

} else {
var inputx = $('<input type="radio" class="" name="shiptype" value="'+i+'">');
}
var textx = $('<span>'+ress.data.shipping[i].text+'</span>');

labelx.append(inputx);
labelx.append(textx);
maindiv.append(labelx);

$("#shipping_radio").append(maindiv);




}





});







setTimeout(function() {

  $("#myModal").modal('toggle');

  setTimeout(function() {
    $("#getnumber").val(gc("phone"));
  $("#getnumber").focus();
  },500);

},100);


setTimeout(function() {

    //  $(".cartslider_dim").css({"display":"none"});  
    //  $(".cartslider").css({"display":"none"});  
     
    //sc("cart",'{}');
     //cartlistener();  
    cartdown();


},50);

setTimeout(function() {


//$(".cartslider").show();  
//$(".cartslider_dim").show();  



},2000);


 //cartdown();

});


$("#myModal3_phone_change").click(function() {
  $("#myModal3").modal('hide');
  $("#myModal").modal('show');
  $('#myModal_next').val("final");
});

$("#myModal3_address_change").click(function() {
  $("#myModal3").modal('hide');
  $("#myModal2").modal('show');
});




var ctot = cart_gen_tot_and_num();


$(".cartslider_bigview").append('<div style="width:100%;float:left"></div>');

$(".cartslider_bigview").append($('<div>'+gen_sabad_text()+'<br>('+ctot['farsi']+')</div>'));

$(".cartslider_bigview").append(finalorder);

}


</script>


  @include('cartSlider')

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



       // e.preventDefault();
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






$("#reggetnumber").on('submit',function () {

$('#myModal').modal("hide");

if ($("#myModal_next").val() == 'address') {
  $('#myModal2').modal("show");
}

if ($("#myModal_next").val() == 'final') {
  $('#myModal3').modal("show");
  $("#myModal_next").val("address");
}


  setTimeout(function() {
     $("#getaddress").val(gc("address"));
  $("#getaddress").focus();





/**/

/**/



  },500);

toyou("reguserdata",{"number":$("#getnumber").val(),"ordernumber": $('.ordernumber').first().val()},null);
sc("phone",$("#getnumber").val());
tdata.phone = $("#getnumber").val();
$("#myModal3_phone").html($("#getnumber").val());


return false;

});




function regaddress() {
  $('#myModal2').modal("hide");
$('#myModal3').modal("show");





var totx = cart_gen_tot_and_num();

var shippingcost = tdata.shippingcost[$("input:radio[name ='shiptype']:checked").val()];

$('#modal3successtext').empty();

$('#modal3successtext').append($("<h4 class=\"text-success\">سفارش شما با موفقیت ثبت شد</h4>"));



/**/
    var cart = JSON.parse(readCookie("cart"));
    


    var ords = $('<div></div>');
    ords.empty();

    $.each(cart, function (i) {
    


   var cont = $('<div style="width:100%;float:right;direction:rtl" class="border rounded p-2"></div>');



        cont.append($("<span style=\"float:right;\">"+cart[i]['title']+"</span>"));

        cont.append($("<span>"+cart[i]['count']+" عدد </span>"));

        cont.append($("<span style=\"float:right\">"+farsi_price(cart[i]['price']*cart[i]['count'])+" تومان </span>"));     


       
        

      ords.append(cont);


    
    });
/**/

     sc("cart",'{}');
     cartlistener();  


$('#modal3successcart').append(ords);


$('#modal3successtext').append($("<div>شماره ی سفارش : "+$('.ordernumber').first().val()+"<br></div>"));
$('#modal3successtext').append($("<div> مبلغ قابل پرداخت : "+farsi_price(totx['tot']+shippingcost)+" تومان</div>"));
$('#modal3successtext').append($("<div style=\"color:grey\">("+Num2persian(totx['tot']+shippingcost)+")</div>"));

toyou("reguserdata",{"address":$("#getaddress").val(),"shipping":$("input:radio[name ='shiptype']:checked").val(),"ordernumber": $('.ordernumber').first().val()},null);
sc("address",$("#getaddress").val());
tdata.address = $("#getaddress").val();
$("#myModal3_address").html($("#getaddress").val());

$("#myModal3_shipping").html($("input[name='shiptype']:checked").parent('label').text());


}
$("#reggetaddress").on('submit',function () {




if (!$("input[name='shiptype']:checked").val()) {
$('#zamantahvilsection').animate({'zoom': 1.2}, 400).delay(100).animate({'zoom': 1}, 400)
} else {
  regaddress();
}


return false;

});


$("#reggetaddressedame").click(function() {
if (!$("input[name='shiptype']:checked").val()) {
$('#zamantahvilsection').animate({'zoom': 1.2}, 400).delay(100).animate({'zoom': 1}, 400)
} else {
  regaddress();
}

});








$("#onlinepayment").click(function() {
toyou("reguserdata",{"payment":"online","ordernumber": $('.ordernumber').first().val()},function(res) {
//window.location="/onlinepayment/"+$('.ordernumber').first().val()
});
});

$("#offlinepayment").click(function() {
toyou("reguserdata",{"payment":"offline","ordernumber": $('.ordernumber').first().val()},function(res) {
//window.location="/myorders/"+$('.ordernumber').first().val()
window.location="/myorders"
});
});


</script>









<div  style="text-align:right;direction:rtl;margin-top:100px;padding-bottom:150px ; padding-right:10px;padding-top:10px" class="text-white bg-dark text-md-end">



جهت پیگیری سفارش و یا ثبت سفارش به صورت تلفنی با شماره ی زیر تماس بگیرید
<br>
شماره تماس  : ۴۲۴۴۸۷۸۷ 

<br>
همراه : ۰۹۳۳۲۸۰۶۱۴۴
(هر روز از ۸ صبح تا ۱۰ شب)
<hr>

آدرس :‌ خیابان جعفری کوچه خوشبین بنبست تختی پلاک ۲۲۹
(فروش حضوری نداریم)




</div>


</body>
</html>