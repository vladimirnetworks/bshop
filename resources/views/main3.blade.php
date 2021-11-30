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
.fly {

  animation: mymove 0.5s infinite;
}

@keyframes mymove {
  50% {transform: rotate(360deg);}
}
</style>

<style>
.modal-header {
    border-bottom:0px;
}


@keyframes zoominoutsinglefeatured {
  0% {
      transform: scale(0.8,0.8);
      opacity:0.0;
  }

  100% {
      transform: scale(1,1);
      opacity:1.0;
  }
}


.saving {

  animation: zoominoutsinglefeatured .3s 1 ;
}

body {
  margin-top:0px;
  margin-bottom:50vh;
}




@keyframes xshake_anim {

  0% { transform: translate(1px, 1px) rotate(0deg);  background-color:white}
  10% { transform: translate(-1px, -2px) rotate(-1deg); }
  20% { transform: translate(-3px, 0px) rotate(1deg); background-color:#00fb59}
  30% { transform: translate(3px, 2px) rotate(0deg); }
  40% { transform: translate(1px, -1px) rotate(1deg); }
  50% { transform: translate(-1px, 2px) rotate(-1deg); background-color:#00e7ff}
  60% { transform: translate(-3px, 1px) rotate(0deg); }
  70% { transform: translate(3px, 1px) rotate(-1deg); }
  80% { transform: translate(-1px, -1px) rotate(1deg); }
  90% { transform: translate(1px, 2px) rotate(0deg); }
  100% { transform: translate(1px, -2px) rotate(-1deg); background-color:white}

}

.xshake {

  animation: xshake_anim .3s 2 ;
  animation-timing-function: ease-in-out;
}





</style>
<script src="scripts/swiperbox.js"></script>
<script src="scripts/util.js"></script>
<script src="scripts/cart.js?{{time()}}"></script>
<script src="scripts/cartSlider.js"></script>


</head>


<body>

@yield('main')  


<script>

function api() {
    self = this;
    this.api = "/api/";

    this.get = function(path,doin) {
        $.getJSON(this.api+path, function(data){ 
             for (var i=0;i<data.data.length;i++) {
                doin(data.data[i]);
             }
        });
    }

    return this;
}

$('.loader').empty();

apix = new api();

apix.get("index",function(vals) {

    var xx = '<div style="transition: all .150s" class="rounded col-4 col-sm-3  p-2 text-center miniproduct" data-me=""> \
     <div class=" h-100 " style="direction:rtl;flex-direction:column;display:flex"> \
      <span>  <img class="mw-100" src="'+vals.photo+'"></span> \
      <div style="margin-top:auto"> \
      <span style="color:#535353" href="product/47" class="d-block">'+vals.tinytitle+'</span> \
      </div> \
      <div style="margin-top:auto"> \
      <span style="color:#232933">'+vals.price+'</span><span style="font-size:.714rem ; color:#232933">تومان \
      </span> \
      </div> \
   </div> \
</div>';


var jprod = $(xx);



jprod.on("touchstart click",function() {
 jprod.css({"transform":'scale(0.8)' , "background-color":'#3781f0'});

 setTimeout(function() {
 jprod.css({"transform":'scale(1.0)', "background-color":'white'});
},151);


});


/**/


jprod.on("click",function(e) {


  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; 



var photgals = JSON.parse(vals.photos);

var photoitems = [];
console.log(photgals);
for (var i=0;i<photgals.length;i++) {
   photoitems.push('<div class="myitem"><img style="width:100%" src="'+photgals[i].medium+'"  /></div>');
}

var mySwipe = new SwiperBox({
					items:photoitems					
					});



var cont = $('<div class="saving  rounded " style="background-color:white;direction:rtl"></div>');

var photos = $('<div style="width:50vw;margin-right: auto;margin-left: auto;max-width:300px;"></div>');
photos.append($(mySwipe.HTMLElement));


var title = $('<div class="text-dark" style="font-size:120%;font-weight:bold">'+vals.title+'</div>');
var price = $('<div class="pt-1 text-success" style="font-size:150%;font-weight:bold">'+farsi_price(vals.price)+' تومان </div>');
var caption = $('<ul style="text-align: right;font-size:90%">'+vals.licaption+'</ul>');


cont.append(photos);
cont.append(title);
cont.append(price);
cont.append(caption);





var kharid = $('<button class="btn btn-danger btn-lg m-2">خرید</button>');

kharid.click(function(e) {



var fly = $('<div class="fly" style="position:fixed;bottom:-100%;left:-100%;background-color:white;z-index:99991"></div>');
$('.fly').remove();
var cloned_photos = photos.clone();

cloned_photos.css({width:"100%"});

var pattern = /jpg/;
var flyingimage = "";
for (var i=0;i<photoitems.length;i++) {

  if (pattern.test(photoitems[i].innerHTML)) {
    flyingimage = photoitems[i].innerHTML;
    break;
  }
}

fly.append($(flyingimage));

//fly.append(title.clone());



var position_from_top = photos.offset().top - $(window).scrollTop();

xofsset = photos.offset();


  var btm = $(window).height()-(position_from_top+photos.height());

fly.css({
  width:photos.width()+"px",
bottom:btm+"px",
height:photos.height()+"px",
left:xofsset.left+"px",
});

$('body').append(fly);


//$('#tr').get(0).play();



fly.css({transition:'all 1.5s'});



    $(".cartslider").css({
        "height": "30vh"
    });

        $(".cartslider_smallview").css({
        "align-items": "start"
    });





 setTimeout(function() {
fly.css({bottom:"-100%",width:"1vw"});
},200);


 $('.cartslider').removeClass("xshake");

  setTimeout(function() {

 $('.cartslider').addClass("xshake");
 //$('#shopp').get(0).play();

 },700);


  setTimeout(function() {

     $(".cartslider").css({
        "height": "9vh"
     });


        $(".cartslider_smallview").css({
        "align-items": "center"
    });


 },900);






addtocart({id:vals.id,title:vals.title,tinytitle:vals.tinytitle,price:parseInt(vals.price)});


});

cont.append(kharid);

$('.bigprod').empty();


$('.bigprod').append(cont);
$('.bigprod').append($('<hr>'));



});
/**/


$('.loader').append(jprod);





});




////////////use///////////
xcart = new Cart();

firsttimecartup = true;

function addtocart(prod) {
xcart.add(prod);  
/*
 if (firsttimecartup) {
   cartup();
    firsttimecartup=false;


     if (cartsliderdata.timer) {
      clearTimeout(cartsliderdata.timer);
    }

    cartsliderdata.timer = setTimeout(function() {
      if (!cartsliderdata.userwording) {

          cartdown(1000);
          

      }
    },4000);

     }
*/
}




xcart.addChangeListener(function() {







   var tot = xcart.total();

if (tot.count > 0) {
     $(".cartslider").css({
        "bottom": "0px"
     });
} else {

    cartdown();
    $(".cartslider").css({
        "bottom": "-9vh"
     }); 
}




   $('.cartslider_smallview_text').html(farsi_price(tot.amount)+" تومان");


   $(".cartslider_bigview_cart").empty();




   xcart.eech(function(prod) {



        var cont = $('<div class="m-0 mt-1 border-bottom  border-secondary pb-1"></div>')

         cont.append('<div style="display:inline-block;width:50%"><small>'+prod.tinytitle+"</small></div>");

          var num = $('<div></div>');

          var bez = $('<button style="display:inline-block;border-radius: 0;" class="btn btn-danger rounded-right btn-sm" >+</button>');

          num.append(bez);

          bez.click(function() {
              xcart.changeCount(prod.id,prod.count+1);
          });
          num.append('<span style="display:inline-block" >'+prod.count+'</span>');

          var men = $('<button style="display:inline-block;border-radius: 0;" class="btn btn-danger rounded-left btn-sm" >-</button>');

          men.click(function() {
              xcart.changeCount(prod.id,prod.count-1);
          });

          num.append(men);
        
        cont.append($('<div style="display:inline-block"></div>').append(num));


        cont.append('<div style="display:inline-block;width: 25%"><small>'+farsi_price(prod.price*prod.count)+" تومان</small></div>");


      $(".cartslider_bigview_cart").append(cont);


   });




});








</script>




@include("scripts.miniprod")

@include("orderModals.getNumber")
@include("orderModals.getAddress")
@include("orderModals.successOrder")


@include("cartSlider")




<audio id="tr" src="https://www.benham.ir/t.mp3" type="audio/mp3"></audio>
<audio id="shopp" src="https://www.benham.ir/shopp.mp3" type="audio/mp3"></audio>




<script>




  
window.addEventListener('popstate', (event) => {
  if (event.state == null) {
     cartdown();  
     $( ".modal" ).modal("hide");
  } else {

   if (event.state.act == 'cartup') {
    
     $( ".modal" ).modal("hide");
      cartup();  
   }

   if (event.state.act == 'finishcart') {
     $( ".modal" ).modal("hide");
     $("#getNumberModal").modal("show");
   }

   if (event.state.act == 'addednumber') {
     $( ".modal" ).modal("hide");
     $("#getAddressModal").modal("show");
   }






  }


});
</script>
</body>
</html>