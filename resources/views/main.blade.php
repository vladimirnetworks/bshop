<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Webpage description goes here" />
  <meta charset="utf-8">
  <title>{{$pageTitle}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">



  <link rel="stylesheet" href="/bs4/bootstrap.min.css">


  <script src="/jquery/jquery.min.js"></script>
  <!-- <script src="/bs4/popper.min.js"></script> -->
  <script src="/bs4/bootstrap.min.js"></script>

  <script src="/scripts/cart.js?{{time()}}"></script>
  <script src="/scripts/bsh.js?{{time()}}"></script>
  <script src="/scripts/bshDom.js?{{time()}}"></script>

  <link rel="stylesheet" href="/css/bsh.css?{{time()}}">


  <script src="/scripts/swiperbox.js"></script>
  <script src="/scripts/util.js?{{time()}}"></script>

  <script src="/scripts/cartSlider.js"></script>

  <script>
    myorder = {};
  </script>

</head>


<body>

  <script>
    apix = new api();

    
    </script>

  <div style="z-index:1003;position:fixed;background-color:white;top:2vh;left:0px;text-align:center;width:100%;" class="px-2 whitetopbar" >
   <form style="display: flex;
   height: 100%;
   justify-content: center;
   align-items: center;flex-direction: column;" >

     <input autocomplete="off" id="search_input" type="text" class="form-control " style="direction:rtl;display:inline-block" placeholder="جستجو در محصولات">
     
  

     <div id="search_box" style="display:none;width:100%;z-index:999;position:absolute;background-color:white;top: 100%;height:100vh"></div>


    </form>
  </div>


   <div  style="z-index:999;position:absolute;top: 3%;left: 6%;width: 9vw; display:none;opacity:0.8;max-width: 51px;" class="TransFormAnim prodtopbar" id="backk" >
        <img src="/icons/back.png" style="width: 100%" />
   </div>

   <div  style="z-index:999;position:absolute;top: 3%;right: 6%;width: 9vw;display:none;opacity:0.8;max-width: 51px;" class="TransFormAnim prodtopbar"  id="mag" >
    <img src="/icons/mag.png" style="width: 100%" />
   </div>   



  <script>


$("#backk").click(function() {
  window.history.back();
});



$("#mag").click(function() {
  setTimeout(function() {
      $("#search_input").focus();
      
     },50);
     
});

    $("#search_input , #mag").on('focus click',function() {
    
      if (cartsliderdata.isup) {
        window.history.back();
      }
     
      showtop();
     

     $("#search_box").show();



     if ($("#search_input").val() == '') {
     $("#search_box").empty();
     }
      hpu({ act: "searchboxshow"});
     
    });

    $("#search_input").focusout(function() {
     //$(this).css({"background-color":"white"});
    });


    $("#search_input").keyup(function() {


      $("#search_box").empty();
      $("#search_box").append($('<div class="presearch m-2">...</div>'));
      $("#search_box").append($('<div class="presearch m-2">...</div>'));
      $("#search_box").append($('<div class="presearch m-2">...</div>'));

      apix.post("search",{"q":$("#search_input").val()},function(item) {
        if (item) {

          $("#search_box").show();

          var xitem = $('<div style="direction:rtl" class="p-2 m-2 text-right border border-primary rounded">'+item.title+'</div>');
               xitem.click(function() {
                hpu({ act: "product", prod: item });
                $("#search_box").hide();
                $("#search_input").val("");
                openprod(item);


               });
          $("#search_box").append(xitem);
        }
      },function(res) {

        $("#search_box").show();

        $("#search_box").empty();

        if (res.notfound) {
          $("#search_box").append($('<div style="direction:rtl" class=" m-2">هیچی پیدا نشد ☹</div>'));
        }
      });


    });

    </script>


@yield('main')

<script>

loadtoloader(".loader","index");
//loadcat(".catmain","catload",{"type":"index"});

</script>







  
  @include("orderModals.getNumber")
  @include("orderModals.getAddress")
  @include("orderModals.successOrder")


  @include("cartSlider")




  <audio id="tr" src="https://www.benham.ir/t.mp3" type="audio/mp3"></audio>
  <audio id="shopp" src="https://www.benham.ir/shopp.mp3" type="audio/mp3"></audio>




  <script>
   window.addEventListener('popstate', (event) => {

    console.log(event.state);

     

    $("#search_box").hide();
    $("#search_input").val("");

     if (event.state == null || event.state.act == 'gotomain') {
       cartdown();
       $(".modal").modal("hide");
       
       $('.bigprod').empty();
       showtop();

       loadtoloader(".loader","index");

       loadcat(".catmain","catload",{"type":"index"});

        


     } else {


       if (event.state.act == 'cartup') {
         $(".modal").modal("hide");
         cartup();
         showtop();
       }
       if (event.state.act == 'finishcart') {
         $(".modal").modal("hide");
         $("#getNumberModal").modal("show");

       }

       if (event.state.act == 'addednumber') {
         $(".modal").modal("hide");
         $("#getAddressModal").modal("show");

       }

       if (event.state.act == 'searchboxshow') {
          cartdown();
          window.history.back();
          showtop();  
       }


       if (event.state.act == 'product') {
        
        cartdown();
         openprod(event.state.prod,"noanim");
         hidetop();
         
       }



       if (event.state.act == 'loadtoloader') {
        
           $('.bigprod').empty();
            cartdown();
            showtop();  
            loadtoloader(".loader", event.state.path);
      }


     }
   });
 </script>


<script>
$(".TransFormAnim").on("click touchstart", function() {

  TransFormAnim($(this));

});
</script>

<div style="display:none"class="p-2 m-2 text-center">

<a referrerpolicy="origin"  target="_blank" href="https://trustseal.enamad.ir/?id=244136&Code=NAYvp5VDiHI1pstposy1"><img referrerpolicy="origin" src="https://s4.uupload.ir/files/star0_22zf.png" alt="" class="rounded" style="cursor:pointer" id="NAYvp5VDiHI1pstposy1"></a>

</div>



<div style="margin-top:30vh" class=" p-4 bg-dark text-white text-right" >
  <hr>
  
 تماس با فروشگاه :
 <span style="direction:ltr"> 06642448787</span>

<br>
<div style="direction:rtl">
آدرس فروشگاه : 

<br>

لرستان بروجرد خیابان جعفری بن بست ((شهبازی))، پلاک: 251.0، طبقه: همکف،
</div>
</div>

</body>

</html>