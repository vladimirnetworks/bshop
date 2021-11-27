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

//$(this).removeClass("col-4");
//$(this).removeClass("col-sm-3");
//$(this).addClass("col-12");

var me_offset =  $(this).offset();
var me_top = me_offset.top;

var elem = $(this);

var myprevs = [];
var back_myprevs = [];
var breakme = false;
do {

elem = elem.prev();

if (me_top == prev_top) {
myprevs.push(elem);
back_myprevs.push(elem);
}


var prev_offset =  elem.offset();
var prev_top =  prev_offset.top;


} while(me_top == prev_top || breakme);

for (var i = 0 ; i < myprevs.length ; i++) {
 // myprevs[i].remove();

 console.log( myprevs[i].html());
}



//console.log(back_myprevs);
//$(this).fadeOut();
//elem.css({"color":"red"});

//setTimeout(function() {
//elem.prev().after($('<div class="col-12">me</div>'));
//},3000);
//

});
</script>
</body>
</html>