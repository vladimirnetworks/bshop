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
      50% {
        transform: rotate(360deg);
      }
    }
  </style>

  <style>
    .modal-header {
      border-bottom: 0px;
    }


    @keyframes zoominoutsinglefeatured {
      0% {
        transform: scale(0.8, 0.8);
        opacity: 0.0;
      }

      100% {
        transform: scale(1, 1);
        opacity: 1.0;
      }
    }


    .saving {

      animation: zoominoutsinglefeatured .3s 1;
    }

    body {
      margin-top: 0px;
      margin-bottom: 50vh;
    }




    @keyframes xshake_anim {

      0% {
        transform: translate(1px, 1px) rotate(0deg);
        background-color: white
      }

      10% {
        transform: translate(-1px, -2px) rotate(-1deg);
      }

      20% {
        transform: translate(-3px, 0px) rotate(1deg);
        background-color: #00fb59
      }

      30% {
        transform: translate(3px, 2px) rotate(0deg);
      }

      40% {
        transform: translate(1px, -1px) rotate(1deg);
      }

      50% {
        transform: translate(-1px, 2px) rotate(-1deg);
        background-color: #00e7ff
      }

      60% {
        transform: translate(-3px, 1px) rotate(0deg);
      }

      70% {
        transform: translate(3px, 1px) rotate(-1deg);
      }

      80% {
        transform: translate(-1px, -1px) rotate(1deg);
      }

      90% {
        transform: translate(1px, 2px) rotate(0deg);
      }

      100% {
        transform: translate(1px, -2px) rotate(-1deg);
        background-color: white
      }

    }

    .xshake {

      animation: xshake_anim .3s 2;
      animation-timing-function: ease-in-out;
    }
  </style>
  <script src="/scripts/swiperbox.js"></script>
  <script src="/scripts/util.js"></script>
  <script src="/scripts/cart.js?{{time()}}"></script>
  <script src="/scripts/cartSlider.js"></script>

  <script>
    myorder = {};
  </script>

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



apix = new api();

</script>

@include("scripts.loadtoloader")

<script>
loadtoloader(".loader","index");
</script>


<script>


//////cat

$(".catmain").empty();

apix.get("maincat",function(vals) {

var catelem = $('<div class="bg-warning rounded-pill m-2 p-2" style="transition:all 0.1s;display:inline-block">'+vals.title+'</div>');

catelem.on("touchstart click",function() {

    console.log("touchstart");

    $(this).css({"transform":'scale(0.3)'  });

    $(this).removeClass("rounded-pill");
    $(this).addClass("rounded");

    setTimeout(function() {
      catelem.css({"transform":'scale(1.0)'});

      catelem.removeClass("rounded");
      catelem.addClass("rounded-pill");

    },151);

});

$(".catmain").append(catelem);

});

//////catend


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