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

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

.cartslider {

    	 -o-transition:.2s;
  -ms-transition:.2s;
  -moz-transition:.2s;
  -webkit-transition:.2s;

  transition:.2s;
  height:10vh;

}
</style>
<body>

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
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Modal body..
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>





<script>
function createCookie(name, value, days) {
    var expires;

    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = encodeURIComponent(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ')
            c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0)
            return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}
///////////////////////////////////////////

function cartup() {
$(".cartslider").css({"height":"80vh"})
$(".cartslider_dim").fadeIn(200);
}


function cartdown() {
  $(".cartslider").css({"height":"10vh"})
  $(".cartslider_dim").fadeOut(200);
}




function cartlistener() {
    var cart = JSON.parse(readCookie("cart"));
    
    var tot = 0;

    $.each(cart, function (i) {
      tot = tot+parseInt(cart[i]['price']);
    }
    );
    $(".cartslider_body").html(tot)
    
}

function addtocart(prod) {

    if (!readCookie("cart")) {
        createCookie('cart', JSON.stringify({}), 10);
    }

    var cart = JSON.parse(readCookie("cart"));

    if (cart[prod['id']] == null) {

        prod['count'] = 1;

        cart[prod['id']] = prod;

        createCookie('cart', JSON.stringify(cart), 10);



    }

    cartlistener();

}

function cartchangecount(id, count) {

    if (readCookie("cart")) {
        var cart = JSON.parse(readCookie("cart"));
        if (cart[id] != null) {
            if (count > 0) {
                cart[id]['count'] = count;
            } else {

                delete cart[id];
            }

        }
        createCookie('cart', JSON.stringify(cart), 10);
    }

    cartlistener();

}


$('.addtocart').click(function() {

    var prod = JSON.parse($(this).attr('data-prod'));

    addtocart(prod);

});







</script>


<div style="display:none;opacity:0.5;position:fixed;bottom:0px;left:0px;width:100%;background-color:black;height:100%;z-index:9998" class="cartslider_dim">

</div>


<div style="position:fixed;bottom:0px;left:0px;width:100%;background-color:white;z-index:9999" id="mcartslider" class="cartslider p-3 border-top rounded shadow-lg p-3  bg-white">
 <div class="cartslider_body"></div>
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
  cartlistener();
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

        console.log(dif);
        if (dif <=0) {
          cartup();
        } else {
          cartdown();
        }

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





</script>
</body>
</html>