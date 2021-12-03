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

@yield('main')

<script>
apix = new api();
loadtoloader(".loader","index");
loadcat();

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