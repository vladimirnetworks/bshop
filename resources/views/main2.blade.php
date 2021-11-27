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
function animate(from,to,time,func) {
   
    var start = new Date().getTime(),
        timer = setInterval(function() {
            var step = Math.min(1,(new Date().getTime()-start)/time);
            
            var x = from+step*(to-from);
            
            console.log(x);
            
            func(x);
            
            if( step == 1) clearInterval(timer);
        },25);
   
}
</script>

<script>

$(".miniproduct").click(function(e) {

    var me_offset = $(this).offset();
    var me_top = me_offset.top;
    var elem = $(this);
    var mynext = [];
    var back_mynext = [];
    var keepon = true;
   
    do {
   
        elem = elem.next();

        if (elem.offset()) {

            var next_offset = elem.offset();
            var next_top = next_offset.top;


            if (me_top == next_top) {
                mynext.push(elem);
                back_mynext.push(elem.clone(true, true));
            }

        } else {
            next_top = -1000;
         
        }



    } while (me_top == next_top);


var lastt = mynext[mynext.length-1];

if (typeof lastt === 'undefined') {
lastt = $(this);
}

myprodbox = $('<div class="prodbox col-12 p-2  border border primary rounded">this is product</div>');
$('.prodbox').remove();
lastt.after(myprodbox);

 
});



$(".miniproductx").click(function(e) {

    var me_offset = $(this).offset();
    var me_top = me_offset.top;
    var elem = $(this);
    var mynext = [];
    var back_mynext = [];
    var keepon = true;
   
    do {

   
        elem = elem.next();

        if (elem.offset()) {

            var next_offset = elem.offset();
            var next_top = next_offset.top;


            if (me_top == next_top) {
                mynext.push(elem);
                back_mynext.push(elem.clone(true, true));
            }

        } else {
            next_top = -1000;
         
        }



    } while (me_top == next_top);




if (false) {

}

console.log(back_mynext[back_mynext.length-1].html());

    for (var i = 0 ; i < mynext.length ; i++) {
      // console.log(mynext[i].html());
    }

     var tdis = $(this).clone(true,true);
     $(this).replaceWith(back_mynext[back_mynext.length-1]);

     mynext[back_mynext.length-1].replaceWith(tdis);

   
});

</script>

<script>


elemclicked = -1;

$(".miniproductz").click(function(e) {


if (elemclicked != -1) {
  console.log("ihav");
elemclicked.addClass("col-4");
elemclicked.addClass("col-sm-3");
elemclicked.removeClass("col-12");
} else {
    console.log("i dont hav");
}




var me_offset =  $(this).offset();
var me_top = me_offset.top;

var elem = $(this);

var myprevs = [];
var back_myprevs = [];
var keepon = true;

do {

elem = elem.prev();

if (elem.offset()) {

var prev_offset =  elem.offset();
var prev_top =  prev_offset.top;


if (me_top == prev_top) {
myprevs.push(elem);
back_myprevs.push(elem.clone(true, true));
}

} else {
  prev_top = -1000;
}



} while(me_top == prev_top);

for (var i = 0 ; i < myprevs.length ; i++) {
 myprevs[i].remove();

}

for (var i = 0 ; i < back_myprevs.length ; i++) {
/*  back_myprevs[i].click(function(e) {
       console.log("me");
  });
  */
$(this).after($(back_myprevs[i]));
}





$(this).removeClass("col-4");
$(this).removeClass("col-sm-3");
$(this).addClass("col-12");





animate(document.body.scrollTop,$(this).offset().top-50,200,function (x) {
  window.scrollTo(0, x);
});





elemclicked = $(this);

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