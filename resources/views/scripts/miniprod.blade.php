<script>


elemclicked = -1;
elementbackup = -1
$(".miniproduct").on("click",function(e) {





if (elemclicked != -1) {
  console.log("ihav");
elemclicked.addClass("col-4");
elemclicked.addClass("col-sm-3");
elemclicked.removeClass("col-12");

elemclicked.replaceWith(elementbackup);

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





elemclicked = $(this);
elementbackup = $(this).clone(true,true);

$(this).removeClass("col-4");
$(this).removeClass("col-sm-3");
$(this).addClass("col-12");





/*
animate(document.documentElement.scrollTop,$(this).offset().top-50,200,function (x) {
  window.scrollTo(0, x);
});
*/


$(this).css("background-color","#a9a9a9");

$(this).html('');

var vals = JSON.parse($(this).attr("data-me"));



var photoitems = [];
console.log(vals.photos);
for (var i=0;i<vals.photos.length;i++) {
   photoitems.push('<div class="myitem"><img style="width:100%" src="'+vals.photos[i].medium+'"  /></div>');
}

var mySwipe = new SwiperBox({
					items:photoitems					
					});



var cont = $('<div class="saving p-1 m-1 rounded " style="min-height:70vh;background-color:white;direction:rtl"></div>');

var photos = $('<div style="width:60vw;margin-right: auto;margin-left: auto;max-width:300px;"></div>');
photos.append($(mySwipe.HTMLElement));


var title = $('<div class="p-1 text-dark" style="font-size:120;font-weight:bold">'+vals.title+'</div>');
var price = $('<div class="p-1 text-success" style="font-size:150%;font-weight:bold">'+(vals.price)+' تومان </div>');
var caption = $('<ul style="text-align: right;font-size:90%">'+vals.caption+'</ul>');


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


$('#tr').get(0).play();



fly.css({transition:'all 1.5s'});

 setTimeout(function() {
fly.css({bottom:"-100%",width:"1vw"});
},200);


 $('.cartslider').removeClass("xshake");

  setTimeout(function() {

 $('.cartslider').addClass("xshake");
 $('#shopp').get(0).play();

 },700);

addtocart({id:vals.id,title:vals.title,tinytitle:vals.tinytitle,price:parseInt(vals.price)});


});

cont.append(kharid);

$(this).append(cont);

$(this).unbind('click');




});
</script>