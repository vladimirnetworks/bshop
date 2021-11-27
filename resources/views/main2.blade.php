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

</style>
</head>


<body>

@yield('main')  


<script>
$(".miniproduct").click(function(e) {

var me_offset =  $(this).offset();
var me_top = me_offset.top;

var elem = $(this);


do {

elem = elem.next();

var next_offset =  elem.offset();
var next_top =  next_offset.top;

} while(me_top == next_top);

$(this).fadeOut();
//elem.css({"color":"red"});

elem.prev().after($('<div class="col-12">me</div>'));

});
</script>
</body>
</html>