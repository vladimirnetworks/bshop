<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Webpage description goes here" />
  <meta charset="utf-8">
  <title>{{$pageTitle}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">



  <link rel="stylesheet" href="/bs4/bootstrap.min.css">


  <script src="/jquery/jquery.min.js"></script>
  <script src="/bs4/popper.min.js"></script>
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

  <div style="z-index:99999;position:fixed;background-color:white;top:0px;left:0px;text-align:center;width:100%;" class="p-2" >
   <form style="display: flex;
   height: 100%;
   justify-content: center;
   align-items: center;flex-direction: column;" class="px-2">

     <input autocomplete="off" id="search_input" type="text" class="form-control " style="direction:rtl;display:inline-block" placeholder="جستجو در محصولات">
     
  

     <div id="search_box" style="display:none;width:100%;z-index:99999;position:absolute;background-color:white;top: 100%;height:100vh"></div>


    </form>
  </div>

  <script>
    $("#search_input").focus(function() {
    
     $("#search_box").show();
     hpu({ act: "searchboxshow"});
    });

    $("#search_input").focusout(function() {
     //$(this).css({"background-color":"white"});
    });



    </script>


@yield('main')

<script>
apix = new api();
loadtoloader(".loader","index");
loadcat(".catmain","catload",{"type":"index"});

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

     if (event.state == null) {
       cartdown();
       $(".modal").modal("hide");
       $('.bigprod').empty();

       loadtoloader(".loader","index");

       loadcat(".catmain","catload",{"type":"index"});

       $("#search_box").hide();   


     } else {


       if (event.state.act == 'cartup') {
         $(".modal").modal("hide");
         cartup();
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
         $("#search_box").hide();   
       }


       if (event.state.act == 'product') {
        

         openprod(event.state.prod);
        cartdown();
       }



       if (event.state.act == 'loadtoloader') {
        
      
            $('.bigprod').empty();
            loadtoloader(".loader", event.state.path);
      }


     }
   });
 </script>


</body>

</html>